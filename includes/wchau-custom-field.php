<?php

class WCHAU_Custom_Field {

	public function __construct() {

		if ( ! $this->user_already_answered() ) {
			add_action( 'woocommerce_after_order_notes',
				array( $this, 'display_field' ) );
			add_action( 'woocommerce_checkout_process',
				array( $this, 'process_checkout_fields' ) );
		}

		$source_location = get_option( 'wchau_sourcelocation',
			'profiles_and_orders' );
		if ( $source_location == 'profiles_and_orders' || $source_location == 'profiles_only' ) {
			add_action( 'woocommerce_checkout_update_user_meta',
				array( $this, 'save_custom_checkout_for_users' ) );
			add_filter( 'woocommerce_customer_meta_fields',
				array( $this, 'user_profile' ) );
		}

		if ( $source_location == 'profiles_and_orders' || $source_location == 'orders_only' ) {
			add_action( 'woocommerce_checkout_update_order_meta',
				array( $this, 'save_source_to_order_meta' ) );
		}

		add_filter( 'woocommerce_email_order_meta_keys',
			array( $this, 'add_field_to_email' ) );

	}

	function display_field( $checkout ) {
		// Source field.
		woocommerce_form_field( 'wchau_source',
			array(
				'type'     => 'select',
				'class'    => array( 'wchau-source form-row-wide' ),
				'label'    => wchau_get_option( 'wchau_label' ),
				'options'  => self::get_options(),
				'required' => $this->is_field_required(),
			),
			$checkout->get_value( 'wchau_source' ) );

		if ( wchau_other_field_enabled() ) {
			$this->enqueue_option_js();
			// Generate HTML for Other field.
			woocommerce_form_field( 'wchau_source',
				array(
					'type'              => 'text',
					'label'             =>  wchau_get_option( 'wchau_label_other' ),
					'required'          => $this->is_field_required(),
				) );
		}

	}

	private function enqueue_option_js() {
		global $WCHAU;

		wp_enqueue_script( 'wchau_other',
			$WCHAU->plugin_url() . 'assets/js/other-field.js',
			array( 'jquery' ),
			WooCommerce_HearAboutUs::$version,
			true );
	}

	public static function prepare_options( $options ) {

		$options = explode( PHP_EOL, $options );

		$return = array();

		$return['empty'] = __( '-- Choose an option --',
			'woocommerce-hear-about-us' );

		foreach ( $options as $option ) {
			$return[ self::slugify( $option ) ] = $option;
		}

		if ( wchau_other_field_enabled() ) {
			$return['other'] = wchau_get_option( 'wchau_label_other' );
		}

		return $return;
	}

	public function process_checkout_fields() {
		if ( ! $this->is_field_required() ) {
			return;
		}

		if ( ! isset( $_POST['wchau_source'] ) || empty( $_POST['wchau_source'] ) || $_POST['wchau_source'] == 'empty' ) {
			wc_add_notice( __( 'Please enter where you found us.',
				'woocommerce-hear-about-us' ),
				'error' );
		}
	}

	function save_custom_checkout_for_users( $user_id ) {
		if ( ! empty( $_POST['wchau_source'] ) ) {

			$source = $_POST['wchau_source'];

			$source = sanitize_text_field( wchau_get_option_value( $source ) );

			update_user_meta( $user_id, '_wchau_source', $source );
		}
	}

	function save_source_to_order_meta( $order_id ) {
		if ( ! empty( $_POST['wchau_source'] ) ) {
			update_post_meta( $order_id,
				'source',
				wchau_get_option_value( sanitize_text_field( $_POST['wchau_source'] ) ) );
		}
	}

	public function user_profile( $fields ) {
		$fields['wchau_source'] = array(
			'title'  => __( 'Where did you hear about us',
				'woocommerce-hear-about-us' ),
			'fields' => array(
				'_wchau_source' => array(
					'label'       => __( 'Source',
						'woocommerce-hear-about-us' ),
					'description' => ''
				),
			)
		);

		return $fields;
	}

	public function add_field_to_email( $keys ) {
		$keys[ __( 'Source', 'woocommerce-hear-about-us' ) ] = 'source';

		return $keys;
	}

	public static function get_options() {
		return self::prepare_options( wchau_get_option( 'wchau_options' ) );
	}

	public static function slugify( $in ) {
		return sanitize_title_with_dashes( $in );
	}

	private function is_field_required() {
		return get_option( 'wchau_required', 'yes' ) == 'yes';
	}

	private function user_already_answered() {

		if ( is_user_logged_in() && get_user_meta( get_current_user_id(),
				'_wchau_source',
				true )
		) {
			return true;
		} else {
			return false;
		}

	}

}
