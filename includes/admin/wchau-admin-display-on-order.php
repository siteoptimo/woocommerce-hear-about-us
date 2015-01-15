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
		$order_source = get_post_meta( $order->id, 'source', true );
		if ( $order_source == '' ) {
			$order_source = __( 'N/A', 'woocommerce-hear-about-us' );
		}
		echo '<p><strong>' . __( 'Source', 'woocommerce-hear-about-us' ) . ':</strong> ' . $order_source . '</p>';

	}

}