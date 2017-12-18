<?php
/**
 * A simple object containing properties for fonts.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

/**
 * The Kirki_Fonts object.
 */
final class Kirki_Fonts {

	/**
	 * The mode we'll be using to add google fonts.
	 * This is a todo item, not yet functional.
	 *
	 * @static
	 * @todo
	 * @access public
	 * @var string
	 */
	public static $mode = 'link';

	/**
	 * Holds a single instance of this object.
	 *
	 * @static
	 * @access private
	 * @var null|object
	 */
	private static $instance = null;

	/**
	 * An array of our google fonts.
	 *
	 * @static
	 * @access public
	 * @var null|object
	 */
	public static $google_fonts = null;

	/**
	 * The class constructor.
	 */
	private function __construct() {}

	/**
	 * Get the one, true instance of this class.
	 * Prevents performance issues since this is only loaded once.
	 *
	 * @return object Kirki_Fonts
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Compile font options from different sources.
	 *
	 * @return array    All available fonts.
	 */
	public static function get_all_fonts() {
		$standard_fonts = self::get_standard_fonts();
		$google_fonts   = self::get_google_fonts();

		return apply_filters( 'kirki/fonts/all', array_merge( $standard_fonts, $google_fonts ) );
	}

	/**
	 * Return an array of standard websafe fonts.
	 *
	 * @return array    Standard websafe fonts.
	 */
	public static function get_standard_fonts() {
		$standard_fonts = array(
			'serif' => array(
				'label' => 'Serif',
				'stack' => 'Georgia,Times,"Times New Roman",serif',
			),
			'sans-serif' => array(
				'label'  => 'Sans Serif',
				'stack'  => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
			),
			'monospace' => array(
				'label' => 'Monospace',
				'stack' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
			),
		);
		return apply_filters( 'kirki/fonts/standard_fonts', $standard_fonts );
	}

	/**
	 * Return an array of backup fonts based on the font-category
	 *
	 * @return array
	 */
	public static function get_backup_fonts() {
		$backup_fonts = array(
			'sans-serif'  => 'Helvetica, Arial, sans-serif',
			'serif'       => 'Georgia, serif',
			'display'     => '"Comic Sans MS", cursive, sans-serif',
			'handwriting' => '"Comic Sans MS", cursive, sans-serif',
			'monospace'   => '"Lucida Console", Monaco, monospace',
		);
		return apply_filters( 'kirki/fonts/backup_fonts', $backup_fonts );
	}

	/**
	 * Return an array of all available Google Fonts.
	 *
	 * @return array    All Google Fonts.
	 */
	public static function get_google_fonts() {

		if ( null === self::$google_fonts || empty( self::$google_fonts ) ) {

			$fonts = include_once wp_normalize_path( dirname( __FILE__ ) . '/webfonts.php' );

			$google_fonts = array();
			if ( is_array( $fonts ) ) {
				foreach ( $fonts['items'] as $font ) {
					$google_fonts[ $font['family'] ] = array(
						'label'    => $font['family'],
						'variants' => $font['variants'],
						'subsets'  => $font['subsets'],
						'category' => $font['category'],
					);
				}
			}

			self::$google_fonts = apply_filters( 'kirki/fonts/google_fonts', $google_fonts );

		}

		return self::$google_fonts;

	}

	/**
	 * Dummy function to avoid issues with backwards-compatibility.
	 * This is not functional, but it will prevent PHP Fatal errors.
	 *
	 * @static
	 * @access public
	 */
	public static function get_google_font_uri() {}

	/**
	 * Returns an array of all available subsets.
	 *
	 * @static
	 * @access public
	 * @return array
	 */
	public static function get_google_font_subsets() {
		return array(
			'cyrillic'     => 'Cyrillic',
			'cyrillic-ext' => 'Cyrillic Extended',
			'devanagari'   => 'Devanagari',
			'greek'        => 'Greek',
			'greek-ext'    => 'Greek Extended',
			'khmer'        => 'Khmer',
			'latin'        => 'Latin',
			'latin-ext'    => 'Latin Extended',
			'vietnamese'   => 'Vietnamese',
			'hebrew'       => 'Hebrew',
			'arabic'       => 'Arabic',
			'bengali'      => 'Bengali',
			'gujarati'     => 'Gujarati',
			'tamil'        => 'Tamil',
			'telugu'       => 'Telugu',
			'thai'         => 'Thai',
		);
	}

	/**
	 * Returns an array of all available variants.
	 *
	 * @static
	 * @access public
	 * @return array
	 */
	public static function get_all_variants() {
		return array(
			'100'       => esc_attr__( 'Ultra-Light 100', 'slanted' ),
			'100light'  => esc_attr__( 'Ultra-Light 100', 'slanted' ),
			'100italic' => esc_attr__( 'Ultra-Light 100 Italic', 'slanted' ),
			'200'       => esc_attr__( 'Light 200', 'slanted' ),
			'200italic' => esc_attr__( 'Light 200 Italic', 'slanted' ),
			'300'       => esc_attr__( 'Book 300', 'slanted' ),
			'300italic' => esc_attr__( 'Book 300 Italic', 'slanted' ),
			'400'       => esc_attr__( 'Normal 400', 'slanted' ),
			'regular'   => esc_attr__( 'Normal 400', 'slanted' ),
			'italic'    => esc_attr__( 'Normal 400 Italic', 'slanted' ),
			'500'       => esc_attr__( 'Medium 500', 'slanted' ),
			'500italic' => esc_attr__( 'Medium 500 Italic', 'slanted' ),
			'600'       => esc_attr__( 'Semi-Bold 600', 'slanted' ),
			'600bold'   => esc_attr__( 'Semi-Bold 600', 'slanted' ),
			'600italic' => esc_attr__( 'Semi-Bold 600 Italic', 'slanted' ),
			'700'       => esc_attr__( 'Bold 700', 'slanted' ),
			'700italic' => esc_attr__( 'Bold 700 Italic', 'slanted' ),
			'800'       => esc_attr__( 'Extra-Bold 800', 'slanted' ),
			'800bold'   => esc_attr__( 'Extra-Bold 800', 'slanted' ),
			'800italic' => esc_attr__( 'Extra-Bold 800 Italic', 'slanted' ),
			'900'       => esc_attr__( 'Ultra-Bold 900', 'slanted' ),
			'900bold'   => esc_attr__( 'Ultra-Bold 900', 'slanted' ),
			'900italic' => esc_attr__( 'Ultra-Bold 900 Italic', 'slanted' ),
		);
	}

	/**
	 * Determine if a font-name is a valid google font or not.
	 *
	 * @static
	 * @access public
	 * @param string $fontname The name of the font we want to check.
	 * @return bool
	 */
	public static function is_google_font( $fontname ) {
		return ( array_key_exists( $fontname, self::$google_fonts ) );
	}

	/**
	 * Gets available options for a font.
	 *
	 * @static
	 * @access public
	 * @return array
	 */
	public static function get_font_choices() {
		$fonts = self::get_all_fonts();
		$fonts_array = array();
		foreach ( $fonts as $key => $args ) {
			$fonts_array[ $key ] = $key;
		}
		return $fonts_array;
	}
}
