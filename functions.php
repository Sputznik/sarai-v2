<?php
add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('sarai-child', get_stylesheet_directory_uri().'/style.css', array('sp-core-style'), '1.0.0' );
  wp_enqueue_style( 'sarai', get_stylesheet_directory_uri() .'/assets/css/sarai.css', array( 'sarai-child' ), time() );
});



//Add google Comfortaa text font
add_filter( 'sp_list_google_fonts', function( $fonts ){

  $fonts[] = array(
    'slug'	=> 'comfortaa',
    'name'	=> 'Comfortaa',
    'url'	  => 'Comfortaa'
  );
  return $fonts;
} );
