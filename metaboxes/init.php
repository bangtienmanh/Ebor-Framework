<?php

if ( ! class_exists( 'cmb2_bootstrap_200beta' ) ) {

	/**
	 * Check for newest version of CMB
	 */
	class cmb2_bootstrap_200beta {

		/**
		 * Current version number
		 * @var   string
		 * @since 1.0.0
		 */
		const VERSION = '2.0.0';

		/**
		 * Current version hook priority
		 * Will decrement with each release
		 *
		 * @var   int
		 * @since 2.0.0
		 */
		const PRIORITY = 9999;

		public static $single = null;

		public static function go() {
			if ( null === self::$single ) {
				self::$single = new self();
			}
			return self::$single;
		}

		private function __construct() {
			add_action( 'init', array( $this, 'include_cmb' ), self::PRIORITY );
		}

		public function include_cmb() {
			if ( ! class_exists( 'CMB2' ) ) {
				if ( ! defined( 'CMB2_VERSION' ) ) {
					define( 'CMB2_VERSION', self::VERSION );
				}
				$this->l10ni18n();
				require_once 'CMB2.php';
			}
		}

		/**
		 * Load CMB text domain
		 * @since  2.0.0
		 */
		public function l10ni18n() {
			$locale = apply_filters( 'plugin_locale', get_locale(), 'cmb2' );
			load_textdomain( 'cmb2', WP_LANG_DIR . '/cmb2/cmb2-' . $locale . '.mo' );
			load_plugin_textdomain( 'cmb2', false, dirname( __FILE__ ) . '/languages/' );
		}

	}
	cmb2_bootstrap_200beta::go();

} // class exists check
