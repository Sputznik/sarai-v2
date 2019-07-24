<ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.sp-post');?>" data-url="<?php _e( $atts['url'] );?>" class="sp-posts list-unstyled sp-posts-3">
  <?php while( $this->query->have_posts() ) : $this->query->the_post();?>
    <li class="sp-post">
      <?php get_template_part( 'partials/post', 'common'); ?>
    </li>
  <?php endwhile;?>
</ul>
