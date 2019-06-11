<?php

// Creates a custom post type

add_filter( 'orbit_post_type_vars', function( $post_types ){

	$post_types['projects'] = array(
		'slug' 		=> 'projects',
		'labels'	=> array(
			'name' 					=> 'Projects',
			'singular_name' => 'Project',
      'add_new'       => 'Add New',
      'add_new_item'  => 'Add New Project',
      'all_items'     =>  'All Projects'
		),
		'public'		=> true,
		'supports'	=> array( 'title', 'editor','thumbnail' )
	);

	return $post_types;
} );
