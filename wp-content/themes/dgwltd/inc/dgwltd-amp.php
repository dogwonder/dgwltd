<?php
if ( is_plugin_active( 'amp/amp.php' ) && amp_is_request() ) {
	add_theme_support(
		'amp',
		array(
			'nav_menu_toggle' => array(
				'nav_container_id'           => 'site-navigation',
				'nav_container_toggle_class' => 'toggled-on',
				'menu_button_id'             => 'nav-toggle',
				'menu_button_toggle_class'   => 'toggled-on',
			),
		)
	);
}
