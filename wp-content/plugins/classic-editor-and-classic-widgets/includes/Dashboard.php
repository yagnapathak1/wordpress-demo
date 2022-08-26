<?php

namespace GRIM_CEW;

use GRIM_CEW\Vendor\Controller;

class Dashboard extends Controller {
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_menu_page' ] );
		add_action( 'admin_menu', [ $this, 'disable_admin_menu' ] );
		add_filter( 'plugin_action_links_' . plugin_basename( GRIM_CEW_FILE ), [ $this, 'plugin_action_links' ] );
	}

	public function admin_menu_page() {
		add_options_page(
			esc_html__( 'Classic Editor & Classic Widgets', 'classic-editor-and-classic-widgets' ),
			esc_html__( 'Classic Editor', 'classic-editor-and-classic-widgets' ),
			'manage_options',
			self::$slug,
			[ Settings::class, 'render_settings_page' ],
			58
		);
	}

	public function disable_admin_menu() {
		if ( Settings::get_option( 'hide_menu_item' ) ) {
			remove_submenu_page( 'options-general.php', self::$slug );
		}
	}

	public function plugin_action_links( $links ) {
		$settings_link = sprintf(
			'<a href="%1$s">%2$s</a>',
			admin_url( 'admin.php?page=' . self::$slug ),
			esc_html__( 'Settings', 'classic-editor-and-classic-widgets' )
		);

		array_push( $links, $settings_link );

		return $links;
	}
}