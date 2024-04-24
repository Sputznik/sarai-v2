<?php
global $sarai_search_filter;
$post_id = get_the_ID();
$permalink = get_the_permalink();
$thumbnail = get_the_post_thumbnail_url(get_the_ID());
$post_type = get_post_type( $post_id );
$author = function_exists( 'coauthors_posts_links' ) ? coauthors( null, null, null, null, false ) : get_the_author();
?>
<a class="feat-img" <?php if( $thumbnail ){ echo('style="background-image:url('.$thumbnail.')"'); } ?> href="<?php _e( $permalink );?>"></a>
<div class="content-wrap">
  <div>
    <a class="title" href="<?php _e( $permalink );?>"><?php the_title();?></a>
    <div class="post-excerpt"><?php the_excerpt();?></div>
  </div>
	<div class="meta">
    <?php $sarai_search_filter->sarai_get_categories_with_type( $post_id, ucfirst( $post_type ) );?>
    <?php _e( get_the_date( 'M j, Y' ) );?> | <?php _e( ucwords( $author ) );?>
  </div>
</div>
