<div class="sp-post-img"><a href="<?php the_permalink();?>"><?php the_post_thumbnail('large');?></a></div>
<div class="sp-post-desc">
  <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
  <div class="border"></div>
  <p><?php the_excerpt();?></p>
</div>
<style>
  .sp-post-img{
    overflow: hidden;
  }
  .sp-post-img img{
    transition: transform 1s, filter 1s;
  }
  .sp-post-img:hover img{
    transform: scale(1.5);
    -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
    filter: grayscale(100%);
  }
  .sp-post-img{
    max-height: 271px;
    overflow: hidden;
  }
  .sp-post img{
    max-width: 100%;
    height: auto;
  }
  @media( min-width: 769px ){
    .sp-posts-3{
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      grid-gap: 20px;
    }
  }

</style>
