<?php
/**
 * @author Koen Van den Wijngaert <koen@siteoptimo.com>
 */

function wchau_get_template( $template ) {
	$plugin_path = trailingslashit( wchau_get_plugin_path() );

	require_once $plugin_path . 'templates/' . $template . '.php';
}

function wchau_get_plugin_path() {
	global $WCHAU;

	return $WCHAU->plugin_path();
}

function wchau_get_option( $name, $default = "" ) {
	$filtered = get_option( apply_filters( 'wchau_get_option', $name ), $default );

	if(empty($filtered)) {
		return get_option($name, $default);
	}

	return $filtered;
}

function wchau_get_option_value($option, $empty_value = null) {
	$options = WCHAU_Custom_Field::get_options();
	if ( empty( $option ) ) {
		return !isset($empty_value) ? __( 'N/A', 'woocommerce-hear-about-us' ) : $empty_value;
	}

	// for compatibility reasons.
	if(isset($options[$option])) {
		return $options[$option];
	}

	return $option;
}

function wchau_other_field_enabled() {
	return wchau_get_option( 'wchau_other', false ) === 'yes';
}