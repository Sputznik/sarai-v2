<?php
add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('sarai-child', get_stylesheet_directory_uri().'/style.css', array('sp-core-style'), '1.0.0' );
  wp_enqueue_style( 'sarai', get_stylesheet_directory_uri() .'/assets/css/sarai.css', array( 'sarai-child' ), '1.0.0' );
});



//Add google Comfortaa text font
add_filter( 'sp_list_google_fonts', function( $fonts ){

  $fonts[] = array(
      'slug'	=> 'comfortaa',
      'name'	=> 'Comfortaa',
      'url'	  => 'Comfortaa'
    );

    $fonts[] =array(
      'slug'	=> 'roboto',
      'name'	=> 'Roboto Slab',
      'url'	  => 'Roboto+Slab'
  );
  return $fonts;
} );

/* CHANGE THE ATTRIBUTES PASSED TO THE NAVIGATION MENU */
add_filter('sp_nav_menu_options', function( $sp_nav_menu_options ){

  global $sp_customize;

  $header_type = $sp_customize->get_header_type();

  if( $header_type == 'header4' ){

    $sp_nav_menu_options['container_class'] = 'navbar-collapse collapse';
    $sp_nav_menu_options['container_id']    = 'bs-example-navbar-collapse-1';
    $sp_nav_menu_options['menu_class']      = 'nav navbar-nav top-buffer';

  }

  return $sp_nav_menu_options;
});

// HEADER OPTIONS
add_filter( 'sp_headers_options', function( $headers_arr ){
  $headers_arr['header4'] = 'Sarai Menu';
  return $headers_arr;
} );

add_filter( 'sp_header4_template', function( $template ){
  $template = get_stylesheet_directory().'/partials/header4.php';
  return $template;
} );

// Register side bar for Gallery Space
add_action( 'widgets_init', function(){

  register_sidebar( array(
    'name' 			=> 'Gallery Space',
    'id' 			  => 'gallery-space',
    'description' 	=> 'Appears before the navigation menu',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</aside>',
    'before_title' 	=> '<h3 class="widget-title">',
    'after_title' 	=> '</h3>',
  ) );

});
