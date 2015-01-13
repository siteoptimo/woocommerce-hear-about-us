<?php
/*
Plugin Name: WooCommerce Hear About Us
Version: 1.1.0
Plugin URI: http://www.siteoptimo.com/#utm_source=wpadmin&utm_medium=plugin&utm_campaign=wch
Description: Ask where your new customers come from at checkout.
Author: SiteOptimo
Author URI: http://www.siteoptimo.com/
Text Domain: woocommerce-hear-about-us
Domain Path: /i18n/languages/
License: GPL v3

Copyright (C) 2014, SiteOptimo - team@siteoptimo.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	if ( ! class_exists( 'WooCommerce_HearAboutUs' ) ) {
		/**
		 * Main WooCommerce_HearAboutUs Class
		 *
		 * @class WooCommerce_HearAboutUs
		 * @version 1.1.0
		 */
		final class WooCommerce_HearAboutUs {
			/**
			 * @var WooCommerce_HearAboutUs Singleton implementation
			 */
			private static $_instance = null;

			/**
			 * Current version number
			 *
			 * @var string
			 */
			public static $version = "1.1.0";


			/**
			 * Constructor method
			 *
			 * Bootstraps the plugin.
			 */
			function __construct() {
				// Register the autoloader classes.
				spl_autoload_register( array( $this, 'autoload' ) );

				$this->register_scripts();

				$this->includes();

				$this->init();

			}

			/**
			 * Returns an instance of the WooCommerce_HearAboutUs class.
			 *
			 * @return WooCommerce_HearAboutUs
			 */
			public static function instance() {
				if ( is_null( self::$_instance ) ) {
					// Create instance if not set.
					self::$_instance = new self();
				}

				return self::$_instance;
			}

			/**
			 * Autoloads the WooCommerce Hear About Us classes whenever they are needed.
			 *
			 * @param $class
			 */
			public function autoload( $class ) {
				if ( strpos( $class, 'WCHAU_' ) !== 0 ) {
					return;
				}

				$class_exploded = explode( '_', $class );

				$filename = strtolower( implode( '-', $class_exploded ) ) . '.php';

				// first try the directory
				$file = 'includes/' . strtolower( $class_exploded[1] ) . '/' . $filename;

				if ( is_readable( $this->plugin_path() . $file ) ) {
					require_once $this->plugin_path() . $file;

					return;
				}

				// try without a subdirectory
				$filename = strtolower( implode( '-', $class_exploded ) ) . '.php';

				$file = 'includes/' . $filename;

				if ( is_readable( $this->plugin_path() . $file ) ) {
					require_once $this->plugin_path() . $file;

					return;
				}

				return;
			}

			private function includes() {
				require_once $this->plugin_path() . 'includes/wchau-functions.php';
			}

			/**
			 * @return string The plugin URL
			 */
			public function plugin_url() {
				return plugins_url( '/', __FILE__ );
			}

			/**
			 * @return string The plugin path
			 */
			public function plugin_path() {
				return plugin_dir_path( __FILE__ );
			}

			/**
			 * @return string The plugin basename
			 */
			public function plugin_basename() {
				return plugin_basename( __FILE__ );
			}

			/**
			 * Hooks onto the admin_enqueue_scripts hook.
			 */
			private function register_scripts() {
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			}

			/**
			 * Registers, localizes and enqueues the Javascript files.
			 */
			public function admin_enqueue_scripts() {
				wp_enqueue_style( 'wchau-admin-style', $this->plugin_url() . 'assets/css/admin.css' );

				wp_register_script( 'wchau-admin', $this->plugin_url() . 'assets/js/admin.js', array( 'jquery' ), self::$version, true );

				wp_localize_script( 'wchau-admin', 'WCHAU', array( 'plugin_url' => $this->plugin_url() ) );

				wp_enqueue_script( 'wchau-admin' );
			}


			/**
			 * Initialize.
			 */
			private function init() {
				$this->hooks();

				if ( is_admin() ) {
					$this->admin_hooks();

				} else {
					$this->frontend_hooks();
				}
			}

			/**
			 * Enables the needed admin hooks.
			 */
			private function admin_hooks() {
				add_action( 'init', array( $this, 'admin_init' ) );
			}

			/**
			 * Initializes all of the admin classes.
			 */
			public function admin_init() {
				new WCHAU_Admin_Add_Settings_Link();
				new WCHAU_Admin_Setting_Fields();
				new WCHAU_Admin_Display_On_Order();

			}

			/**
			 * Enables the needed frontend hooks.
			 */
			private function frontend_hooks() {
				add_action( 'init', array( $this, 'frontend_init' ) );
			}

			/**
			 * Initializes all of the frontend classes.
			 */
			public function frontend_init() {
			}

			/**
			 * The site-wide hooks.
			 */
			private function hooks() {
				new WCHAU_Custom_Field();

				add_action( 'init', array( $this, 'sitewide_init' ) );
				add_action( 'plugins_loaded', array( $this, 'load_translations' ) );
			}

			/**
			 * Initializes all of the sitewide classes.
			 */
			public function sitewide_init() {
				if ( WCHAU_WPML_Compatibility::wpml_enabled() ) {
					new WCHAU_WPML_Compatibility();
				}
			}

			public function load_translations() {
				load_plugin_textdomain( 'woocommerce-hear-about-us', false, dirname($this->plugin_basename()) . '/i18n/languages/' );
			}
		}

		// Our WooCommerce_HearAboutUs instance.
		$WCHAU = WooCommerce_HearAboutUs::instance();
	}
}