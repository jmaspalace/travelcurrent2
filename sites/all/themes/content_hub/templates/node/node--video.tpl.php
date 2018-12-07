<?php 

function sanitize_coord( $coord ){

	$coord = str_replace(" N", "", $coord);
	$coord = str_replace(" W", "", $coord);

	return $coord;

}

$arr_nodes = taxonomy_select_nodes( $node->field_category["und"][0]["tid"] );

$lat = $node->field_location[ "und" ][ 0 ][ "field_latitude" ][ "und" ][ 0 ][ "value" ];
$long = $node->field_location[ "und" ][ 0 ][ "field_longitude" ][ "und" ][ 0 ][ "value" ];

$nodes = array( );
$Nodes_by_coords = array( );
$nodes_map = array( );

$Nodes_by_coords[] = array( "name" => $node->title, "body" => $node->field_description_1[ "und" ][ 0 ][ "value" ], "lat" => sanitize_coord( $node->field_location[ "und" ][ 0 ][ "field_latitude" ][ "und" ][ 0 ][ "value" ] ), "long" => sanitize_coord( $node->field_location[ "und" ][ 0 ][ "field_longitude" ][ "und" ][ 0 ][ "value" ] ), "image" => file_create_url( $node->field_image_mobile["und"][0]["uri"] ), "link" => drupal_get_path_alias( "node/" . $node->nid ) ) ;;

foreach ($arr_nodes as $key => $value) {
    $node_tmp = node_load( $value );
    $nodes[] = $node_tmp;

    $x2 = sanitize_coord( $node_tmp->field_location[ "und" ][ 0 ][ "field_latitude" ][ "und" ][ 0 ][ "value" ] );
    $y2 = sanitize_coord( $node_tmp->field_location[ "und" ][ 0 ][ "field_longitude" ][ "und" ][ 0 ][ "value" ] );
    
    $sub = sqrt( ( ( $x2 - $long ) * ( $x2 - $long ) ) + ( ( $y2 - $lat ) + ( $y2 - $lat ) ) );
    $Nodes_by_coords[ $sub . "" ] = array( "name" => $node_tmp->title, "body" => $node_tmp->field_description_1[ "und" ][ 0 ][ "value" ], "lat" => sanitize_coord( $x2 ), "long" => sanitize_coord( $y2 ), "image" => file_create_url( $node_tmp->field_image_mobile["und"][0]["uri"] ), "link" => drupal_get_path_alias( "node/" . $node_tmp->nid ) ) ;    
}

ksort( $Nodes_by_coords );

?>
<script>

var nodes = <?php echo json_encode( $Nodes_by_coords ) ?>;

</script>
<?php

$title = $node->title;
if( isset( $node->field_title_highlighted["und"][0]["value"] ) )
	$title = str_replace($node->field_title_highlighted["und"][0]["value"], "<span>".$node->field_title_highlighted["und"][0]["value"]."</span>", $title); 

?>
<script>

