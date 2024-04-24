<?php
/**
 * Template Name: Archive Page
 *
 */

  get_header();
  $main_tax_query = array();
  $paged = (  get_query_var('paged')  ) ? get_query_var('paged') : 1;
  $args = array(
    'paged'       => $paged,
    'post_status' =>'publish',
    'post_type'   => isset( $_GET['type'] ) && $_GET['type'] != '' ? $_GET['type'] : array('post', 'projects', 'events'),
  );

  // CATEGORY
  if( isset( $_GET['tax_parent_category'] ) && $_GET['tax_parent_category'] ){
    $args['category__in'] = $_GET['tax_parent_category'];
    if( isset( $_GET['tax_child_category'] ) && $_GET['tax_child_category'] ){
      $args['category__in'] = array_merge( array( $args['category__in'] ), $_GET['tax_child_category'] );
    }
  }

  // TAGS
  if( isset( $_GET['tax_post_tag'] ) && $_GET['tax_post_tag'] ){
    $args['tag'] = $_GET['tax_post_tag'];
  }

  // AUTHOR
  if( isset( $_GET['author'] ) && $_GET['author'] ){

    $author_slug = str_replace("cap-", "", $_GET['author']);

    $is_wpuser = get_user_by( 'slug', $author_slug );

    if( $is_wpuser ){
      $args['author_name'] = $author_slug;
    }
    else{

      array_push( $main_tax_query, array(
      'taxonomy' => 'author',
      'field'    => 'slug',
      'terms'    => $_GET['author'],
      ) );

    }

  }

  // YEAR
  if( isset( $_GET['y'] ) && $_GET['y'] ){
    array_push( $main_tax_query, array(
    'taxonomy' => 'pub_year',
    'field'    => 'slug',
    'terms'    => $_GET['y'],
    ) );
  }

  if( !empty( $main_tax_query ) ){
    $args['tax_query'] = $main_tax_query;
  }

  $query = new WP_Query( $args );

  add_filter( 'excerpt_length', function( $length ) { return 26; }, 999 );
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="sarai-search-filter">
        <div class="search-form">
          <?php _e( do_shortcode('[sarai_filter]') );?>
        </div>
        <div class="search-results">
          <?php if( $query->have_posts() ) : $found_posts = $query->found_posts;?>
            <div class="template-archive">
              <h3 class="search-result-heading">Total Post(s) <?php echo '('.$found_posts.')';?></h3>
              <div class="sarai-post-grid">
                <?php while( $query->have_posts() ) : $query->the_post(); ?>
                  <?php $post_type = get_post_type();?>
                  <article class='post-list <?php _e($post_type);?>'>
                    <?php get_template_part('partials/filter');?>
                  </article>
                <?php endwhile;?>
              </div>
              <?php
                $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
                the_posts_pagination(
                  array(
                    'mid_size' 	=> 1,
                    'prev_text' => __( 'Prev' ),
                    'next_text' => __( 'Next' ),
                    'screen_reader_text' => __( ' ' ),
                  )
                );
                wp_reset_postdata();
              ?>
            </div>
          <?php else: ?>
            <h6 class='text-center not-found-txt'>No posts found</h6>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer();?>
