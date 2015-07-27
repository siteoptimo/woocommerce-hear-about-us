<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WCHAU_Admin_Setting_Fields
 *
 * Handles the WooCommerce Where did you hear about us settings section in the Accounts settings.
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
			'desc'  => __( 'Manage the "where did you hear about us" options.', 'woocommerce-hear-about-us' ),
			'id'    => 'wchau_title'
		);
		array_push( $settings, $title );

		$required = array(
			'title'   => __( 'Make it required', 'woocommerce-hear-about-us' ),
			'id'      => 'wchau_required',
			'type'    => 'checkbox',
			'default' => 'yes',
		);
		array_push( $settings, $required );

		$sourcefields = array(
			'title'    => __( 'Source location', 'woocommerce-hear-about-us' ),
			'desc'     => __( 'Where do you want to source to show?', 'woocommerce-hear-about-us' ),
			'desc_tip' => true,
			'id'       => 'wchau_sourcelocation',
			'type'     => 'select',
			'class'    => 'chosen_select',
			'default'  => 'profiles_and_orders',
			'options'  => array(
				'profiles_and_orders' => __( 'both user profiles and orders', 'woocommerce-hear-about-us' ),
				'profiles_only'       => __( 'user profiles only', 'woocommerce-hear-about-us' ),
				'orders_only'         => __( 'orders only', 'woocommerce-hear-about-us' )
			)
		);

		array_push( $settings, $sourcefields );


        $other = array(
            'title'   => __( 'Allow "other" option?', 'woocommerce-hear-about-us' ),
            'id'      => 'wchau_other',
            'type'    => 'checkbox',
            'default' => 'no',
        );
        array_push( $settings, $other );

		$fields     = apply_filters( 'wchau_settings_fields', array(

			array(
				'title'    => __( 'Label', 'woocommerce-hear-about-us' ),
				'desc'     => __( 'Customize the "where did you hear about us" label.', 'woocommerce-hear-about-us' ),
				'id'       => 'wchau_label',
				'type'     => 'text',
				'default'  => __( 'Where did you hear about us?', 'woocommerce-hear-about-us' ),
				'desc_tip' => true,
			),

			array(
				'title'    => __( 'Label for "other"', 'woocommerce-hear-about-us' ),
				'desc'     => __( 'Customize the "other" label.', 'woocommerce-hear-about-us' ),
				'id'       => 'wchau_label_other',
				'type'     => 'text',
				'default'  => __( 'Other', 'woocommerce-hear-about-us' ),
				'desc_tip' => true,
			),
			array(
				'title'    => __( 'Possible answers', 'woocommerce-hear-about-us' ),
				'desc'     => __( 'List all of the possible answers, one answer per line.', 'woocommerce-hear-about-us' ),
				'id'       => 'wchau_options',
				'type'     => 'textarea',
				'default'  => implode( PHP_EOL, array( 'Google', 'Facebook', 'Twitter', 'A friend', 'Other' ) ),
				'desc_tip' => true,
			)
		) );
		$settings   = array_merge( $settings, $fields );
		$sectionend = array( 'type' => 'sectionend', 'id' => 'wchau_sectionend' );

		array_push( $settings, $sectionend );

		return $settings;
	}
} 