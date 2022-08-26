<?php

namespace GRIM_CEW;

use GRIM_CEW\Vendor\Controller;

class Settings extends Controller {
	protected static $settings = 'cew_settings';

	private static $allowed_settings = [
		'default_editor',
		'widgets_editor',
		'allow_users',
		'edit_links',
		'enable_frontend',
		'hide_menu_item',
		'acf_support'
	];

	public static function render_settings_page() {
		if ( isset( $_POST['save_settings'] ) ) {
			self::save_settings( $_POST );
		}

		wp_enqueue_style( 'cew-settings', GRIM_CEW_URL . '/assets/css/settings.css', [], GRIM_CEW_VERSION );
		wp_enqueue_script( 'cew-settings', GRIM_CEW_URL . '/assets/js/scripts.js', ['jquery'], GRIM_CEW_VERSION );

		include_once GRIM_CEW_PATH . '/templates/settings.php';
	}

	public static function filter_settings( $key ) : bool {
		return in_array( $key, self::$allowed_settings ) || 'users_default_editor' === substr( $key, 0, 20 ) ;
	}

	public static function save_settings( $data ) {
		update_option(
			self::$settings,
			array_filter(
				$data,
				[ self::class, 'filter_settings' ],
				ARRAY_FILTER_USE_KEY
			)
		);
	}

	public static function get_settings() {
		return get_option( self::$settings );
	}

	public static function get_option( $option ) {
		$settings = self::get_settings();

		return $settings[ $option ] ?? null;
	}

	public static function is_classic( $option ) {
		return 'gutenberg' !== self::get_option( $option );
	}
}