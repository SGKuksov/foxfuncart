<?php

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
function theme_enqueue_scripts(){
  wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), false, true );
  wp_enqueue_script( 'jquery' );
  wp_register_script('migrate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js', array('jquery'), false, true );
  wp_enqueue_script( 'migrate' );

  wp_register_script( 'main', get_bloginfo('template_url') . '/assets/js/main.js', array(), false, true);
  wp_enqueue_script( 'main' );
  // wp_enqueue_style( 'global', get_bloginfo('template_url') . '/css/global.css');
}

function register_menus() {
	register_nav_menus(
		array(
			'main-nav' => 'Main Navigation',
			'secondary-nav' => 'Secondary Navigation',
			'sidebar-menu' => 'Sidebar Menu'
		)
	);
}
add_action( 'init', 'register_menus' );

function register_widgets(){
	register_sidebar( array(
		'name' => __( 'Sidebar' ),
		'id' => 'main-sidebar',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}//end register_widgets()
add_action( 'widgets_init', 'register_widgets' );

// Подключение обязательных плагинов
require get_template_directory() . '/inc/ffc_add_plugins.php';
