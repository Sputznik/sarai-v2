<div id="gallery" class="container">
  <?php if( is_active_sidebar( 'gallery-space' ) ): dynamic_sidebar( 'gallery-space' ); endif; ?>
</div>

<div id="social-main" class="container">
      <?php do_action('sp_logo'); ?>
  <div class="social">
    <ul class="list-inline pull-right">
      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
      <li><a href="#"><i class="fa fa-instagram"></i></a></li>
      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
      <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
      <li><a href="#"><i class="fa fa-search"></i></a></li>
    </ul>
  </div>
</div>
  <nav class="navbar header4">
  	<div class="container">
  		<div class="navbar-header">
  			<button type="button" class="navbar-toggle top-buffer" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  			</button>
        <?php do_action('sp_logo'); ?>
  		</div>
  		<?php do_action('sp_nav_menu');?>
  	</div>
  </nav>
