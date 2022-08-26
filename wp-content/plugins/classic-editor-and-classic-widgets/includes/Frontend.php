<?php

namespace GRIM_CEW;

use GRIM_CEW\Vendor\Controller;

class Frontend extends Controller {
	public function __construct() {
		$this->enable_gutenberg_styles();
	}

	public function enable_gutenberg_styles() {
		if ( is_admin() ) {
			return;
		}

		if ( ! Settings::get_option( 'enable_frontend' ) ) {
			wp_dequeue_style('wp-block-library');
			wp_dequeue_style('wp-block-library-theme');
		}
	}
}