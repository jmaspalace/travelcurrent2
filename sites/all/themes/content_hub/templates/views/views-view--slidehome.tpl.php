<div class="flexslider">
  	<ul class="slides">
<?php

foreach( $view->result as $item ){
	$entity = $item->_field_data[ "nid" ][ "entity" ];
	?>
	<li>
		<picture class="views-field-field-banner">
			<source media="(max-width: 780px)" srcset="<?php echo file_create_url($entity->field_image_mobile["und"][0]["uri"]); ?>">
			<img src="<?php echo file_create_url($entity->field_image["und"][0]["uri"]); ?>" alt="Test.">
		</picture>
		<div class="views-field-field-link">
			<div class="field-content"><a href="<?php echo url( $entity->field_link["und"][0]["url"] ) ?>"><?php echo $entity->field_link["und"][0]["title"] ?></a></div>
		</div>
		<div class="views-field-field-button-position"><?php echo $entity->field_button_position["und"][0]["value"] ?></div>
	</li>
	
	<?php

}

?>
	</ul>
</div>