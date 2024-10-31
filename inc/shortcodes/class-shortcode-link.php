<?php
/**
 * Link Shortcode
 *
 * @package SCR\CKE_Purchase
 */
namespace SCR\CKE_Purchase;

/**
 * Class Shortcode_Link
 *
 * @package SCR\CKE_Purchase
 */
class Shortcode_Link {

	/**
	 * Shortcode_Link Constructor
	 */
	public function __construct() {

		// Add the shortcode.
		add_shortcode( 'cke_buy_link', array( $this, 'shortcode' ) );

	}

	/**
	 * The Shortcode Code
	 *
	 * @return void
	 */
	public function shortcode( $atts ) {

		// Attributes
		$atts = shortcode_atts(
			array(
				'lang' => false,
				'text' => false,
				'banner' => false,
			),
			$atts,
			'cke_buy_link'
		);

		// If we don't have a language set, map the current site language.
		if ( ! $atts['lang'] ) {

			$language = scr-cke-purchase()->map_languages();

			$atts['lang'] = $language;
		}

		// Get the organization ID.
		$org_id = scr-cke-purchase()->get_the_organization_id();

		ob_start(); ?>

		<a href="Javascript://Camping Key Europe" onclick="CampingKeyEurope('<?php echo $org_id; ?>', '<?php echo $atts['lang']; ?>')">
		<?php if ( $atts['text'] ) : ?>
			<?php echo $atts['text']; ?>
		<?php elseif ( $atts['banner'] ) : ?>
			<img src="<?php echo scr-cke-purchase()->get_plugin_url(); ?>/assets/images/<?php echo $atts['lang']; ?>/banner-<?php echo $atts['banner']; ?>.jpg" alt="">
		<?php endif; ?>
		</a>
		<?php
		return ob_get_clean();

	}

}

new Shortcode_Link;
