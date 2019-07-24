<?php get_header();?>
<div class="container" id="single-post">
  <?php if( have_posts() ): while( have_posts() ): the_post();?>
  <div class="row">
    <div class="col-md-7 col-xs-12">
      <h5 style="margin-top: 25px;color:#777777;">Feature</h5>
      <h2 class="single-post-title"><?php the_title(); ?></h2>
      <!-- Featured Image -->
      <?php if( has_post_thumbnail() ):?>
      <div class='single-post-featured-image'><?php the_post_thumbnail(); ?></div>
      <?php endif;?>
      <!-- Featured Image ends -->
      <div class="single-post-content" style="margin-bottom:100px;"><?php the_content(); ?></div>
      <?php endwhile;endif; ?>
    </div>
    <div class="col-md-4 col-md-offset-1 col-xs-12" id="single-post-sidebar" style="padding-top:25px;">
      <?php if( is_active_sidebar( 'single-post-sidebar' ) ){ dynamic_sidebar( 'single-post-sidebar' ); }?>
    </div>
  </div>
</div>
<?php get_footer()?>
