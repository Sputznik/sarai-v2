<ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.orbit-article');?>" data-url="<?php _e( $atts['url'] );?>" class="list-unstyled list-stories">
  <?php while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li class="orbit-article">
    <?php if( has_post_thumbnail() ):?>
    <div class='orbit-post-image'>
      <?php the_post_thumbnail();?>
    </div>
    <?php endif;?>
    <div class='orbit-post-desc'>
      <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
      <div class="border"></div>
      <div class="orbit-post-excerpt"><?php the_excerpt();?></div>
    </div>
  </li>
  <?php endwhile;?>
</ul>
<style>

.orbit-post-image{
  overflow: hidden;
}
.orbit-post-image img{
  max-width: 100%;
  /* height: auto; */
  max-height: 250px;
  transition: transform 1s, filter 1s;
}


.orbit-post-image:hover img{
  transform: scale(1.5);
  -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
  filter: grayscale(100%);
}
.orbit-post-desc h4{
  margin-top: 0;
  font-size: 22px;
}
a.read-more{
  color: #686868 !important;
  border-bottom: 1px solid #555d66;
  text-decoration: none;
  font-size: 18px;
  display: block;
  width:125px;
}
.orbit-post-excerpt{
  font-size: 16px;
}


@media (min-width:769px){
  ul.list-stories li.orbit-article{
    display: grid;
    grid-template-columns: 350px 1fr;
    grid-gap: 20px;
    margin-bottom: 30px;
  }
}
</style>
