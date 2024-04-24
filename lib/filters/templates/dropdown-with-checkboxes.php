<?php
global $sarai_search_filter;
$terms = $sarai_search_filter->getNestedTerms( $args );
$label = $args['label'];
$parent_field_name = "tax_parent_{$args['typeval']}";
$child_field_name = "tax_child_{$args['typeval']}";

$parent_atts = array(
  'label'						=> $label,
  'name'            => $parent_field_name,
  'items'						=> $terms['cats'],
);

if( isset( $_GET[ $parent_atts['name'] ] ) ){
  $parent_atts['value'] = $_GET[ $parent_atts['name'] ];
}

$child_atts = array(
  'label'						=> 'Sub '.$label,
  'name'            => "tax_child_{$args['typeval']}",
  'items'						=> $terms['subcats'],
  'value'           => isset( $_GET[$child_field_name] ) && $_GET[$child_field_name] ? $_GET[$child_field_name] : array()
);
?>
<div data-behaviour='sarai-nested-dropdown-checkboxes'>
  <div class="cats">
    <?php get_template_part('lib/filters/templates/dropdown', null, $parent_atts);?>
  </div>
  <div class="subcats">
    <?php get_template_part('lib/filters/templates/bt-dropdown-checkboxes', null, $child_atts);?>
  </div>
</div>
