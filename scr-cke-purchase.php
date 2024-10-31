<?php
/*
 * Plugin Name: SCR Camping Key Europe Purchase
 * Plugin URI:  http://www.scr.se
 * Description: A WordPress plugin to help campsite owners integrate the Camping Key Europe purchase functionality by SCR.
 * Version:     1.0
 * Author:      SCR
 * Author URI:  http://www.scr.se
 * Text Domain: scr-cke-purchase
 * Domain Path: /languages/
 *
 * **************************************************************************
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * **************************************************************************
 *
 * @package SCR\CKE_Purchase
 */

namespace SCR\CKE_Purchase;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Class Plugin
 *
 * @package SCR\CKE_Purchase
 */
class Plugin {

	/**
	 * Plugin URL
	 *
	 * @var string
	 */
	public $plugin_url = '';

	/**
	 * Plugin Directory Path
	 *
	 * @var string
	 */
	public $plugin_dir = '';

	/**
	 * Plugin Version Number
	 *
	 * @var string
	 */
	public $plugin_version = '';


	/**
	 * Plugin Class Instance Variable
	 *
	 * @var object
	 */
	protected static $_instance = null;

	/**
	 * Plugin Instantiator
	 *
	 * @return object
	 */
	public static function instance() {

	    if ( is_null( self::$_instance ) ) {
	    	self::$_instance = new self();
	    }

		return self::$_instance;

	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.2
	 */
	private function __clone() {}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.2
	 */
	private function __wakeup() {}

	/**
	 * Constructor
	 */
	public function __construct() {

		// Set Plugin Version.
		$this->plugin_version = '1.0';

		// Set plugin Directory.
		$this->plugin_dir = untrailingslashit( plugin_dir_path( __FILE__ ) );

		// Set Plugin URL.
		$this->plugin_url = untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) );

		// Load Translations.
		add_action( 'plugins_loaded', array( $this, 'languages' ) );

		// Load scripts and styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );

		// Load Options Page.
		require_once( 'inc/admin/class-settings.php' );

		// Only "activate plugin" when org id is set.
		if ( false !== $this->get_the_organization_id() ) {

			// Load Shortcodes.
			require_once( 'inc/shortcodes/class-shortcode-link.php' );

		}

	}

	/**
	 * Scripts
	 */
	public function scripts() {

		// Enqueue the script.
		// wp_register_script( 'scr-cke', 'https://buy.campingkeyeurope.se/modul/script.js', array( 'jquery' ), $this->get_plugin_version(), true );
		wp_register_script( 'easybox', $this->get_plugin_url() . '/assets/js/easybox.js', array( 'jquery' ), 1.4, true );
		wp_register_script( 'scr-cke', $this->get_plugin_url() . '/assets/js/cke-lightbox.js', array( 'jquery', 'easybox' ), $this->get_plugin_version(), true );

		wp_enqueue_script( 'easybox' );
		wp_enqueue_script( 'scr-cke' );

	}

	/**
	 * Styles
	 */
	public function styles() {

		// Enqueue the style.
		wp_register_style( 'scr-cke', 'https://buy.campingkeyeurope.se/modul/style.css', false, $this->get_plugin_version(), 'screen' );

		wp_enqueue_style( 'scr-cke' );

	}

	/**
	 * Load Translations
	 */
	public function languages() {

		load_plugin_textdomain( 'scr-cke-purchase', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Map Languages
	 *
	 * Maps the SCR supported languages to the
	 * WordPress locales.
	 */
	public function map_languages() {

		// Get current website language.
		$current_language = get_bloginfo( 'language' );

		/**
		 * Depending on the current language,
		 * we map the language codes for the SCR frame.
		 *
		 * We use english as a fallback, should nothing
		 * else be defined.
		 */
		switch ( $current_language ) {

			case 'de_DE':
				$language = 'de';
				break;

			case 'sv_SE':
				$language = 'sv';
				break;

			default:
				$language = 'en';
				break;
		}

		return $language;

	}

	/**
	 * Get the Plugin's Directory Path
	 *
	 * @return string
	 */
	public function get_plugin_dir() {
		return $this->plugin_dir;
	}

	/**
	 * Get the Plugin's Directory URL
	 *
	 * @return string
	 */
	public function get_plugin_url() {
		return $this->plugin_url;
	}

	/**
	 * Get the Plugin's Version
	 *
	 * @return string
	 */
	public function get_plugin_version() {
		return $this->plugin_version;
	}

	/**
	 * Get the Plugin's Asset Directory URL
	 *
	 * @return string
	 */
	public function get_plugin_assets_uri() {
		return $this->plugin_url . '/assets/';
	}

	/**
	 * Get Organization ID
	 *
	 * @return string|bool
	 */
	public function get_the_organization_id() {

		// Get the option options array
		$plugin_options = get_option( 'scrckep_settings' );

		// Get org. id
		$org_id = $plugin_options[ 'scrckep_org_id' ];

		if ( ! empty( $org_id ) ) {
			return $org_id;
		} else {
			return false;
		}

	}

}

function scr_cke_purchase() {
    return Plugin::instance();
}

// Initialize the class instance only once
scr_cke_purchase();
