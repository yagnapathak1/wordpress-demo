<?php
use \GRIM_CEW\Vendor\Field;

global $wp_roles;

foreach ( $wp_roles->get_names() as $key => $role ) {
	Field::load(
		'radio',
		[
			'name' => "users_default_editor_$key",
			'label' => esc_html__( 'Default Editor for ', 'classic-editor-and-classic-widgets' ) . "<strong>$role</strong>",
			'description' => esc_html__( 'Default posts/pages editor for ', 'classic-editor-and-classic-widgets' ) . $role,
			'default' => 'classic',
			'fields' => [
				[
					'value' => 'classic',
					'label' => esc_html__( 'Classic Editor', 'classic-editor-and-classic-widgets' ),
				],
				[
					'value' => 'gutenberg',
					'label' => esc_html__( 'Block Editor', 'classic-editor-and-classic-widgets' ),
				],
			],
		]
	);
}