</script>
<article class="main">
		<header class="title-section container">
			<h1><?php echo $title ?></h1>
			<div class="line-title blue"></div>
		</header>
     	 
     	<div class="content-share container">
     		<div class="icon-share icon-fb"></div>
     	 	<div class="icon-share icon-twt"></div>
    		<div class="icon-share icon-pt">
    			<a target="_blank" href="https://www.pinterest.com/pin/create/button/?media=<?php echo file_create_url( $node->field_image_mobile[ "und" ][0][ "uri" ] ) ?>&description=<?php echo $node->title; ?> | The Travel Current"></a>
    		</div>
     	</div>
     	
     	<div class="wrapper-video custom-bg-block" bg-mod-d="<?php echo file_create_url( $node->field_image[ "und" ][0][ "uri" ] ) ?>" bg-mod-m="<?php echo file_create_url( $node->field_image_mobile[ "und" ][0][ "uri" ] ) ?>" url-video="<?php echo $node->field_video["und"][0]["video_id"] ?>">
     		<div class="mask-video">
     			<div id="player"></div>
				<!-- <iframe id="id="ytplayer" src="http://www.youtube.com/embed/<?php echo $node->field_video["und"][0]["video_id"] ?>?&autohide=1&showinfo=0;&autoplay=1"></iframe>-->
			</div>
   			<!--<picture class="cover-article top">
				<source media="(max-width: 780px)" srcset="<?php echo file_create_url( $node->field_image_mobile[ "und" ][0][ "uri" ] ) ?>">
				<img src="<?php echo file_create_url( $node->field_image[ "und" ][0][ "uri" ] ) ?>" alt="Test.">
			</picture>-->
     	</div>
   		
   		<div class="author-content">
   			<div class="container">
   				<a href="http://www.palaceresorts.com/"><p class="written-by col-md-7">Presented by <span itemprop="name"> Palace Resorts</span></p></a>
    			<!-- p class="date col-md-7"><time datetime="2017-12-11">December 11, 2017</time></p -->
   			</div>
    	</div>
    	
    	<?php if (!empty($node->field_paragraph_subtitle[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ]) || !empty($node->field_paragraph_subtitle[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ])){ ?>
        	<div class="body-article">
				<div class="container">
					<div class="col-md-7">
						<?php if (!empty($node->field_paragraph_subtitle[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ])){ ?>
							<h3><?php echo $node->field_paragraph_subtitle[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ] ?></h3>
						<?php } ?>
						<?php if (!empty($node->field_paragraph_subtitle[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ])){ ?>
							<p><?php echo str_replace("\n", "<br />", $node->field_paragraph_subtitle[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ]); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
      	<?php } ?>
    	
    	<?php if (!empty($node->field_description_1[ "und" ][ 0 ][ "value" ])){ ?>
    		<div class="quote-article">
				<div class="container">
					<span class="col-md-7">
						<?php echo str_replace("\n", "<br />", $node->field_description_1[ "und" ][ 0 ][ "value" ]); ?>
					</span>
					<div class="icon-quote icon-quote-left"></div>
					<div class="icon-quote icon-quote-right"></div>
				</div>
			</div>
    	<?php } ?>
    	
    	<?php if (!empty($node->field_paragraph_subtitle_2[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ]) || !empty($node->field_paragraph_subtitle_2[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ])){ ?>
        	<div class="body-article">
				<div class="container">
					<div class="col-md-7">
						<?php if (!empty($node->field_paragraph_subtitle_2[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ])){ ?>
							<h3><?php echo $node->field_paragraph_subtitle_2[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ] ?></h3>
						<?php } ?>
						<?php if (!empty($node->field_paragraph_subtitle_2[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ])){ ?>
							<p><?php echo str_replace("\n", "<br />", $node->field_paragraph_subtitle_2[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ]); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
      	<?php } ?>
    	
    	<?php if (!empty($node->field_cover_image[ "und" ][0]["field_image"]["und"][0]["uri"]) && !empty($node->field_cover_image[ "und" ][0]["field_image_mobile"]["und"][0]["uri"])){ ?>
			<picture class="cover-article">
				<source media="(max-width: 780px)" srcset="<?php echo file_create_url( $node->field_cover_image[ "und" ][0]["field_image_mobile"]["und"][0]["uri"] ) ?>">
				<img src="<?php echo file_create_url( $node->field_cover_image[ "und" ][0]["field_image"]["und"][0]["uri"] ) ?>" alt="Test.">
			</picture>
    	<?php } ?>
    	
    	<?php if (!empty($node->field_paragraph_subtitle_3[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ]) || !empty($node->field_paragraph_subtitle_3[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ])){ ?>
        	<div class="body-article">
				<div class="container">
					<div class="col-md-7">
						<?php if (!empty($node->field_paragraph_subtitle_3[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ])){ ?>
							<h3><?php echo $node->field_paragraph_subtitle_3[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ] ?></h3>
						<?php } ?>
						<?php if (!empty($node->field_paragraph_subtitle_3[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ])){ ?>
							<p><?php echo str_replace("\n", "<br />", $node->field_paragraph_subtitle_3[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ]); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
      	<?php } ?>
		
   		<?php if (!empty($node->field_gallery["und"][0]["field_image"]["und"][0]["uri"]) && !empty($node->field_gallery["und"][0]["field_image_mobile"]["und"][0]["uri"]) && !empty($node->field_gallery_left_image["und"][0]["field_image"]["und"][0]["uri"]) && !empty($node->field_gallery_right_image["und"][0]["field_image"]["und"][0]["uri"])){ ?>
			<section class="gallery-article">
				<div class="container">
					<div class="wrapper-gallery col-md-10">
						<?php if (!empty($node->field_gallery["und"][0]["field_image"]["und"][0]["uri"]) && !empty($node->field_gallery["und"][0]["field_image_mobile"]["und"][0]["uri"])){ ?>
							<?php if( isset( $node->field_gallery["und"][0]["field_video"]["und"][0]["video_id"] ) ){ ?>
								<div class="main-video">
									<div class="wrapper-video">
										<div class="mask-video">
											<div class="play-video call-lbox embed-video" url-video="<?php echo $node->field_gallery["und"][0]["field_video"]["und"][0]["video_id"] ?>">
												<div class="icon-play"></div>
											</div>
										</div>
										<picture class="main-image col-md-12">
											<source media="(max-width: 780px)" srcset="<?php echo file_create_url( $node->field_gallery["und"][0]["field_image_mobile"]["und"][0]["uri"] ) ?>">
											<img src="<?php echo file_create_url( $node->field_gallery["und"][0]["field_image"]["und"][0]["uri"] ) ?>" alt="Test.">
										</picture>
									</div>
								</div>
							<?php }else{ ?>
								<picture class="main-image col-md-12">
									<source media="(max-width: 780px)" srcset="<?php echo file_create_url( $node->field_gallery["und"][0]["field_image_mobile"]["und"][0]["uri"] ) ?>">
									<img src="<?php echo file_create_url( $node->field_gallery["und"][0]["field_image"]["und"][0]["uri"] ) ?>" alt="Test.">
								</picture>
							<?php } ?>
						<?php } ?>
						<?php if (!empty($node->field_gallery_left_image["und"][0]["field_image"]["und"][0]["uri"]) && !empty($node->field_gallery_right_image["und"][0]["field_image"]["und"][0]["uri"])){ ?>
							<picture class="small-image col-md-6">
								<img src="<?php echo file_create_url( $node->field_gallery_left_image["und"][0]["field_image"]["und"][0]["uri"] ) ?>" alt="Test.">
							</picture>

							<picture class="small-image col-md-6">
								<img src="<?php echo file_create_url( $node->field_gallery_right_image["und"][0]["field_image"]["und"][0]["uri"] ) ?>" alt="Test.">
							</picture>
						<?php } ?>
					</div>
				</div>
			</section>
        <?php } ?>
    	
    	<?php if (!empty($node->field_paragraph_subtitle_4[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ]) || !empty($node->field_paragraph_subtitle_4[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ])){ ?>
        	<div class="body-article">
				<div class="container">
					<div class="col-md-7">
						<?php if (!empty($node->field_paragraph_subtitle_4[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ])){ ?>
							<h3><?php echo $node->field_paragraph_subtitle_4[ "und" ][ 0 ][ "field_subtitle" ][ "und" ][0][ "value" ] ?></h3>
						<?php } ?>
						<?php if (!empty($node->field_paragraph_subtitle_4[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ])){ ?>
							<p><?php echo str_replace("\n", "<br />", $node->field_paragraph_subtitle_4[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ]); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
      	<?php } ?>
      </article>

<script type="application/ld+json">
{ 
	 "@context": "http://schema.org", 
	 "@type": "VideoObject",
	 "headline": "<?php echo $node->title ?>",
	 "alternativeHeadline": "<?php echo $node->title ?>",
	 "image": "<?php echo file_create_url( $node->field_image[ "und" ][0][ "uri" ] ) ?>",
	 "author": "Palace Resorts", 
	 "editor": "Palace Resorts", 
	 "genre": "search engine optimization", 
	 "publisher": "Palace Resorts",
	 "url": "<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]  ?>",
	 "datePublished": "<?php echo format_date($node->created, 'article') ?>",
	 "dateCreated": "<?php echo format_date($node->created, 'article') ?>",
	 "uploadDate": "<?php echo format_date($node->changed, 'article') ?>",
	 "description": "<?php echo $node->title ?>",
	 "articleBody": "<?php echo drupal_html_to_text( str_replace("\n", "<br />", $node->field_paragraph_subtitle[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ]) ) ?>",
	 "name": "<?php echo $node->title ?>",
	 "thumbnailUrl": "<?php echo file_create_url( $node->field_image[ "und" ][0][ "uri" ] ) ?>"
 }
</script>