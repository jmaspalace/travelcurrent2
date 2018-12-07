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
     	 
     	<picture class="cover-article top">
			<source media="(max-width: 780px)" srcset="<?php echo file_create_url( $node->field_image_mobile[ "und" ][0][ "uri" ] ) ?>">
		  	<img src="<?php echo file_create_url( $node->field_image[ "und" ][0][ "uri" ] ) ?>" alt="<?php echo $node->field_image[ "und" ][0]["alt"] ?>" title="<?php echo $node->field_image[ "und" ][0]["title"] ?>">
		</picture>
 		
 		<div class="author-content">
   			<div class="container">
   				<p class="written-by col-md-7">Presented by <span itemprop="name"> Palace Resorts</span></p>
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
				<img src="<?php echo file_create_url( $node->field_cover_image["und"][0]["field_image"]["und"][0]["uri"] ) ?>" alt="<?php echo $node->field_cover_image["und"][0]["field_image"]["und"][0]["alt"] ?>" title="<?php echo $node->field_cover_image["und"][0]["field_image"]["und"][0]["title"] ?>">
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
											<img src="<?php echo file_create_url( $node->field_gallery["und"][0]["field_image"]["und"][0]["uri"] ) ?>" alt="<?php echo $node->field_gallery["und"][0]["field_image_mobile"]["und"][0]["alt"] ?>" title="<?php echo $node->field_gallery["und"][0]["field_image_mobile"]["und"][0]["title"] ?>">
										</picture>
									</div>
								</div>
							<?php }else{ ?>
								<picture class="main-image col-md-12">
									<source media="(max-width: 780px)" srcset="<?php echo file_create_url( $node->field_gallery["und"][0]["field_image_mobile"]["und"][0]["uri"] ) ?>">
									<img src="<?php echo file_create_url( $node->field_gallery["und"][0]["field_image"]["und"][0]["uri"] ) ?>" alt="<?php echo $node->field_gallery["und"][0]["field_image_mobile"]["und"][0]["alt"] ?>" title="<?php echo $node->field_gallery["und"][0]["field_image_mobile"]["und"][0]["title"] ?>">
								</picture>
							<?php } ?>
						<?php } ?>
						<?php if (!empty($node->field_gallery_left_image["und"][0]["field_image"]["und"][0]["uri"]) && !empty($node->field_gallery_right_image["und"][0]["field_image"]["und"][0]["uri"])){ ?>
							<picture class="small-image col-md-6">
								<img src="<?php echo file_create_url( $node->field_gallery_left_image["und"][0]["field_image"]["und"][0]["uri"] ) ?>" alt="<?php echo $node->field_gallery_left_image["und"][0]["field_image"]["und"][0]["alt"] ?>" title="<?php echo $node->field_gallery_left_image["und"][0]["field_image"]["und"][0]["title"] ?>">
							</picture>

							<picture class="small-image col-md-6">
								<img src="<?php echo file_create_url( $node->field_gallery_right_image["und"][0]["field_image"]["und"][0]["uri"] ) ?>" alt="<?php echo $node->field_gallery_right_image["und"][0]["field_image"]["und"][0]["alt"] ?>" title="<?php echo $node->field_gallery_right_image["und"][0]["field_image"]["und"][0]["title"] ?>">
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
    	
	<?php if(isset($node->field_reservation_banner['und'][0]['taxonomy_term']) && $reservation = $node->field_reservation_banner['und'][0]['taxonomy_term']){?>
		<section class="category-reservation">
			<div class="btn-close-banner"></div>
			<div class="compact-banner">
				<picture class="reservation-img">
					<source media="(max-width: 540px)" srcset="<?php echo file_create_url($reservation->field_imagen_mobile_compacta['und'][0]['uri'])?>">
					<img src="<?php echo file_create_url($reservation->field_imagen_compacta['und'][0]['uri'])?>" alt="" />
				</picture>
			</div>
			<a target="_blank" href="<?php echo $reservation->field_reservation_url['und'][0]['url']?>">
				<picture class="reservation-img">
					<source media="(max-width: 540px)" srcset="<?php echo file_create_url($reservation->field_additional_image_mobile['und'][0]['uri'])?>">
					<img src="<?php echo file_create_url($reservation->field_additional_image['und'][0]['uri'])?>" alt="" />
				</picture>
			</a>
		</section>
	<?php }?>
	
    	<section class="content-map">
    		<div class="container">
    			<div class="wrapper-map col-md-10">
    				<div id="map">
    			</div>
    		</div>
    	</section>
		  
    	<section class="content-tags">
			<div class="container">
				<div class="wrapper-tags col-md-10">
					<h3 class="col-md-2">Tags</h3>
					<ul class="col-md-10">
                        <?php foreach( $node->field_tags[ "und" ] as $tag ){ 
                            $tag = $tag[ "taxonomy_term" ];
                        ?>
                            <li><a href="<?php 
                
                $term_uri = taxonomy_term_uri( $tag->tid ); // get array with path
                $term_title = taxonomy_term_title( $tag->tid );
                
                echo url( $term_uri['path'] . $tag->tid )
                
                ?>"><?php echo $tag->name ?></a></li>
                        <?php } ?>
					</ul>
				</div>
			</div>
		 </section>
      </article>


	      <section class="category-related-block">
	        <div class="general-article container">
	            <h2 class="col-md-12">This Article is related to...</h2>

	            <?php 

	            $i=0;
	            foreach ( $nodes as $key => $value ) { ?>

	                <?php if( $i <= 2 && $value->nid != $node->nid ){ ?>

	                    <article class="col-md-4">
	                        <div class="cont-image">
	                            <img class="image-desktop" src="<?php echo file_create_url( $value->field_thumbnail_small["und"][0]["uri"] ) ?>" alt="<?php echo $value->field_image["und"][0]["alt"] ?>" title="<?php echo $value->field_image["und"][0]["title"] ?>">
	                        </div>
	                        <div class="cont-description">
	                            <h3><a href="/<?php echo drupal_get_path_alias('node/' . $value->nid ); ?>"><?php echo $value->title ?></a></h3>
	                            <div class="line"></div>
	                            <p><a href="/<?php echo drupal_get_path_alias('node/' . $value->nid ); ?>">Read More</a></p>
	                        </div>
	                    </article>
	                <?php 
	                	$i++;
	                } ?>

	            <?php } ?>

	        </div>
	      </section>

      <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1888620791212414";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

      <section class="content-map">
        <div class="fb-comments" data-href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" data-width="100%" data-numposts="5"></div>
      </section>
<script type="application/ld+json">
{ 
	 "@context": "http://schema.org", 
	 "@type": "article",
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
	 "dateModified": "<?php echo format_date($node->changed, 'article') ?>",
	 "description": "<?php echo str_replace("\n", "<br />", $node->field_description_1[ "und" ][ 0 ][ "value" ]); ?>",
	 "articleBody": "<?php echo drupal_html_to_text( str_replace("\n", "<br />", $node->field_paragraph_subtitle[ "und" ][ 0 ][ "field_description_1" ][ "und" ][0][ "value" ]) ) ?>"
 }
</script>