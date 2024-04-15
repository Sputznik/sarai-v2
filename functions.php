<?php
add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('sarai-child', get_stylesheet_directory_uri().'/style.css', array('sp-core-style'), '1.2.1' );
  wp_enqueue_style( 'sarai', get_stylesheet_directory_uri() .'/assets/css/sarai.css', array( 'sarai-child' ), '1.2.1' );
});

add_action('sp_header', function(){
  _e( '<div class="site-desc"><div class="container" >'.get_bloginfo( 'description' ).'</div></div>' );
},99);

// Include Custom Post Type
include( get_stylesheet_directory().'/cpt/cpt.php' );

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

// Removes [...] from excerpt
add_filter( 'excerpt_more', function(){
 return;
});

//Remove Category prefix from title on archive template
add_filter( 'get_the_archive_title', function ( $title ) {
	if( is_category() ) {
		$title = single_cat_title( '', false );
	}
	return $title;
});

// Shortcode for left column
function left_column( $atts, $content = null ) {
	return '<div class="left-col">' . $content . '</div>';
}
add_shortcode( 'left', 'left_column' );

// Shortcode for right column
function right_column( $atts, $content = null ) {
	return '<div class="right-col">' . $content . '</div>';
}
add_shortcode( 'right', 'right_column' );


/* CHANGE THE ATTRIBUTES PASSED TO THE NAVIGATION MENU */
// add_filter('sp_nav_menu_options', function( $sp_nav_menu_options ){
//
//   global $sp_customize;
//
//   $header_type = $sp_customize->get_header_type();
//
//   if( $header_type == 'header4' ){
//
//     $sp_nav_menu_options['container_class'] = 'collapse navbar-collapse';
//     $sp_nav_menu_options['container_id']    = 'bs-example-navbar-collapse-1';
//     $sp_nav_menu_options['menu_class']      = 'nav navbar-nav navbar-right';
//
//   }
//
//   return $sp_nav_menu_options;
// });

// HEADER OPTIONS
// add_filter( 'sp_headers_options', function( $headers_arr ){
//   $headers_arr['header4'] = 'Sarai Menu';
//   return $headers_arr;
// } );

// add_filter( 'sp_header4_template', function( $template ){
//   $template = get_stylesheet_directory().'/partials/header4.php';
//   return $template;
// } );

// Register side bar for Gallery Space
add_action( 'widgets_init', function(){

  register_sidebar( array(
    'name' 			    => 'Gallery Space',
    'id' 			      => 'gallery-space',
    'description' 	=> 'Appears before the navigation menu',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</aside>',
    'before_title' 	=> '<h3 class="widget-title">',
    'after_title' 	=> '</h3>',
  ) );

  register_sidebar( array(
    'name' 			    => 'Projects',
    'id' 			      => 'projects',
    'description' 	=> 'Shows all project\'s',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</aside>',
    'before_title' 	=> '<h3 class="widget-title">',
    'after_title' 	=> '</h3>',
  ) );

  register_sidebar( array(
    'name' 			    => 'Events',
    'id' 			      => 'events',
    'description' 	=> 'Shows all event\'s',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</aside>',
    'before_title' 	=> '<h3 class="widget-title">',
    'after_title' 	=> '</h3>',
  ) );

  register_sidebar( array(
    'name' 			    => 'Sidebar for Single Post',
    'id' 			      => 'single-post-sidebar',
    'description' 	=> 'Visible for single posts only',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</aside>',
    'before_title' 	=> '<h3 class="widget-title">',
    'after_title' 	=> '</h3>',
  ) );
});

/* SHORTCODE TO RETURN AUTHOR POSTS LINK */
add_shortcode( 'sarai_author_posts_link', function(){
  $html = '<span class="coauthors-link">by ';

  if ( function_exists('coauthors_posts_links') ) {
    $html .= coauthors_posts_links( null, null, null, null, false );
  } else {
    $html .= get_the_author_posts_link();
  }

  $html .= '</span>';
  return $html;
} );

/* SHORTCODE TO RETURN POST PARENT CATEGORIES */
add_shortcode( 'sarai_post_parent_categories', function(){
  $categories = get_the_category( get_the_ID() );
  $parent_terms = array();

  foreach( $categories as $category ){
    if( $category->category_parent === 0 ){
      $parent_cat = '<a href="'.esc_url( get_term_link( $category->term_id ) ) .'">'.esc_html( $category->name ).'</a>';
      array_push( $parent_terms, $parent_cat );
    }
  }

  return count( $parent_terms ) ? implode( ', ', $parent_terms ) : '';

} );
