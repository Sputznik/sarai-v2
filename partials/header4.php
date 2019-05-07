<div id="gallery" class="container">
  <?php if( is_active_sidebar( 'gallery-space' ) ): dynamic_sidebar( 'gallery-space' ); endif; ?>
</div>
  <nav class="navbar header4">
  	<div class="container">
  		<div class="navbar-header">
  			<button type="button" class="navbar-toggle top-buffer" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  			</button>
  			<?php do_action('sp_logo');?>
  		</div>

  		<?php do_action('sp_nav_menu');?>

  	</div>
  	<!-- /.container -->
  </nav>
