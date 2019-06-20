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

	$post_types['events'] = array(
		'slug' 		=> 'events',
		'labels'	=> array(
			'name' 					=> 'Events',
			'singular_name' => 'Event',
      'add_new'       => 'Add New',
      'add_new_item'  => 'Add New Event',
      'all_items'     => 'All Events'
		),
		'menu_icon'	=> 'dashicons-format-gallery',
		'public'		=> true,
		'supports'	=> array( 'title', 'editor','thumbnail' )
	);

	return $post_types;
} );

add_filter( 'orbit_meta_box_vars', function( $meta_box ){
	$meta_box['events'] = array(
		array(
			'id'			=> 'events-meta-fields',
			'title'		=> 'Additional Fields',
			'fields'	=> array(
				'event-venue' => array(
					'type' => 'text',
					'text' => 'Venue'
				),
				'event-date' => array(
					'type' => 'text',
					'text' => 'Event Date'
				),
			)
		)
	);
	return $meta_box;
});
