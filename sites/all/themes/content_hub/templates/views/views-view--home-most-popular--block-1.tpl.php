<section class="most-popular-section">
	<header>
		<h2>Most Popular</h2>
		<div class="line-title blue"></div>
	</header>
	<?php foreach( $view->result as $item ){ 

		$entity = $item->_field_data[ "nid" ][ "entity" ];

		?>
		<article>
			<div class="cont-image">
				<img src="<?php echo file_create_url( $entity->field_thumbnail_small["und"][0]["uri"] ) ?>" alt="" title="">
			</div>
			<div class="cont-description">
				<h3><a href="/<?php echo drupal_get_path_alias( "node/" . $entity->nid ) ?>"><?php echo $entity->title ?></a></h3>
				<div class="line"></div>
				<p><a href="/<?php echo drupal_get_path_alias( "node/" . $entity->nid ) ?>">Read More</a></p>
			</div>
		</article>
	<?php } ?>
</section>