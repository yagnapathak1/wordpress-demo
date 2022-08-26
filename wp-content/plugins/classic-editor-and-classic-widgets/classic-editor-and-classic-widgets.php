<?php
/**
 * Plugin Name: Classic Editor and Classic Widgets
 * Plugin URI: https://wordpress.org/plugins/classic-editor-and-classic-widgets/
 * Description: Disables Gutenberg editor totally everywhere and enables Classic Editor & Classic Widgets.
 * Author: WPGrim
 * Author URI: https://wpgrim.com/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: classic-editor-and-classic-widgets
 * Version: 1.1.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'GRIM_CEW_VERSION', '1.1.1' );
define( 'GRIM_CEW_FILE', __FILE__ );
define( 'GRIM_CEW_PATH', dirname( GRIM_CEW_FILE ) );
define( 'GRIM_CEW_INCLUDES', GRIM_CEW_PATH . '/includes/' );
define( 'GRIM_CEW_URL', plugin_dir_url( GRIM_CEW_FILE ) );

require_once( GRIM_CEW_INCLUDES . 'autoload.php' );