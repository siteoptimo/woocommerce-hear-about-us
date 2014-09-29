<?php
/**
 * Class WCHAU_Admin_Add_Settings_Link
 *
 * Adds the settings link to the plugin's box.
 *
 * @package WooCommerce_HearAboutUs
 * @class WCHAU_Admin_Add_Settings_Link
 * @author Pieter Carette <pieter@siteoptimo.com>
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCHAU_Admin_Add_Settings_Link {
	/**
	 * Add filter
	 */
	public function __construct() {
		add_filter( 'plugin_action_links_' . WooCommerce_HearAboutUs::instance()->plugin_basename(), array(
				$this,
				'wchau_settings_link'
			) );
	}

	/**
	 * Add the settings link.
	 *
	 * @param $links
	 *
	 * @return mixed
	 */
	public function wchau_settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=wc-settings&tab=account">' . __( 'Settings', 'woocommerce-hear-about-us' ) . '</a>';
		array_unshift( $links, $settings_link );

		return $links;
	}

}