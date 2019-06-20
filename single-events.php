<?php get_header();?>
<div class="container" id="single-post">
  <?php if( have_posts() ): while( have_posts() ): the_post();?>
  <div class="row">
    <div class="col-md-8 col-xs-12">
      <h5 style="margin-top: 26px;color:#777777;">Event</h5>
      <h2 class="project-title"><?php the_title(); ?></h2>
      <!-- Featured Image -->
      <?php if( has_post_thumbnail() ):?>
      <div class='project-featured-image'><?php the_post_thumbnail(); ?></div>
      <?php endif;?>
      <!-- Featured Image ends -->
      <div class="events-meta" style="margin-top:20px; color: #777;">
        <?php global $post;?>
        <p><?php echo get_post_meta( $post->ID, 'event-venue', true );?></p>
        <p><?php echo get_post_meta( $post->ID, 'event-date', true );?></p>
      </div>
      <div class="project-content" style="margin-bottom:30px;"><?php the_content(); ?></div>
      <?php endwhile;endif; ?>
    </div>
    <div class="col-md-3 col-md-offset-1 col-xs-12" id="projects-sidebar">
      <?php if( is_active_sidebar( 'projects' ) ){
            dynamic_sidebar( 'projects' );
      }
      ?>
    </div>
  </div>
</div>
<?php get_footer()?>
