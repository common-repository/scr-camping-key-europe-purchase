<?php
/**
 * Settings Page
 *
 * @package SCR\CKE_Purchase
 */
namespace SCR\CKE_Purchase;

class Settings_Page {

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'settings_init' ) );

	}

	/**
		 * Add the Admin Menu Page
		 */
		public function add_admin_menu() {

			add_options_page(
				__( 'Camping Key Europe Purchase', 'scr-cke-purchase' ),
				__( 'CKE Purchase', 'scr-cke-purchase' ),
				'manage_options',
				'scrckep_settings',
				array( $this, 'options_page' )
			);

		}

		/**
		 * Create the Settings Page
		 */
		function settings_init() {

			register_setting( 'scrckep_settings', 'scrckep_settings' );

			add_settings_section(
				'general_settings',
				__( 'Settings', 'scr-cke-purchase' ),
				array( $this, 'settings_section_callback' ),
				'scrckep_settings'
			);

			add_settings_field(
				'scrckep_org_id',
				__( 'Organization ID', 'scr-cke-purchase' ),
				array( $this, 'text_render' ),
				'scrckep_settings',
				'general_settings',
				array(
					'label_for' => 'scrckep_org_id',
					'description' => __( 'From SCR you are given an organization ID. You need to enter it here for this plugin to work.', 'scr-cke-purchase' ),
				)
			);

		}

		/**
		 * Settings Field: Text/Input Callback
		 *
		 * @param $args
		 */
		public function text_render( $args ) {

			$options = get_option( 'scrckep_settings' );
			$value = ( $options[ $args['label_for'] ] ?$options[ $args['label_for'] ] : '' );
			?>
			<input type="text" name="scrckep_settings[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="<?php echo esc_html( $value ); ?>" class="regular-text">
			<?php if ( isset( $args['description'] ) ) : ?>
				<p class="description" id="<?php echo $args['label_for']; ?>-description"><?php echo esc_html( $args['description'] ); ?></p>
			<?php endif; ?>
			<?php

		}

		/**
		 * Main Settings Section Callback
		 */
		function settings_section_callback() {}

		/**
		 * Options Page Display Callback
		 */
		function options_page() {

			?>
			<div id="wrap">
				<h1><?php esc_html_e( 'SCR Camping Key Europe Purchase Settings', 'scr-cke-purchase' ); ?></h1>
				<p><?php esc_html_e( 'This plugin adds all the technical bits for your Camping Key Europe purchase lightbox for WordPress. Just enter your Organization ID below and use the codes to get started.', 'scr-cke-purchase' ); ?></p>

				<div style="max-width:700px;">
					<h2><?php esc_html_e( 'How-to', 'scr-cke-purchase' ); ?></h2>
					<p><?php esc_html_e( 'This plugin gives you a shortcode that can be used anywhere, on pages and in sidebar widgets, to display either a text link or banner to the purchasing iframe.', 'scr-cke-purchase' ); ?></p>
					<p><?php esc_html_e( 'The shortcode be configured with a few parameters, which will control how it show. The langauge parameter is optional, while the text or banner parameter is mandatory.', 'scr-cke-purchase' ); ?></p>

					<h3><?php esc_html_e( 'Text Link', 'scr-cke-purchase' ); ?></h3>
					<p><?php esc_html_e( 'To create a text link, just add the shortcode where you want the link. The text parameter lets you change what the link will say.', 'scr-cke-purchase' ); ?></p>
					<code>[cke_buy_link lang="" text="Buy Camping Key Europe"]</code>

					<h3><?php esc_html_e( 'Image Banner', 'scr-cke-purchase' ); ?></h3>
					<p><?php esc_html_e( 'To create an image banner, you need to use the following shortcode. You may select one of the three banners (1,2 or 3) to enter as an option.', 'scr-cke-purchase' ); ?></p>
					<code>[cke_buy_link lang="" banner="1"]</code>

					<h3><?php esc_html_e( 'Select Language (optional)', 'scr-cke-purchase' ); ?></h3>
					<p><?php esc_html_e( 'By default, the link will try and load the content in the same language that your website is in. If you want to override this, you may set a custom language. We support: Swedish (code: se), German (code: de) and English (code: en)', 'scr-cke-purchase' ); ?></p>
					<code>[cke_buy_link lang="sv" text="Köp Camping Key Europe"]</code>
				</div>

				<form action='options.php' method='post'>

					<?php
					settings_fields( 'scrckep_settings' );
					do_settings_sections( 'scrckep_settings' );
					submit_button();
					?>

				</form>

				<div id="poststuff" style="max-width: 90%;">
					<div id="dpadvert_preview" class="postbox">
						<button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text"><?php esc_html_e( 'Toggle panel: Banners', 'scr-cke-purchase' ); ?></span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span><?php esc_html_e( 'Banners', 'scr-cke-purchase' ); ?></span></h2>
						<div class="inside">
							<p><?php esc_html_e( 'These are the available banners and their respective number code, shown here in English.', 'scr-cke-purchase' ); ?></p>

							<ul style="overflow: hidden; clear: both;">
								<li style="margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #ddd;">
									<p><img src="<?php echo scr-cke-purchase()->get_plugin_url(); ?>/assets/images/en/banner-1.jpg" alt=""></p>
									<p style="font-weight: bold;">Banner <code>1</code></p>
								</li>
								<li style="width: 50%; float: left;">
									<p><img src="<?php echo scr-cke-purchase()->get_plugin_url(); ?>/assets/images/en/banner-2.jpg" alt=""></p>
									<p style="font-weight: bold;">Banner <code>2</code></p>
								</li>
								<li style="width: 50%; float: right;">
									<p><img src="<?php echo scr-cke-purchase()->get_plugin_url(); ?>/assets/images/en/banner-3.jpg" alt=""></p>
									<p style="font-weight: bold;">Banner <code>3</code></p>
								</li>
							</ul>

						</div>
					</div>
				</div>

			</div>
			<?php

		}

}

new Settings_Page;
