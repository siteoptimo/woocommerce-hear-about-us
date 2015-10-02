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
		add_filter( 'manage_users_columns', array( $this, 'addUserColumn' ) );
		add_filter( 'manage_users_sortable_columns', array( $this, 'addUserColumn' ) );
		add_filter( 'manage_users_custom_column', array( $this, 'userColumnValue' ), 10, 3 );
		add_filter( 'pre_user_query', array( $this, 'userSortBySource' ) );
	}

	public function addUserColumn( $columns ) {
		$columns['source'] = __( 'Source', 'woocommerce-hear-about-us' );

		return $columns;
	}

	public function userColumnValue( $value, $column_name, $user_id ) {
		if ( 'source' === $column_name ) {
			return get_user_meta( $user_id, '_wchau_source', true );
		}

		return $value;
	}

	public function userSortBySource( $user_search ) {
		global $wpdb, $current_screen;

		if ( 'users' != $current_screen->id ) {
			return;
		}

		$vars = $user_search->query_vars;

		if ( 'Source' == $vars['orderby'] ) {
			$user_search->query_from .= " INNER JOIN {$wpdb->usermeta} m1 ON {$wpdb->users}.ID=m1.user_id AND (m1.meta_key='_wchau_source')";
			$user_search->query_orderby = ' ORDER BY UPPER(m1.meta_value) ' . $vars['order'];
		}
	}
}