<?php

$vocabulary = taxonomy_vocabulary_machine_name_load( 'categorias' );
$terms = entity_load( 'taxonomy_term', FALSE, array( 'vid' => $vocabulary->vid) );

$term_condition = taxonomy_term_load( $view->query->where[ 1 ][ "conditions" ][ 2 ][ "value" ] );

?>
	<div class="container">
  		<header class="col-md-12">
  			<h1>Lifestyle</h1>
  			<form class="filter-category jqtransform">
  				<select>
  					<?php foreach( $terms as $term ){ ?>
						<option value="<?php echo $term->tid ?>"  <?php echo ( $term->tid == 2 ) ? "selected='selected'" : "" ?>><?php echo $term->name ?></option>
					<?php } ?>
				</select>
  			</form>
		</header>
		<div class="content">
			<?php foreach( $view->result as $entity ){

				$entity = node_load( $entity->nid );
				$term = taxonomy_term_load( $entity->field_categoria[ "und" ][ 0 ][ "tid" ] );

			?>
				<article class="col-md-4">
					<div class="cont-image">
						<picture>
							<img src="<?php echo file_create_url( $entity->field_thumbnail_small["und"][0]["uri"]); ?>" alt="" title="">
						</picture>
						<h3>
							<?php
								$link = url(drupal_get_path_alias('node/' . $entity->nid));
								echo l( $entity->title, $link)
							?>
						</h3>
						<div class="shadow"></div>
					</div>
					<div class="cont-description">
						<div class="arrow"></div>
						<p><?php
							$link = url(drupal_get_path_alias('node/' . $entity->nid));
							echo drupal_substr( $entity->field_summary["und"][0][field_description_1]["und"][0]["value"], 0, 50 ) ?>... <?php echo l( "Read more", $link ) ?>
						</p>
					</div>
				</article>
			<?php } ?>
		</div>
		<footer class="col-md-12">
			<a href="<?php 
                
                $term_uri = taxonomy_term_uri( $term_condition->tid ); // get array with path
                $term_title = taxonomy_term_title( $term_condition->tid );
                
                echo url( $term_uri['path'] . $term_condition->tid )
                
                ?>" class="button btn-blue">View All</a>
		</footer>
  	</div>
  