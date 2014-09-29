<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WCHAU_Admin_Setting_Fields
 *
 * Handles the WooCommerce Plivo settings. This uses the WooCommerce Settings API.
 *
 * @package WooCommerce_HearAboutUs
 * @class WCHAU_Admin_Setting_Fields
 * @author Pieter Carette <pieter@siteoptimo.com>
 */
class WCHAU_Admin_Setting_Fields {
	/**
	 * Construct the class.
	 */
	public function __construct() {

		add_filter( 'woocommerce_account_settings', array( $this, 'add_settings' ) );
	}

	public function add_settings( $settings ) {

		$title = array(
			'title' => __( 'Where did you hear about us', 'woocommerce-hear-about-us' ),
			'type'  => 'title',
			'desc'  => 'Manage the "where did you hear about us" options.',
			'id'    => 'wchau_title'
		);
		array_push( $settings, $title );

		$fields = apply_filters( 'wchau_settings_fields', array(
				array(
					'title'    => __( 'Label', 'woocommerce-hear-about-us' ),
					'desc'     => __( 'Customize the "where did you hear about us" label.', 'woocommerce-hear-about-us' ),
					'id'       => 'wchau_label',
					'type'     => 'text',
					'default'  => __('Where did you hear about us?', 'woocommerce-hear-about-us'),
					'desc_tip' => true,
				),
				array(
					'title'    => __( 'Possible answers', 'woocommerce-hear-about-us' ),
					'desc'     => __( 'List all of the possible answers in this field. Separate them using a newline.', 'woocommerce-hear-about-us' ),
					'id'       => 'wchau_options',
					'type'     => 'textarea',
					'default'  => '',
					'desc_tip' => true,
				)
			)
		);
		$settings = array_merge( $settings, $fields );

		$sectionend = array( 'type' => 'sectionend', 'id' => 'wchau_sectionend' );

		array_push( $settings, $sectionend );

		return $settings;
	}

	/**
	 * Settings tab.
	 */
	function settings_tab() {
		woocommerce_admin_fields( $this->get_settings() );
	}

	/**
	 * Update the settings values.
	 */
	function update_settings() {
		woocommerce_update_options( $this->get_settings() );
	}

	/**
	 * Gets all of the settings.
	 *
	 * @return mixed The settings
	 */
	private function get_settings() {

		$settings['free_gifts_settings_title'] = array(
			'name' => __( 'Free gifts settings', 'woocommerce-hear-about-us' ),
			'type' => 'title',
			'desc' => __( '', 'woocommerce-hear-about-us' ),
			'id'   => 'wchau_plivo_settings_section_title'
		);

		$settings['visible_on_cart']     = array(
			'title'         => 'Display options',
			'desc'          => __( 'Show the free gifts at the cart page', 'woocommerce-hear-about-us' ),
			'type'          => 'checkbox',
			'checkboxgroup' => 'start',
			'id'            => 'wchau_cart_view',
			'default'       => 'yes'
		);
		$settings['visible_on_checkout'] = array(
			'desc'          => __( 'Show free gifts on checkout and invoice', 'woocommerce-hear-about-us' ),
			'type'          => 'checkbox',
			'checkboxgroup' => '',
			'id'            => 'wchau_cart_checkout',
			'default'       => 'yes'
		);
		$settings['show_value']          = array(
			'desc'          => __( 'Show gift value when available', 'woocommerce-hear-about-us' ),
			'type'          => 'checkbox',
			'checkboxgroup' => 'end',
			'id'            => 'wchau_show_gift_value',
			'default'       => 'yes'
		);

		$settings['functionality']            = array(
			'title'         => 'Functionality',
			'type'          => 'checkbox',
			'checkboxgroup' => 'start',
			'desc'          => 'Enable the free gifts functionality',
			'id'            => 'wchau_enable_free_gifts',
			'default'       => 'yes'
		);
		$settings['disable_on_coupon']        = array(
			'desc'          => __( 'Disable gifts when a coupon is used', 'woocommerce-hear-about-us' ),
			'type'          => 'checkbox',
			'checkboxgroup' => '',
			'id'            => 'wchau_disable_on_coupon',
			'default'       => 'no'
		);
		$settings['always_use_regular_price'] = array(
			'desc'          => __( 'Always use regular price?', 'woocommerce-hear-about-us' ),
			'type'          => 'checkbox',
			'checkboxgroup' => 'end',
			'id'            => 'wchau_always_use_regular_price',
			'default'       => 'no'
		);

		$settings['auto_select_gift'] = array(
			'name'    => __( 'Auto select', 'woocommerce-hear-about-us' ),
			'type'    => 'select',
			'options' => array(
				'no'  => __( 'Nothing', 'woocommerce-hear-about-us' ),
				'yes' => __( 'Product with highest value', 'woocommerce-hear-about-us' )
			),
			'desc'    => '',
			'id'      => 'wchau_select_gift',
			'default' => 'no'
		);

		$settings['section_end'] = array( 'type' => 'sectionend', 'id' => 'wchau_settings_section_end' );


		return apply_filters( 'woocommerce_hear_about_us_settings', $settings );
	}
} 