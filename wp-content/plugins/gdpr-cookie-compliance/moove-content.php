<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Moove_GDPR_Content File Doc Comment
 *
 * @category Moove_GDPR_Content
 * @package   gdpr-cookie-compliance
 * @author    Gaspar Nemes
 */

/**
 * Moove_GDPR_Content Class Doc Comment
 *
 * @category Class
 * @package  Moove_Controller
 * @author   Gaspar Nemes
 */
class Moove_GDPR_Content {
	/**
	 * Global variable used in options
	 *
	 * @var array
	 */
	var $gdpr_options;

	/**
	 * Global variable used for translations
	 *
	 * @var array
	 */
	var $wpml_lang_options;
	/**
	 * Construct
	 */
	function __construct() {
		$this->moove_register_content_elements();
		$options_name 				= $this->moove_gdpr_get_option_name();
		$gdpr_options   			= get_option( $options_name );
		$this->wpml_lang_options 	= $this->moove_gdpr_get_wpml_lang();
		$this->gdpr_options = $gdpr_options;
	}
	/**
	 * Register actions
	 *
	 * @return void
	 */
	public function moove_register_content_elements() {

	}

	/**
	 * Privacy Overview Tab Content
	 *
	 * @return string Filtered Content
	 */
	public function moove_gdpr_get_privacy_overview_content() {
		$_content   = __( '<p>This website uses cookies so that we can provide you with the best user experience possible. Cookie information is stored in your browser and performs functions such as recognising you when you return to our website and helping our team to understand which sections of the website you find most interesting and useful.</p><p>You can adjust all of your cookie settings by navigating the tabs on the left hand side.</p>','gdpr-cookie-compliance' );
		return $_content;
	}

	/**
	 * Strict Necessary Tab Content
	 *
	 * @return string Filtered Content
	 */
	public function moove_gdpr_get_strict_necessary_content() {
		$_content   = __( '<p>Strictly Necessary Cookie should be enabled at all times so that we can save your preferences for cookie settings.</p>','gdpr-cookie-compliance' );
		return $_content;
	}

	/**
	 * Strict Necessary Warning Message
	 *
	 * @return string Filtered Content
	 */
	public function moove_gdpr_get_strict_necessary_warning() {
		$_content = '';
		$lang_options = &$this->wpml_lang_options;
		if ( ! isset( $this->gdpr_options[ 'moove_gdpr_strictly_necessary_cookies_warning'. $lang_options ] ) ) :
			$_content   = __( 'If you disable this cookie, we will not be able to save your preferences. This means that every time you visit this website you will need to enable or disable cookies again.','gdpr-cookie-compliance' );
		endif;
		return $_content;
	}

	/**
	 * Advanced Cookies Tab Content
	 *
	 * @return string Filtered Content
	 */
	public function moove_gdpr_get_advanced_cookies_content() {
		$_content   = __( '<p>This website uses the following additional cookies:</p><p>(List the cookies that you are using on the website here.)</p>','gdpr-cookie-compliance' );
		return $_content;
	}

	/**
	 * Third Party Cookies Tab Content
	 *
	 * @return string Filtered Content
	 */
	public function moove_gdpr_get_third_party_content() {
		$_content   = __( '<p>This website uses Google Analytics to collect anonymous information such as the number of visitors to the site, and the most popular pages.</p><p>Keeping this cookie enabled helps us to improve our website.</p>','gdpr-cookie-compliance' );
		return $_content;
	}

	/**
	 * Cookie Policy Tab Content
	 *
	 * @return string Filtered Content
	 */
	public function moove_gdpr_get_cookie_policy_content() {
		$_content   = __( "<p>More information about our <a href='#' target='_blank'>Cookie Policy</a></p>",'gdpr-cookie-compliance' );
		return $_content;
	}

	/**
	 * Get option name
	 */
	public function moove_gdpr_get_option_name() {
		return 'moove_gdpr_plugin_settings';
	}

	/**
	 * Get strict secondary notice
	 */
	public function moove_gdpr_get_secondary_notice() {
		$_content = '';
		$lang_options = &$this->wpml_lang_options;
		if ( ! isset( $this->gdpr_options[ 'moove_gdpr_modal_strictly_secondary_notice'. $lang_options ] ) ) :
			$_content = __( 'Please enable Strictly Necessary Cookies first so that we can save your preferences!','gdpr-cookie-compliance' );
		endif;
		return $_content;
	}

	/**
	 * Get WMPL language code
	 */
	public function moove_gdpr_get_wpml_lang() {
		if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		  	return '_'.ICL_LANGUAGE_CODE;
		} elseif ( isset( $GLOBALS['q_config']['language'] ) ) {
			return $GLOBALS['q_config']['language'];
		}
		return '';
	}
}
new Moove_GDPR_Content();
