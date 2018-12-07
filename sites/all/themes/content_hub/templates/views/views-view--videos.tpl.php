<div class="container page-search-tag">
	
	<form class="search-mini-form">
		<div class="form-search">
			<h1>Videos</h1>
		</div>
	</form>
		
		<section class="wrapper-content-news col-md-8">
			
			<div class="content-news">

			<?php foreach( $view->result as $key => $node ){ 

				$node_tmp = $node->_field_data[ "nid" ][ "entity" ];

			?>

			<?php if( $key == 0 ){ ?>
  				<article class="content-principal">
  					<a href="/<?php print drupal_get_path_alias( "node/" . $node->nid ); ?>">
  						<div class="wrapper-video">
							<div class="mask-video">
								<div class="play-video embed-video">
									<div class="icon-play"></div>
								</div>
							</div>
							<picture>
								<img src="<?php echo file_create_url( $node_tmp->field_thumbnail_medium[ "und" ][ 0 ][ "uri" ] ) ?>" alt="">
							</picture>	
						</div>	
  					</a>
  					<div class="description">
 						<h2><a href="/<?php echo drupal_get_path_alias( "node/" . $node_tmp->nid ) ?>"><?php echo $node->node_title ?></a></h2>
 						<p><?php echo $node_tmp->field_summary[ "und" ][0]["field_description_1"][ "und" ][0][ "value" ] ?>...</p>
 						<div class="field-link">
 							<a class="button btn-blue btn-medium" href="/<?php print drupal_get_path_alias( "node/" . $node->nid ); ?>">Watch</a>
 						</div>
 					</div>
  				</article>
  			<?php } ?>
  				
  			<?php if( $key >= 1 ){ ?>
  				<article class="general-article">
  					<div class="cont-image col-md-7 col-sm-7">
  						<a href="/<?php print drupal_get_path_alias( "node/" . $node->nid ); ?>">
  							<div class="wrapper-video">
								<div class="mask-video">
									<div class="play-video embed-video">
										<div class="icon-play"></div>
									</div>
								</div>
								<picture>
									<img src="<?php echo file_create_url( $node_tmp->field_thumbnail_medium[ "und" ][ 0 ][ "uri" ] ) ?>" alt="">
								</picture>	
							</div>
  						</a>
  					</div>
 					<div class="description col-md-5 col-sm-5">
 						<h2><a href="/<?php echo drupal_get_path_alias( "node/" . $node_tmp->nid ) ?>"><?php echo $node->node_title ?></a></h2>
 						<p><?php echo drupal_substr( $node_tmp->field_paragraph_subtitle[ "und" ][0]["field_description_1"][ "und" ][0][ "value" ], 0, 90 ) ?>...</p>
 						<div class="field-link">
 							<a class="button btn-blue btn-medium" href="/<?php print drupal_get_path_alias( "node/" . $node->nid ); ?>">Watch</a>
 						</div>
 					</div>
  				</article>

			<?php } ?>

			<?php } ?>

			<?php if ($pager): ?>
		    	<?php print $pager; ?>
		  	<?php endif; ?>

				<!-- ul class="pagination">
					<li class="active first"><a>1</a></li>
				<li><a>2</a></li>
				<li><a>3</a></li>
				<li><a>4</a></li>
				<li class="next last"><a>></a></li>
			</ul -->
			</div>
  	</section>

  	<aside class="col-md-4">

  		<?php 

		echo views_embed_view('home_most_popular', 'block_1');

		?>

  	</aside>
	</div>
