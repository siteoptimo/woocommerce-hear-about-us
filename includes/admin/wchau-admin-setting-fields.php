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
		add_action( 'woocommerce_settings_woocommerce_hear_about_us_settings', array( $this, 'settings_tab' ) );
		add_action( 'woocommerce_update_options_woocommerce_hear_about_us_settings', array( $this, 'update_settings' ) );
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

		$settings['functionality']     = array(
			'title'         => 'Functionality',
			'type'          => 'checkbox',
			'checkboxgroup' => 'start',
			'desc'          => 'Enable the free gifts functionality',
			'id'            => 'wchau_enable_free_gifts',
			'default'       => 'yes'
		);
		$settings['disable_on_coupon'] = array(
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