<div class="sarai-form-group">
	<label><?php _e( $args['label'] );?></label>
	<select name="<?php _e( $args['name'] );?>">
		<option value="">Select</option>
		<?php foreach( $args['items'] as $item ):?>
		<option <?php if( isset( $args['value'] ) && $item['slug'] == $args['value'] ){_e("selected='selected'");}?>  value="<?php _e( $item['slug'] );?>"><?php _e( $item['name'] );?></option>
		<?php endforeach;?>
	</select>
</div>
