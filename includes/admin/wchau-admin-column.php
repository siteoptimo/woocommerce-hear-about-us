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

class WCHAU_Admin_Column {
	/**
	 * Add filter
	 */
	public function __construct() {

		// Add to user listing
		add_filter( 'manage_users_columns', array( $this, 'addUserColumn' ) );
		add_filter( 'manage_users_sortable_columns', array( $this, 'addUserSortableColumn' ) );
		add_filter( 'manage_users_custom_column', array( $this, 'userColumnValue' ), 10, 3 );

		// Add to order listing
		add_filter( 'manage_edit-shop_order_columns', array( $this, 'addOrderColumn' ) );
		add_filter( 'manage_edit-shop_order_sortable_columns', array( $this, 'addOrderSortableColumn' ) );
		add_action( 'manage_shop_order_posts_custom_column', array( $this, 'orderColumnValue' ), 10, 2 );
	}

	public function addUserColumn( $columns ) {
		$columns['source'] = __( 'Source', 'woocommerce-hear-about-us' );

		return $columns;
	}

	public function addUserSortableColumn( $columns ) {
		$columns['source'] = 'source';

		return $columns;
	}

	public function userColumnValue( $value, $column_name, $user_id ) {
		if ( 'source' === $column_name ) {
			return wchau_get_option_value( get_user_meta( $user_id, '_wchau_source', true ), '' );
		}

		return $value;
	}

	public function addOrderColumn( $columns ) {
		$columns['source'] = __( 'Source', 'woocommerce-hear-about-us' );

		return $columns;
	}

	public function addOrderSortableColumn( $columns ) {
		$columns['source'] = 'source';

		return $columns;
	}

	public function orderColumnValue( $column_name, $order_id ) {
		if ( 'source' === $column_name ) {
			echo wchau_get_option_value( get_post_meta( $order_id, 'source', true ), '' );
		}
	}
}