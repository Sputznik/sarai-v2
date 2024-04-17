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
		'public'		 => true,
		'taxonomies' => array( 'post_tag' ),
		'supports'	 => array( 'title', 'editor','thumbnail', 'author' )
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
		'menu_icon'	 => 'dashicons-format-gallery',
		'public'		 => true,
		'taxonomies' => array( 'category', 'post_tag' ),
		'supports'	 => array( 'title', 'editor','thumbnail' )
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


/* PUSH INTO THE GLOBAL VARS OF ORBIT TAXNOMIES */
add_filter( 'orbit_taxonomy_vars', function( $orbit_tax ){
	$orbit_tax['year']	= array(
		'slug' 			  => 'year',
		'label'			  => 'Year',
		'post_types'	=> array( 'post', 'projects', 'events' )
	);

	$orbit_tax['project-group']	= array(
    'label'			=> 'Project Group',
    'slug' 			=> 'project-group',
    'post_types'	=> array( 'projects' )
  );

	return $orbit_tax;

});
