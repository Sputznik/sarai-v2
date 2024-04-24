<div class="archive-search-wrapper">
  <div class="filter-title">
    <span class='fa-icon'><i class="fa fa-filter"></i></span>
    <span>Filters</span>
  </div>
  <form method="GET" class="archive-search" action="<?php _e( $this->getCurrentURL() );?>">
    <div class="sort-wrapper">
      <?php
        // GET ALL THE FILTERS
        $filters = $this->getFilters();

        foreach ( $filters as $key => $atts ) {
          /* SET FORM NAME AND FORM VALUE */
      		$atts['name'] = $atts['typeval'];
      		if( isset( $_GET[ $atts['name'] ] ) ){
      			$atts['value'] = $_GET[ $atts['name'] ];
      		}
          get_template_part('lib/filters/templates/'.$atts['form'], null, $atts);
        }
      ?>
      <ul class="list-inline" data-list="form-btns">
  		<li><button type='submit'>Submit</button></li>
  		<li>or</li>
  		<li><a href="<?php _e( $this->getCurrentURL() );?>" style="text-decoration:underline">Reset</a></li>
  	</ul>
    </div>
  </form>
</div>
