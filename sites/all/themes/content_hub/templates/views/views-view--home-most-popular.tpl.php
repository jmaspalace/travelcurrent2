<?php 

$term_condition = taxonomy_term_load( $view->query->where[ 1 ][ "conditions" ][ 2 ][ "value" ] );

?>
<section class="article-most-popular custom-bg-block" bg-mod-d="<?php echo variable_get('seeing_blue_file_most_popular', "") ?>" bg-mod-m="<?php echo variable_get('seeing_blue_file_most_popular_mobile', "") ?>">
  	<div class="container">
  		<header class="col-md-12">
  			<h1><?php echo $view->human_name ?></h1>
  			<div class="line-title white"></div>
		</header>
		<div class="content">

		<?php

		foreach( $view->result as $item ){

			$entity = $item->_field_data[ "nid" ][ "entity" ];
			$term = taxonomy_term_load( $entity->field_categoria[ "und" ][ 0 ][ "tid" ] );

		?>

			<article class="col-md-6 col-xs-12">
				<div class="cont-image">
					<picture>
						<source media="(max-width: 780px)" srcset="<?php echo file_create_url( $entity->field_thumbnail_small[ "und" ][ 0 ][ "uri" ] );  ?>">
		  				<img src="<?php echo file_create_url( $entity->field_thumbnail_medium[ "und" ][ 0 ][ "uri" ] ); ?>" alt="" title="">
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
					<p><?php
						$link = url(drupal_get_path_alias('node/' . $entity->nid));
						echo drupal_substr( $entity->field_summary["und"][0][field_description_1]["und"][0]["value"], 0, 70 ) ?>... <?php echo l( "Read more", $link ) ?>
					</p>
					<!--<div class="content-likes">
						<div class="likes"><span>135</span></div>
						<div class="comments"><span>100</span></div>
					</div>-->
				</div>
			</article>
			
		<?php 

		}

		?>

		</div>
		<!--<footer class="col-md-12">
			<a href="<?php 
                $term_uri = taxonomy_term_uri( $term_condition->tid ); // get array with path
                $term_title = taxonomy_term_title( $term_condition->tid );
                
                echo url( $term_uri['path'] . $term_condition->tid )
                
                ?>" class="button btn-white">View More</a>
		</footer>-->
  	</div>
</section>