<?php

/**
 * @author Pieter Carette <pieter@siteoptimo.com>
 */
class WCHAU_Admin_Display_On_Order {

	/**
	 * Constructs the class and adds the hooks.
	 */
	public function __construct() {
		add_action( 'woocommerce_admin_order_data_after_billing_address', array(
			$this,
			'display_source_with_order_meta'
		), 10, 1 );

	}

	function display_source_with_order_meta( $order ) {
		$order_source = wchau_get_option_value(get_post_meta( $order->id, 'source', true ));

		echo '<p><strong>' . __( 'Source', 'woocommerce-hear-about-us' ) . ':</strong> ' . $order_source . '</p>';
	}

}