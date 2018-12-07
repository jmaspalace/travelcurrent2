<?php 

$nodes = node_load_multiple( array(), array( "type" => "article", "status" => "1" ) );
$months = array( "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" );

$month_actual = date( "F" );

$arr_nodes = array( );

foreach( $nodes as $key => $node ){

	$month = date( "F", strtotime( $node->field_date[ "und" ][ 0 ][ "value" ] ) );
	
	$node->field_image["und"][0]["url"] = file_create_url( $node->field_thumbnail_medium["und"][0]["uri"] );
	$node->field_thumbnail_medium["und"][0]["url"] = file_create_url( $node->field_thumbnail_medium["und"][0]["uri"] );
	$node->body["und"][0]["summary"] = substr($node->body["und"][0]["value"], 0, 150);
	$node->link = "/" . drupal_get_path_alias( 'node/' . $node->nid );
	$node->field_thumbnail_small["und"][0]["url"] = file_create_url($node->field_thumbnail_small["und"][0]["uri"]);
	$node->field_thumbnail_medium["und"][0]["url"] = file_create_url($node->field_thumbnail_medium["und"][0]["uri"]);

	if( $key > 0 )
		$node->body["und"][0]["summary"] = substr($node->body["und"][0]["summary"], 0, 50);
	
	$categoria = taxonomy_term_load( $node->field_categoria[ "und" ][0][ "tid" ] );
	$node->field_categoria[ "und" ][0][ "categoria" ] = $categoria->name;

	$arr_nodes[ $month ][ ] = $node;

}

?>
<script>

	<?php
	echo "var wcu_data = " . json_encode($arr_nodes) . "\n";
	echo "var month_actual =  '" . $month_actual . "';";
	?>

</script>

<header class="title-section container">
	<h1>Travel <span>Itinerary</span></h1>
	<div class="line-title blue"></div>
	<div class="container">
	<p>
		<?php 
		$block = module_invoke('block', 'block_view', '3');
		print render($block['content']);
		?>
	</p>
	</div>
</header>

<section class="content">
	<header>
		<div class="container wrapper">
			<ul>
				<?php 
				$active = "";
				foreach( $months as $key => $month ){ 

					if( strstr( $month, $month_actual ) ){
						$active = 'class="active"';
					}

				?>
					<li <?php echo $active ?> ><a><?php echo $month ?></a><span class="line"></span></li>
				<?php 
					$active = "";
				} ?>
			</ul>
		</div>
	</header>
	<div class="section-body container">
		<div class="content-principal col-md-5">
			<article>
				<div class="cont-image">
					<picture>
						<source media="(max-width: 780px)" srcset="">
		  				<img src="" alt="" title="">
					</picture>
					<h3>Food1</h3>
					<div class="shadow"></div>
				</div>
				<div class="cont-description">
					<div class="arrow"></div>
					<p></p>
				</div>
			</article>
		</div>
		
		<div class="general-article col-md-7">
			<article>
				<div class="cont-image">
					<picture>
						<img src="" alt="" title="">
					</picture>
				</div>
				<div class="cont-description">
					<h3></h3>
					<div class="line"></div>
					<p><a href=""></a></p>
				</div>
			</article>
			<article>
				<div class="cont-image">
					<picture>
						<img src="" alt="" title="">
					</picture>
				</div>
				<div class="cont-description">
					<h3></h3>
					<div class="line"></div>
					<p><a href=""></a></p>
				</div>
			</article>
			<article>
				<div class="cont-image">
					<picture>
						<img src="" alt="" title="">
					</picture>
				</div>
				<div class="cont-description">
					<h3></h3>
					<div class="line"></div>
					<p><a href=""></a></p>
				</div>
			</article>
			<article>
				<div class="cont-image">
					<picture>
						<img src="" alt="" title="">
					</picture>
				</div>
				<div class="cont-description">
					<h3></h3>
					<div class="line"></div>
					<p><a href=""></a></p>
				</div>
			</article>
		</div>
	</div>
</section>