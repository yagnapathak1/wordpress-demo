<?php

namespace GRIM_CEW;

class Gutenberg {
	public function __construct() {
		add_action( 'admin_init', [ $this, 'enable_acf_meta' ] );

		if ( Settings::get_option( 'allow_users' ) ) {
			add_filter( 'use_block_editor_for_post', [ $this, 'disable_block_editor' ], 100, 2 );
			add_filter( 'get_edit_post_link', [ $this, 'set_edit_post_link' ] );
			add_filter( 'edit_form_top', [ $this, 'enable_classic_edit_form_top' ] );

			if ( Settings::get_option( 'edit_links' ) ) {
				add_filter( 'page_row_actions',  [ $this, 'show_edit_links' ], 20, 2 );
				add_filter( 'post_row_actions',  [ $this, 'show_edit_links' ], 20, 2 );
			}

			add_action( 'add_meta_boxes', [ $this, 'add_switcher_meta_box' ], 10, 2 );
			add_action( 'enqueue_block_editor_assets', [ $this, 'add_block_editor_switcher' ] );
		} else {
			$this->enable_classic_editor();
			$this->enable_classic_widgets();
		}
	}

	public function disable_block_editor( $enable_block_editor, $post ) {
		if ( $this->is_classic_editor() ) {
			$enable_block_editor = false;
		}

		return $enable_block_editor;
	}

	public function set_edit_post_link( $link ) {
		if ( $this->is_classic_editor() || Settings::is_classic( 'default_editor' ) ) {
			$link = add_query_arg( 'classic-editor', '', $link );
		}

		return $link;
	}

	public function enable_classic_edit_form_top() {
		if ( Settings::is_classic( 'default_editor' ) ) {
			?>
			<input type="hidden" name="classic-editor" value="" />
			<?php
		}
	}

	public function enable_classic_editor() {
		if ( Settings::is_classic( 'default_editor' ) ) {
			remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );

			add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );
		}
	}

	public function enable_classic_widgets() {
		if ( Settings::is_classic( 'widgets_editor' ) ) {
			add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
			add_filter( 'use_widgets_block_editor', '__return_false' );
		}
	}

	public function show_edit_links( $actions, $post ) {
		if ( array_key_exists( 'classic', $actions ) ) {
			unset( $actions['classic'] );
		}

		if ( 'trash' === $post->post_status || ! post_type_supports( $post->post_type, 'editor' ) ) {
			return $actions;
		}

		$edit_link = get_edit_post_link( $post->ID, 'raw' );
		$title     = _draft_or_post_title( $post->ID );

		if ( ! array_key_exists( 'edit', $actions ) || ! $edit_link ) {
			return $actions;
		}

		$classic_editor = sprintf(
			'<a href="%s" aria-label="%s">%s</a>',
			esc_url( add_query_arg( 'classic-editor', '', $edit_link ) ),
			esc_attr( sprintf( __( 'Edit &#8220;%s&#8221; in the Classic Editor', 'classic-editor-and-classic-widgets' ), $title ) ),
			esc_html__( 'Classic Editor', 'classic-editor-and-classic-widgets' )
		);

		$block_editor = sprintf(
			'<a href="%s" aria-label="%s">%s</a>',
			esc_url( remove_query_arg( 'classic-editor', $edit_link ) ),
			esc_attr( sprintf( __( 'Edit &#8220;%s&#8221; in the Block Editor', 'classic-editor-and-classic-widgets' ), $title ) ),
			esc_html__( 'Block Editor', 'classic-editor-and-classic-widgets' )
		);

		$offset = array_search( 'edit', array_keys( $actions ), true );

		array_splice( $actions, $offset, 1, $block_editor );

		array_unshift($actions, $classic_editor);

		return $actions;
	}

	public function add_switcher_meta_box() {
		add_meta_box(
			'classic-editor-switch',
			__( 'Editor Switcher', 'classic-editor-and-classic-widgets' ),
			[ $this, 'render_switcher_meta_box'],
			null,
			'side',
			'default',
			[
				'__back_compat_meta_box' => true,
			]
		);
	}

	public function render_switcher_meta_box( $post ) {
		$edit_link = remove_query_arg( 'classic-editor', get_edit_post_link( $post->ID, 'raw' ) );
		?>
		<p style="margin: 15px 0;">
			<a href="<?php echo esc_url( $edit_link ); ?>"><?php _e( 'Go to Block Editor', 'classic-editor-and-classic-widgets' ); ?></a>
		</p>
		<?php
	}

	public function add_block_editor_switcher() {
		if ( empty( $GLOBALS['post'] ) ) {
			return;
		}

		wp_enqueue_script(
			'classic-editor-switcher',
			GRIM_CEW_URL . '/assets/js/editor-switcher.js',
			array( 'wp-element', 'wp-components', 'lodash' ),
			'GRIM_CEW_VERSION',
			true
		);

		wp_localize_script(
			'classic-editor-switcher',
			'classicEditorSwitcher',
			array( 'switcherLabel' => __( 'Go to Classic Editor', 'classic-editor-and-classic-widgets' ) )
		);
	}

	public function enable_acf_meta() {
		if ( Settings::get_option( 'acf_support' ) ) {
			add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );
		}
	}

	public function is_classic_editor() {
		return isset( $_REQUEST['classic-editor'] );
	}
}