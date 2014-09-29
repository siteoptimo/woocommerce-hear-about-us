<?php

class WCHAU_Custom_Field {

	public function __construct() {
		add_action( 'woocommerce_after_order_notes', array( $this, 'display_field' ) );

	}

	function display_field( $checkout ) {
		woocommerce_form_field( 'wchau_field', array(
			'type'    => 'select',
			'class'   => array( 'wchau-field form-row-wide' ),
			'label'   => wchau_get_option( 'wchau_label' ),
			'options' => $this->get_options(),
		), $checkout->get_value( 'wchau_field' ) );

	}

	public static function prepare_options( $options ) {

		$options = explode( PHP_EOL, $options );

		$return = array();

		foreach ( $options as $option ) {
			$return[ self::slugify( $option ) ] = $option;
		}

		return $return;
	}

	private function get_options() {
		return self::prepare_options( wchau_get_option( 'wchau_options' ) );
	}

	public static function slugify( $in ) {
		return sanitize_title_with_dashes( $in );
	}
}