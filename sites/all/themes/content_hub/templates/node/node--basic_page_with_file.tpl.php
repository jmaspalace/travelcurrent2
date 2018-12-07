<?php
$title = $node->title;
if( isset( $node->field_title_highlighted["und"][0]["value"] ) )
	$title = str_replace($node->field_title_highlighted["und"][0]["value"], "<span>".$node->field_title_highlighted["und"][0]["value"]."</span>", $title);
?>



<article class="main">
		<picture class="cover-article top">
			<source media="(max-width: 780px)" srcset="<?php echo file_create_url( $node->field_image_mobile[ "und" ][0][ "uri" ] ) ?>">
		  	<img src="<?php echo file_create_url( $node->field_image[ "und" ][0][ "uri" ] ) ?>" alt="Test.">
		</picture>
		
		<?php if (!empty($node->body[ "und" ][ 0 ][ "value" ])){ ?>
  			<div class="body-article">
				<div class="container">
					<div class="col-md-7">
						<?php echo str_replace("\n", "<br />", $node->body[ "und" ][ 0 ][ "value" ]); ?>
					</div>
				</div>
			</div>
    	<?php } ?>
    	
    	<?php if (!empty($node->field_asset_document_file["und"][0]["uri"])){ ?>
			<footer class="container">
				<a href="<?php echo file_create_url($node->field_asset_document_file["und"][0]["uri"])?>" class="button btn-blue" target="_blank">
					<?php echo $node->field_titulo_link["und"][0]["value"] ?>
				</a>
			</footer>
		<?php } ?>
		
 </article>


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