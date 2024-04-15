<?php get_header();?>
<div class="container" style="margin-top: 80px;">
  <div class="row">
    <div class='col-sm-12'>
      <h1 class="text-center" style="text-transform: capitalize;">
        <?php the_archive_title();?>
      </h1>
      <br>
      <?php if (have_posts()) : ?>
      <ul class='orbit-three-grid' style='margin-bottom:50px; padding-left: 0;'>
        <?php while (have_posts()) : the_post(); ?>
        <li class="orbit-article-db orbit-list-db">
          <?php get_template_part('partials/post', 'common');?>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
<div class="container-fluid search-pagination sarai-pagination">
  <div class="container text-center">
    <?php
      the_posts_pagination(
        array(
          'mid_size' 	=> 1,
          'prev_text' => __( '&laquo;' ),
          'next_text' => __( '&raquo;' ),
          'screen_reader_text' => __( ' ' ),
        )
      );
    ?>
  </div>
</div>
<?php get_footer();?>
