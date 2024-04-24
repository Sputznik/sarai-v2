<?php

class SARAI_SEARCH_FILTER {

	function __construct(){

		/* LOAD ASSETS */
		add_action('wp_enqueue_scripts', array( $this, 'assets' ) );
		add_shortcode( 'sarai_filter', array( $this, 'filterForm' ) );

	}

	function assets(){
		if( is_page_template("page_archive.php") ){
			//ENQUEUE STYLES
			wp_enqueue_style('sarai-filters-css', SARAI_DIR_URI.'/lib/filters/assets/css/filters.css', array(), SARAI_THEME_VERSION );

			//ENQUEUE SCRIPTS
			wp_enqueue_script( 'sarai-filters-dropdown-js', SARAI_DIR_URI.'/lib/filters/assets/js/dropdown-checkboxes.js', array('jquery'), SARAI_THEME_VERSION, true );
		}
	}

	function sarai_get_categories_with_type( $post_id, $type ){
	  $categories = get_the_category( $post_id );

	  echo '<ul class="category-pills">';
	  if( $categories && count( $categories ) ){
	    foreach ($categories as $cat) {
	      echo '<li>'.$cat->name.'</li>';
	    }
	  }
	  echo '<li>'.$type.'</li>';
	  echo '</ul>';
	}

	// GET ALL THE FILTERS AS ARRAY
	function getFilters(){
		return array(
			array(
				'form' 						=> 'dropdown',
				'typeval'					=> 'type',
				'label'						=> 'Post Type',
				'items'						=> $this->getTypes()
			),
			array(
				'form' 						=> 'dropdown-with-checkboxes',
				'typeval'					=> 'category',
				'label'						=> 'Category',
				'tax_hide_empty'	=> 1,
			),
			array(
				'form' 						=> 'dropdown',
				'typeval'					=> 'y',
				'label'						=> 'Year',
				'items'						=> $this->getTerms('pub_year')
			),
			array(
				'form' 						=> 'dropdown',
				'typeval'					=> 'author',
				'label'						=> 'Author',
				'items'						=> $this->getAuthors(),
			),
			array(
				'form' 						=> 'dropdown',
				'typeval'					=> 'tax_post_tag',
				'label'						=> 'Tag',
				'items'						=> $this->getTerms('post_tag')
			)
		);

	}

	// GETTING CATEGORIES AND SUB-CATEGORIES SEPARATELY OF A TAXONOMY
  function getNestedTerms( $atts ){

    $data = array( 'cats' => array(), 'subcats' => array() );
    $terms = get_terms( array(
      'taxonomy'    => $atts['typeval'],
      'hide_empty'  => $atts['tax_hide_empty'] == 1 ? true : false,
      'orderby'     => 'term_id'
    ) );

    foreach ( $terms as $term ) {
      if( $term->parent ){
        array_push( $data['subcats'], array(
          'name'    => $term->name,
          'slug'    => $term->term_id,
          'parent'  => $term->parent
        ) );
      }
      else{
        array_push( $data['cats'], array(
          'name'    => $term->name,
          'slug'    => $term->term_id,
          'parent'  => $term->parent
        ) );
      }
    }

		// SORT THE TERMS ALPHABETICALLY
    usort( $data['cats'], array( $this, 'locationByName' ) );
    usort( $data['subcats'], array( $this, 'locationByName' ) );
    return $data;
  }


  function locationByName( $a, $b ){
    return strcmp( $a["name"], $b["name"] );
  }

	function getTerms( $term_type ){
		$terms = get_terms( array(
	    'taxonomy'    => $term_type,
			'exclude'			=> 1,
	    'hide_empty'  => $term_type != 'author' ? false : true,
	  ) );

		$new_items = array();

		foreach( $terms as $term ){
			array_push( $new_items, array( 'slug' => $term->slug, 'name'	=> $term->name ) );
		}

		return $new_items;
	}

	function getAuthors(){
		$authors = $this->getTerms('author');
		foreach( $authors as $key => $author ){
			$authors[$key]['name'] = ucwords( str_replace( "-", " ", $author['name'] ) );
		}
		return $authors;
	}

	function getTypes(){
		return array(
			array(
				'slug' => 'events',
				'name' => 'Events'
			),
			array(
				'slug' => 'post',
				'name' => 'Posts'
			),
			array(
				'slug' => 'projects',
				'name' => 'Projects'
			)
		);
	}

	function getCurrentURL(){
    global $wp;

    // get current url with query string.
    $current_url =  home_url( $wp->request );

		// get the position where '/page.. ' text start.
		$pos = strpos( $current_url , '/page' );

    // REMOVE PAGINATION PARAMETERS
    if( $pos !== false ){
      // remove string from the specific postion
      $current_url = substr( $current_url, 0, $pos );
    }

    return $current_url;
  }

	/* SHORTCODE CALLBACK */
	function filterForm( $atts ){
		ob_start();
    include( 'templates/search-filters.php' );
    return ob_get_clean();
	}

}
global $sarai_search_filter;
$sarai_search_filter = new SARAI_SEARCH_FILTER;
