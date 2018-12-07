<?php

/**
 * @file
 * Default theme implementation to display a term.
 *
 * Available variables:
 * - $name: (deprecated) The unsanitized name of the term. Use $term_name
 *   instead.
 * - $content: An array of items for the content of the term (fields and
 *   description). Use render($content) to print them all, or print a subset
 *   such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $term_url: Direct URL of the current term.
 * - $term_name: Name of the current term.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - taxonomy-term: The current template type, i.e., "theming hook".
 *   - vocabulary-[vocabulary-name]: The vocabulary to which the term belongs to.
 *     For example, if the term is a "Tag" it would result in "vocabulary-tag".
 *
 * Other variables:
 * - $term: Full term object. Contains data that may not be safe.
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $page: Flag for the full page state.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the term. Increments each time it's output.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_taxonomy_term()
 * @see template_process()
 *
 * @ingroup themeable
 */

if( $term->vocabulary_machine_name == "categorias" ){

$vocabulary = taxonomy_vocabulary_machine_name_load( 'subcategoria' );
$terms = entity_load( 'taxonomy_term', FALSE, array( 'vid' => $vocabulary->vid) );

$tree = array();
$tree[ $term->tid ][ "parent" ] = $term;
foreach( $terms as $key => $item ){

	$parent = taxonomy_get_parents( $key );
	$parent = end( $parent );

	if( $term->tid == $item->field_categoria[ "und" ][0][ "tid" ] ){
		
		$tree[ $term->tid ][ "childs" ][] = $item;
			
	}
}

?>
<div class="title-section container">
	<h1><?php echo $term->name ?></h1>
	<div class="line-title blue"></div>
	<p><?php echo $term->description ?></p>
</div>
      
      <?php for( $i = 0 ; $i <= count( $tree[ $term->tid ][ "childs" ] ) ; $i = $i + 4 ){ ?>

      <?php if( isset( $tree[ $term->tid ][ "childs" ][ $i ] ) ){ 

     	$actual = $tree[ $term->tid ][ "childs" ][ $i ];	

      	?>

	      <article class="category-block">
	      	<div class="content-principal left">
	      		<div class="cont-image col-md-7 custom-bg-block" bg-mod-d="<?php echo file_create_url( $actual->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $actual->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>">
					<!--<img class="image-desktop" src="<?php echo file_create_url( $actual->field_image[ "und" ][ 0 ][ "uri" ] );  ?>" alt="" title="">
					<img class="image-mobile" src="<?php echo file_create_url( $actual->field_image_mobile[ "und" ][ 0 ][ "uri" ] );  ?>" alt="" title="">-->
				</div>
	    		<div class="wrapper-description col-md-5">
	    			<div class="cont-description">
						<h2><?php echo $actual->name ?></h2>
						<div class="line"></div>
						<h4><?php echo $actual->field_subtitle[ "und" ][0][ "value" ] ?></h4>
						<p class="description"><?php echo $actual->description ?></p>
						<div class="field-link"><a href="<?php
							$term_uri = taxonomy_term_uri( $actual ); // get array with path
							$term_title = taxonomy_term_title( $actual );
							
							echo url( $term_uri['path'] )  ?>" class="button btn-blue btn-medium">Read More</a></div>
						<div class="arrow"></div>
					</div>
	    		</div>
	      	</div>
	      	<div class="general-article container">
	      	<?php 

	      		$arr_nodes = taxonomy_select_nodes( $actual->tid );

	      		$arr_nodes = array_slice( $arr_nodes, 0, 3 );
	      		foreach( $arr_nodes as $node ){

	      		$node = node_load( $node );
	      		$link = url(drupal_get_path_alias('node/' . $node->nid));

		      	?>

					<section class="col-md-4">
						<div class="cont-image">
							<img src="<?php echo file_create_url( $node->field_thumbnail_small["und"][0]["uri"] ) ?>" alt="" title="">
						</div>
						<div class="cont-description">
							<h3><?php echo $node->title ?></h3>
							<div class="line"></div>
							<p><?php echo l("Read More", $link ) ?></p>
						</div>
					</section>
				
				<?php 

					}

				?>

			</div>
	      	<footer class="container">
				<a href="<?php
							$term_uri = taxonomy_term_uri( $actual ); // get array with path
							$term_title = taxonomy_term_title( $actual );
							
							echo url( $term_uri['path'] )  ?>" class="button btn-blue">See All <?php echo $actual->name ?></a>
			</footer>
	      </article>

      <?php } ?>
      <?php if( isset( $tree[ $term->tid ][ "childs" ][ $i + 1 ] ) ){ 

      	$actual = $tree[ $term->tid ][ "childs" ][ $i + 1 ];

      	$color = "blue";
      	if( $actual->field_title_color["und"][0]["value"] == 0 )
      		$color = "white";

      ?>
      
      <article class="custom-bg-block simple-bg-block <?php echo  $color ?>" bg-mod-d="<?php echo file_create_url( $actual->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $actual->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>">
      	<header class="col-md-12">
			<h2><?php echo $actual->name ?></h2>
			<div class="line-title blue"></div>
		</header>
     	<div class="description">
     		<h3><?php echo $actual->field_subtitle[ "und" ][0][ "value" ] ?></h3>
			<p><?php echo $actual->description ?></p>
     	</div>
     	<footer class="container">
			<a href="<?php
				$term_uri = taxonomy_term_uri( $actual ); // get array with path
				$term_title = taxonomy_term_title( $actual );
				echo url( $term_uri['path'] )  ?>" class="button btn-blue">See All <?php echo $actual->name ?></a>

		</footer>
     	<div class="shadow"></div>
      </article>
      
      <?php } ?>
      <?php if( isset( $tree[ $term->tid ][ "childs" ][ $i + 2 ] ) ){ 

      	$actual = $tree[ $term->tid ][ "childs" ][ $i + 2 ];

      ?>

      <article class="category-block">
      	<div class="content-principal right">
      		<div class="cont-image col-md-7 custom-bg-block" bg-mod-d="<?php echo file_create_url( $actual->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $actual->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>">
			</div>
    		<div class="wrapper-description col-md-5">
    			<div class="cont-description">
					<h2><?php echo $actual->name ?></h2>
					<div class="line"></div>
					<h4><?php echo $actual->field_subtitle[ "und" ][0][ "value" ] ?></h4>
					<p class="description"><?php echo $actual->description ?></p>
					<div class="field-link"><a href="<?php
						$term_uri = taxonomy_term_uri( $actual ); // get array with path
						$term_title = taxonomy_term_title( $actual );

						echo url( $term_uri['path'] )  ?>" class="button btn-blue btn-medium">Read More</a></div>
					<div class="arrow"></div>
				</div>
    		</div>
      	</div>
      	<div class="general-article container">
			
      	<?php

      	$arr_nodes = taxonomy_select_nodes( $actual->tid );
      	$arr_nodes = array_slice( $arr_nodes, 0, 3 );

  		foreach( $arr_nodes as $node ){

  			$node = node_load( $node );

	      	?>
				<section class="col-md-4">
					<div class="cont-image">
						<img src="<?php echo file_create_url( $node->field_thumbnail_small["und"][0]["uri"] ) ?>" alt="" title="">
					</div>
					<div class="cont-description">
						<h3><?php echo $node->title ?></h3>
						<div class="line"></div>
						<p><?php echo l("Read More", "node/" . $node->nid ) ?></p>
					</div>
				</section>
			<?php 

		}

		?>

		</div>
      	<footer class="container">
			<a href="<?php
				
							$term_uri = taxonomy_term_uri( $actual ); // get array with path
							$term_title = taxonomy_term_title( $actual );
							
							echo url( $term_uri['path'] )  ?>" class="button btn-blue">See All <?php echo $actual->name ?></a>
		</footer>
      </article>
      
      <?php } ?>
      <?php if( isset( $tree[ $term->tid ][ "childs" ][ $i + 3 ] ) ){ 

      	$actual = $tree[ $term->tid ][ "childs" ][ $i + 3 ];

      ?>

      <article class="category-block custom-bg-block explore dark" bg-mod-d="/sites/default/files/assets/images/bg-dark-section.jpg" bg-mod-m="/sites/default/files/assets/images/bg-dark-section-m.jpg">
      	<div class="content-principal left">
      		<div class="cont-image col-md-7 custom-bg-block" bg-mod-d="<?php echo file_create_url( $actual->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $actual->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>"></div>
    		<div class="wrapper-description col-md-5">
    			<div class="cont-description">
				    <h2><?php echo $actual->name ?></h2>
					<div class="line"></div>
					<h4><?php echo $actual->field_subtitle[ "und" ][0][ "value" ] ?></h4>
					<p class="description"><?php echo $actual->description ?></p>
					<div class="field-link"><a href="<?php
						$term_uri = taxonomy_term_uri( $actual ); // get array with path
						$term_title = taxonomy_term_title( $actual );

						echo url( $term_uri['path'] )  ?>" class="button btn-white btn-medium">Read More</a></div>
					<div class="arrow"></div>
				</div>
    		</div>
      	</div>
      	<div class="general-article container">

      	<?php

      	$arr_nodes = taxonomy_select_nodes( $actual->tid );
		
		$arr_nodes = array_slice( $arr_nodes, 0, 3 );
  		foreach( $arr_nodes as $node ){

  		$node = node_load( $node );

      	?>

			<section class="col-md-4">
					<div class="cont-image">
						<img src="<?php echo file_create_url( $node->field_thumbnail_small["und"][0]["uri"] ) ?>" alt="" title="">
					</div>
					<div class="cont-description">
						<h3><?php echo $node->title ?></h3>
						<div class="line"></div>
						<p><?php echo l("Read More", "node/" . $node->nid ) ?></p>
					</div>
				</section>
		
		<?php 

		}

		?>

		</div>
      	<footer class="container">
			<a href="/<?php echo drupal_get_path_alias( "taxonomy/term/" . $actual->tid ) ?>" class="button btn-white">See All <?php echo $actual->name ?></a>
		</footer>
      </article>

      <?php } 

      } 


    }else if( $term->vocabulary_machine_name == "subcategoria" ){ 

    	?><div class="category-page"><?php

		$arr_terms = taxonomy_get_tree( 2 );

		$vocabulary = taxonomy_vocabulary_machine_name_load( 'sub_categories' );
		$terms = entity_load( 'taxonomy_term', FALSE, array( 'vid' => $vocabulary->vid) );

		$tree = array();
		$tree[ $term->tid ][ "parent" ] = $term;

		foreach( $terms as $key => $item ){

			$parent = taxonomy_get_parents( $key );
			$parent = end( $parent );

			if( $term->tid == $item->field_category[ "und" ][0][ "tid" ] || $term->tid == $item->field_subcategoria[ "und" ][0][ "tid" ] ){

				$tree[ $term->tid ][ "childs" ][] = $item;
					
			}
		}

		$nodes = node_load_multiple( array(), array( "type" => "article", "status" => "1" ) );
		$month_actual = date( "F" );

		$arr_nodes = array( );
		$arr_nodes_other = array( );

		$arrTags = array( );

		foreach( $nodes as $key => $node ){

			$month = date( "F", strtotime( $node->field_date[ "und" ][ 0 ][ "value" ] ) );

			$node->field_image["und"][0]["url"] = file_create_url( $node->field_image["und"][0]["uri"] );
			$node->field_image_mobile["und"][0]["url"] = file_create_url( $node->field_image_mobile["und"][0]["uri"] );
			$node->body["und"][0]["summary"] = substr($node->body["und"][0]["summary"], 0, 150);

			foreach( $node->field_tags["und"] as $tag )
				$arrTags[ $tag["tid"] ] = $tag["tid"];

			$categoria = taxonomy_term_load( $node->field_categoria[ "und" ][0][ "tid" ] );
			$node->field_categoria[ "und" ][0][ "categoria" ] = $categoria->name;

			$k = 0;
			foreach( $node->field_category[ "und" ] as $item ){

				if( $item[ "tid" ] == $term->tid ){
					$arr_nodes[ ] = $node;
					$k++;
				}

			}

			$j = 0;
			foreach( $node->field_subcategoria[ "und" ] as $item ){

				if( $item[ "tid" ] == $term->tid ){
					$arr_nodes[ ] = $node;
					$i++;
				}

			}

			if( $k == 0 || $j == 0 )
				$arr_nodes_other[] = $node;

		}

		$arrTags = array_slice( $arrTags, 0, 10 );

		/**** CATEGORIAS Y SUBCATEGORIAS ****/

		?>
	
		<div class="banner-category custom-bg-block <?php echo ( $term->field_title_color["und"][0]["value"] == 0 ) ? "white" : "blue" ?>" bg-mod-d="<?php echo file_create_url( $term->field_image[ "und" ][ 0 ][ "uri" ] ) ?>" bg-mod-m="<?php echo file_create_url( $term->field_image_mobile[ "und" ][ 0 ][ "uri" ] ) ?>">
	      	<div class="title-section container">
				<h1><?php echo $term->name ?></h1>
				<div class="line-title blue"></div>
	     	</div>	
      	</div>
      	<?php 

			$first = reset( $tree[$term->tid][ "childs" ] );

			if( $first ){
				$featuredCount = 0;
				foreach( $tree[$term->tid][ "childs" ] as $first ){
				$featuredCount++;
				if($featuredCount > 1) continue;
		?>
      <article class="category-block featured-top">
      	<div class="content-principal left">
      		<div class="cont-image col-md-5 custom-bg-block" bg-mod-d="<?php echo file_create_url( $first->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $first->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>"></div>
    		<div class="wrapper-description col-md-7">
    			<div class="cont-description col-md-5">
					<h2><?php echo $first->name ?></h2>
					<div class="line"></div>
					<!--<div class="content-likes elem-mobile">
						<div class="likes"><span>135</span></div>
						<div class="comments"><span>100</span></div>
					</div>-->
					<h4><?php echo $first->field_subtitle[ "und" ][ 0 ][ "value" ] ?></h4>
					<p class="description"><?php echo $first->field_texto_intro[ "und" ][ 0 ][ "value" ] ?></p>	
					<!-- div class="content-likes">
						<div class="likes"><span>135</span></div>
						<div class="comments"><span>100</span></div>
					</div -->
					<p class="written-by">Presented by <span itemprop="name"> Palace Resorts</span></p>
					<!-- p class="date"><time datetime="2017-12-11">December 11, 2017</time></p -->
					<div class="field-link"><a href="/<?php echo drupal_get_path_alias( 'taxonomy/term/' . $first->tid ); ?>" class="button btn-blue btn-medium">Read More</a></div>
					<div class="arrow"></div>
				</div>
   				
   				<div class="content-tags col-md-5">
   					<h3>Tags</h3>
   					<ul>
   						<?php foreach( $arrTags as $tag ){ 
   							$tag = taxonomy_term_load( $tag );
   						?>
   							<li><a href="/<?php echo drupal_get_path_alias('taxonomy/term/' . $tag->tid ); ?>">
                			<?php echo $tag->name ?></a></li>
   						<?php } ?>
   					</ul>
   				</div>

    		</div>
      	</div>
      </article>
      
      <?php 

      }

  }else{

  	foreach( $arr_nodes as $key => $first ){

  	?>

  		<article class="category-block <?php ( $key == 0 ) ? "featured-top" : "" ?>">
      	<div class="content-principal <?php echo ( $key % 2 == 0 ) ? "left" : "right" ?> ">

      	<?php if( $key == 0 ){ ?>

      		<div class="cont-image col-md-5 custom-bg-block" bg-mod-d="<?php echo file_create_url( $first->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $first->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>"></div>

      	<?php }else{ ?>

      		<div class="cont-image col-md-7 custom-bg-block" bg-mod-d="<?php echo file_create_url( $first->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $first->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>"></div>

      	<?php } ?>

      		<?php if( $key == 0 ){ ?>

    		<div class="wrapper-description col-md-7">
    			<div class="cont-description col-md-5">

    		<?php }else{ ?>

    		<div class="wrapper-description col-md-5">
    			<div class="cont-description">

    		<?php } ?>

					<h2><?php echo $first->title ?></h2>
					<div class="line"></div>
					<!--<div class="content-likes elem-mobile">
						<div class="likes"><span>135</span></div>
						<div class="comments"><span>100</span></div>
					</div>-->
					<h4><?php echo $first->field_subtitle[ "und" ][ 0 ][ "value" ] ?></h4>
					<p class="description"><?php echo $first->field_texto_intro[ "und" ][ 0 ][ "value" ] ?></p>	
					<!-- div class="content-likes">
						<div class="likes"><span>135</span></div>
						<div class="comments"><span>100</span></div>
					</div -->
					<p class="written-by">Presented by <span itemprop="name"> Palace Resorts</span></p>
					<!-- p class="date"><time datetime="2017-12-11">December 11, 2017</time></p -->
					<div class="field-link"><a href="/<?php echo drupal_get_path_alias( 'node/' . $first->nid ); ?>" class="button btn-blue btn-medium">Read More</a></div>
					<div class="arrow"></div>
				</div>
   				
				<?php if( $key == 0 ){ ?>

	   				<div class="content-tags col-md-5">
	   					<h3>Tags</h3>
	   					<ul>
	   						<?php foreach( $arrTags as $tag ){ 
	   							$tag = taxonomy_term_load( $tag );
	   						?>
	   							<li><a href="/<?php echo drupal_get_path_alias('taxonomy/term/' . $tag->tid ); ?>">
	                			<?php echo $tag->name ?></a></li>
	   						<?php } ?>
	   					</ul>
	   				</div>

	   			<?php } ?>

    		</div>
      	</div>
      </article>

  	<?php

  	}

  }

      /*

      <section class="wcu-category-block">
      	<div class="container">
      		<article class="content-principal col-md-8">
				<div class="cont-image">
					<picture>
						<source media="(max-width: 780px)" srcset="<?php echo file_create_url( $arr_nodes[0]->field_thumbnail_mobile["und"][0]["uri"]) ?>">
						<img src="<?php echo file_create_url( $arr_nodes[0]->field_thumbnail_medium["und"][0]["uri"]) ?>" alt="Test." title="">
					</picture>
				</div>
				<div class="cont-description">
					<div class="description">
						<h2><?php echo $arr_nodes[0]->title ?></h2>
						<p><?php echo $arr_nodes[0]->field_summary["und"][0][field_description_1]["und"][0]["value"] ?></p>
					</div>
					<div class="content-likes">
						<div class="likes"><span>135</span></div>
						<div class="comments"><span>100</span></div>
						<div class="field-link"><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes[0]->nid ); ?>" class="button btn-white btn-medium">Read More</a></div>
					</div>
				</div>
			</article>
			 
			 <section class="col-md-4">
				<header>
					<h2>What's <span>Coming up?</span></h2>
					<div class="line-title blue"></div>
				</header>
				<form class="filter-category jqtransform">
					<select>
					<?php foreach( $arr_terms as $item ){ ?>
							<option value="<?php echo drupal_get_path_alias( "taxonomy/temr/" . $item->tid ) ?>"><?php echo $item->name ?></option>
					<?php } ?>
					</select>
				</form>
				<article>
					<div class="cont-image">
						<img src="<?php echo file_create_url( $arr_nodes[1]->field_thumbnail_small[ "und" ][ 0 ][ "uri" ] ) ?>" alt="" title="">
					</div>
					<div class="cont-description">
						<h3><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes[1]->nid ); ?>"><?php echo $arr_nodes[1]->title ?></a></h3>
						<div class="line"></div>
						<p><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes[1]->nid ); ?>">Read More</a></p>
					</div>
				</article>
				<article>
					<div class="cont-image">
						<img src="<?php echo file_create_url( $arr_nodes[2]->field_thumbnail_small[ "und" ][ 0 ][ "uri" ] ) ?>" alt="" title="">
					</div>
					<div class="cont-description">
						<h3><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes[2]->nid ); ?>"><?php echo $arr_nodes[2]->title ?></a></h3>
						<div class="line"></div>
						<p><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes[2]->nid ); ?>">Read More</a></p>
					</div>
				</article>
				<article>
					<div class="cont-image">
						<img src="<?php echo file_create_url( $arr_nodes[3]->field_thumbnail_small[ "und" ][ 0 ][ "uri" ] ) ?>" alt="" title="">
					</div>
					<div class="cont-description">
						<h3><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes[3]->nid ); ?>"><?php echo $arr_nodes[3]->title ?></a></h3>
						<div class="line"></div>
						<p><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes[3]->nid ); ?>">Read More</a></p>
					</div>
				</article>
			 </section>
      	</div>
      </section>
     
      

      	<?php */

			$second = $tree[$term->tid][ "childs" ][ 1 ];

			if( $second->name ){

		?>
      <article class="category-block">
      	<div class="content-principal right">
      		<div class="cont-image col-md-7 custom-bg-block" bg-mod-d="<?php echo file_create_url( $second->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $second->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>"></div>
    		<div class="wrapper-description col-md-5">
    			<div class="cont-description">
					<h2><?php echo $second->name ?></h2>
					<div class="line"></div>
					<h4><?php echo $second->field_subtitle[ "und" ][ 0 ][ "value" ] ?></h4>
					<p class="description"><?php echo $second->field_texto_intro[ "und" ][ 0 ][ "value" ] ?></p>	
					<div class="field-link"><a href="/<?php echo drupal_get_path_alias( 'taxonomy/term/' . $second->tid ); ?>" class="button btn-blue btn-medium">Read More</a></div>
					<div class="arrow"></div>
				</div>
    		</div>
      	</div>
      </article>
      <?php 
      	}
      ?>
      
      <?php for( $i = 2 ; $i < count( $tree[ $term->tid][ "childs" ] ) ; $i++ ){ 

      	$actual = $tree[$term->tid][ "childs" ][ $i ];

      	if( $i % 2 == 0 ){

      ?>

	      <article class="category-block">
	      	<div class="content-principal left">
	      		<div class="cont-image col-md-7 custom-bg-block" bg-mod-d="<?php echo file_create_url( $actual->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $actual->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>">
					
				</div>
	    		<div class="wrapper-description col-md-5">
	    			<div class="cont-description">
						<h2><?php echo $actual->name ?></h2>
						<div class="line"></div>
						<div class="content-likes elem-mobile">
							<div class="likes"><span>135</span></div>
							<div class="comments"><span>100</span></div>
						</div>

						<h4><?php echo $actual->field_subtitle[ "und" ][ 0 ][ "value" ] ?></h4>
						<p class="description"><?php echo $actual->field_texto_intro[ "und" ][ 0 ][ "value" ] ?></p>	
						<div class="content-likes">
							<div class="likes"><span>135</span></div>
							<div class="comments"><span>100</span></div>
						</div>
						<p class="date"><time datetime="2017-12-11">December 11, 2017</time></p>
						<div class="field-link"><a href="/<?php echo drupal_get_path_alias( "taxonomy/term/" . $actual->tid ) ?>" class="button btn-blue btn-medium">Read More</a></div>
						<div class="arrow"></div>
					</div>
	    		</div>
	      	</div>
	      </article>
      
      <?php 

      	}else{

      		?>

	      <article class="category-block">
	      	<div class="content-principal right">
	      		<div class="cont-image col-md-7 custom-bg-block" bg-mod-d="<?php echo file_create_url( $actual->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $actual->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>">
					
				</div>
	    		<div class="wrapper-description col-md-5">
	    			<div class="cont-description">
						<h2><?php echo $actual->name ?></h2>
						<div class="line"></div>
						<div class="content-likes elem-mobile">
							<div class="likes"><span>135</span></div>
							<div class="comments"><span>100</span></div>
						</div>

						<h4><?php echo $actual->field_subtitle[ "und" ][ 0 ][ "value" ] ?></h4>
						<p class="description"><?php echo $actual->field_texto_intro[ "und" ][ 0 ][ "value" ] ?></p>	
						<div class="content-likes">
							<div class="likes"><span>135</span></div>
							<div class="comments"><span>100</span></div>
						</div>
						<p class="date"><time datetime="2017-12-11">December 11, 2017</time></p>
						<div class="field-link"><a href="/<?php echo drupal_get_path_alias( "taxonomy/term/" . $actual->tid ) ?>" class="button btn-blue btn-medium">Read More</a></div>
						<div class="arrow"></div>
					</div>
	    		</div>
	      	</div>
	      </article>
      
      <?php 

      	}

      } ?>

      <?php if( isset( $arr_nodes_other[ 0 ] ) ){ ?>
      <section class="category-related-block">
      	<div class="general-article container">
      		<h2 class="col-md-12">This Article is related to...</h2>
      		<?php for( $i = 0 ; $i <= 2 ; $i++ ){ ?>
      			<?php if( isset( $arr_nodes_other[ $i ] ) ){ ?>
					<article class="col-md-4">
						<div class="cont-image">
							<img class="image-desktop" src="<?php echo file_create_url( $arr_nodes_other[$i]->field_thumbnail_small["und"][0]["uri"] ) ?>" alt="" title="">
						</div>
						<div class="cont-description">
							<h3><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes_other[$i]->nid ); ?>"><?php echo $arr_nodes_other[$i]->title ?></a></h3>
							<div class="line"></div>
							<p><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes_other[$i]->nid ); ?>">Read More</a></p>
						</div>
					</article>
				<?php } ?>
			<?php } ?>
		</div>
      </section>
      <?php } ?>
      
      
   
<?php }else if( $term->vocabulary_machine_name == "tags" ){ 

	$arr_nodes = taxonomy_select_nodes( $term->tid );

?>

	<div class="container page-search-tag">
     		<form class="search-mini-form">
     			<div class="form-search">
     				<h1><?php echo $term->name ?></h1>
     			</div>
     		</form>
     		
      		<section class="wrapper-content-news col-md-8">
      			
      			<div class="content-news">

      			<?php foreach( $arr_nodes as $key => $node ){ 

      				$node = node_load( $node );

      			?>

      				<?php if( $key == 0 ){ ?>
	      				<article class="content-principal">
	      					<picture>
								<img src="<?php echo file_create_url( $node->field_thumbnail_medium[ "und" ][ 0 ][ "uri" ] ) ?>" alt="">
							</picture>
	     					<div class="description">
	     						<h2><a href="/<?php echo drupal_get_path_alias( "node/" . $node->nid ) ?>"><?php echo $node->title ?></a></h2>
	     						<p><?php echo $node->field_summary[ "und" ][0][field_description_1][ "und" ][0][ "value" ] ?>...<a href="<?php print $url; ?>"> Read More</a></p>
	     					</div>
	      				</article>
	      			<?php } ?>
	      				
	      			<?php if( $key >= 1 ){ ?>
	      				<article class="general-article">
	      					<div class="cont-image col-md-7 col-sm-7">
	      						<picture>
									<img src="<?php echo file_create_url( $node->field_thumbnail_medium[ "und" ][ 0 ][ "uri" ] ) ?>" alt="">
								</picture>
	      					</div>
	     					<div class="description col-md-5 col-sm-5">
	     						<h2><a href="/<?php echo drupal_get_path_alias( "node/" . $node->nid ) ?>"><?php echo $node->title ?></a></h2>
	     						<p><?php echo drupal_substr( $node->field_summary[ "und" ][0][field_description_1][ "und" ][0][ "value" ], 0, 90 ) ?>...<a href="<?php print $url; ?>"> Read More</a></p>
	     					</div>
	      				</article>

      				<?php } ?>

      			<?php } ?>

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
      	</div>

<?php }else if( $term->vocabulary_machine_name == "sub_categories" ){ 

	?><div class="category-page"><?php

		$arr_terms = taxonomy_get_tree( 2 );

		$tree = array();
		$tree[ $term->tid ][ "parent" ] = $term;
		
		//$nodes = node_load_multiple( array(), array( "type" => "article", "status" => "1" ) );

		$query = new EntityFieldQuery();
		  $query->entityCondition('entity_type', 'node')
		    ->propertyCondition('status', 1)
		    ->propertyCondition('type', array('article'))
		    ->propertyOrderBy('created', 'DESC');
		  $nodes = $query->execute();

		$month_actual = date( "F" );

		$arr_nodes = array( );
		$arr_nodes_ppal = array( );
		$arrTags = array( );
		$arr_nodes_other = array( );

		/*
		$parent_name = "";
		if( $term->field_category[ "und" ][0][ "taxonomy_term" ]->name == "Mexico" || $term->field_category[ "und" ][0][ "taxonomy_term" ]->name == "Jamaica" )
			$parent_name = "About " . $term->field_category[ "und" ][0][ "taxonomy_term" ]->name;
		*/

		foreach( $nodes[ "node" ] as $key => $node ){

			$node = node_load( $node->nid );

			$month = date( "F", strtotime( $node->field_date[ "und" ][ 0 ][ "value" ] ) );

			$node->field_image["und"][0]["url"] = file_create_url( $node->field_image["und"][0]["uri"] );
			$node->field_image_mobile["und"][0]["url"] = file_create_url( $node->field_image_mobile["und"][0]["uri"] );
			$node->body["und"][0]["summary"] = substr($node->body["und"][0]["summary"], 0, 150);
			
			$categoria = taxonomy_term_load( $node->field_categoria[ "und" ][0][ "tid" ] );
			$node->field_categoria[ "und" ][0][ "categoria" ] = $categoria->name;

			$arr_nodes[ $month ][ ] = $node;

			foreach( $node->field_tags["und"] as $tag ){
				$arrTags[ $tag["tid"] ] = $tag["tid"];
			}

			$related = false;
			foreach( $node->field_subcategoria["und"] as $cat ){

				if( ( $cat[ "tid" ] == $term->tid ) && $node->field_category["und"][0]["tid"]){

					$arr_nodes_ppal[ ] = $node;

				}else if( !$related ){
	 
					//Related articles
					$arr_nodes_other[] = $node;
					$related = true;

				}

			}

		}

		$arrTags = array_slice( $arrTags, 0, 10 );
		$arr_nodes = $arr_nodes[ $month_actual ];

		/**** CATEGORIAS Y SUBCATEGORIAS ****/

		?>
	
		<div class="banner-category custom-bg-block <?php echo ( $term->field_title_color["und"][0]["value"] == 0 ) ? "white" : "blue" ?>" bg-mod-d="<?php echo file_create_url( $term->field_image[ "und" ][ 0 ][ "uri" ] ) ?>" bg-mod-m="<?php echo file_create_url( $term->field_image_mobile[ "und" ][ 0 ][ "uri" ] ) ?>">
	      	<div class="title-section container">
				<h1><?php echo $term->name ?></h1>
				<div class="line-title blue"></div>
	     	</div>	
      	</div>
      
      	<?php 
			
		
      	for( $i = 0 ; $i <= 20 ; $i++ ){

			$first = array_values($arr_nodes_ppal)[$i];

			if( $first->title ){

				if( $i == 0 ){

					?>
			      	<article class="category-block featured-top">
			      	<div class="content-principal <?php if( $i % 2 == 0 ) echo "left"; else echo "right"; ?>">
			      		<div class="cont-image col-md-5 custom-bg-block" bg-mod-d="<?php echo file_create_url( $first->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $first->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>">
						</div>
			    		<div class="wrapper-description col-md-7">
			    			<div class="cont-description col-md-5">
								<h2><?php echo $first->title ?></h2>
								<div class="line"></div>
								<div class="content-likes elem-mobile">
									<div class="likes"><span>135</span></div>
									<div class="comments"><span>100</span></div>
								</div>
								<h4><?php echo $first->field_summary[ "und" ][0][ "field_subtitle" ][ "und" ][ 0 ][ "value" ] ?></h4>
								<p class="description"><?php echo $first->field_summary[ "und" ][0][ "field_description_1" ][ "und" ][ 0 ][ "value" ] ?></p>	
								<!-- div class="content-likes">
									<div class="likes"><span>135</span></div>
									<div class="comments"><span>100</span></div>
								</div -->
								<!-- p class="written-by">Presented by <span itemprop="name"> Palace Resorts</span></p-->
								<!-- p class="date"><time datetime="2017-12-11">December 11, 2017</time></p -->
								<div class="field-link"><a href="/<?php echo drupal_get_path_alias( 'node/' . $first->nid ); ?>" class="button btn-blue btn-medium">Read More <?php echo $parent_name ?></a></div>
								<div class="arrow"></div>
							</div>
			   				
			   				<?php if( $i == 0 ){ ?>
				   				<div class="content-tags col-md-5">
				   					<h3>Tags</h3>
				   					<ul>
				   						<?php foreach( $arrTags as $tag ){ 
				   							$tag = taxonomy_term_load( $tag );
				   						?>
				   							<li><a href="/<?php echo drupal_get_path_alias('taxonomy/term/' . $tag->tid ); ?>">
				                			<?php echo $tag->name ?></a></li>
				   						<?php } ?>
				   					</ul>
				   				</div>
				   			<?php } ?>

			    		</div>
			      	</div>
			      	</article>
				<?php 
				}else{ ?>

					<article class="category-block">
				      	<div class="content-principal <?php if( $i % 2 == 0 ) echo "left"; else echo "right"; ?>">
				      		<div class="cont-image col-md-7 custom-bg-block" bg-mod-d="<?php echo file_create_url( $first->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $first->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>">
								</div>
				    		<div class="wrapper-description col-md-5">
				    			<div class="cont-description">
									<h2><?php echo $first->title ?></h2>
									<div class="line"></div>
									<div class="content-likes elem-mobile">
										<div class="likes"><span>135</span></div>
										<div class="comments"><span>100</span></div>
									</div>
									<h4><?php echo $first->field_summary[ "und" ][0][ "field_subtitle" ][ "und" ][ 0 ][ "value" ] ?></h4>
									<p class="description"><?php echo $first->field_summary[ "und" ][0][ "field_description_1" ][ "und" ][ 0 ][ "value" ] ?></p>	
									<div class="content-likes">
										<div class="likes"><span>135</span></div>
										<div class="comments"><span>100</span></div>
									</div>
									<!-- p class="written-by">Presented by <span itemprop="name"> Palace Resorts</span></p -->
									<p class="date"><time datetime="2017-12-11">December 11, 2017</time></p>
									<div class="field-link"><a href="/<?php echo drupal_get_path_alias('node/' . $first->nid ); ?>" class="button btn-blue btn-medium">Read More <?php echo $parent_name ?></a></div>
									<div class="arrow"></div>
								</div>
				    		</div>
				      	</div>
				      </article>

				<?php }
			}
		}
	?>
      
	<?php 

    if( !empty( $arr_nodes_other ) ){ ?>
	      <section class="category-related-block">
	      	<div class="general-article container">
	      		<h2 class="col-md-12">This Article is related to...</h2>
				<?php for( $i = 0 ; $i <= 2 ; $i++ ){ ?>
	      			<?php if( isset( $arr_nodes_other[ $i ] ) ){ ?>
						<article class="col-md-4">
							<div class="cont-image">
								<img class="image-desktop" src="<?php echo file_create_url( $arr_nodes_other[$i]->field_thumbnail_small["und"][0]["uri"] ) ?>" alt="" title="">
							</div>
							<div class="cont-description">
								<h3><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes_other[$i]->nid ); ?>"><?php echo $arr_nodes_other[$i]->title ?></a></h3>
								<div class="line"></div>
								<p><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes_other[$i]->nid ); ?>">Read More <?php echo $parent_name ?></a></p>
							</div>
						</article>
					<?php } ?>
				<?php } ?>
			</div>
	      </section>
	<?php } ?>
      
   
<?php }else if( $term->vocabulary_machine_name == "tags" ){ 

	$arr_nodes = taxonomy_select_nodes( $term->tid );

?>

	<div class="container page-search-tag">
     		<form class="search-mini-form">
     			<div class="form-search">
     				<h1><?php echo $term->name ?></h1>
     			</div>
     		</form>
     		
      		<section class="wrapper-content-news col-md-8">
      			
      			<div class="content-news">

      			<?php foreach( $arr_nodes as $key => $node ){ 

      				$node = node_load( $node );

      			?>

      				<?php if( $key == 0 ){ ?>
	      				<article class="content-principal">
	      					<picture>
								<img src="<?php echo file_create_url( $node->field_thumbnail_medium[ "und" ][ 0 ][ "uri" ] ) ?>" alt="">
							</picture>
	     					<div class="description">
	     						<h2><a href="/<?php echo drupal_get_path_alias( "node/" . $node->nid ) ?>"><?php echo $node->title ?></a></h2>
	     						<p><?php echo $node->field_summary[ "und" ][0][field_description_1][ "und" ][0][ "value" ] ?>...<a href="<?php print $url; ?>"> Read More</a></p>
	     					</div>
	      				</article>
	      			<?php } ?>
	      				
	      			<?php if( $key >= 1 ){ ?>
	      				<article class="general-article">
	      					<div class="cont-image col-md-7 col-sm-7">
	      						<picture>
									<img src="<?php echo file_create_url( $node->field_thumbnail_medium[ "und" ][ 0 ][ "uri" ] ) ?>" alt="">
								</picture>
	      					</div>
	     					<div class="description col-md-5 col-sm-5">
	     						<h2><a href="/<?php echo drupal_get_path_alias( "node/" . $node->nid ) ?>"><?php echo $node->title ?></a></h2>
	     						<p><?php echo drupal_substr( $node->field_summary[ "und" ][0][field_description_1][ "und" ][0][ "value" ], 0, 90 ) ?>...<a href="<?php print $url; ?>"> Read More</a></p>
	     					</div>
	      				</article>

      				<?php } ?>

      			<?php } ?>

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
      	</div>

<?php }else if( $term->vocabulary_machine_name == "sub_categories" ){ 

	?><div class="category-page"><?php

		$arr_terms = taxonomy_get_tree( 2 );

		$tree = array();
		$tree[ $term->tid ][ "parent" ] = $term;
		
		//$nodes = node_load_multiple( array(), array( "type" => "article", "status" => "1" ) );

		$query = new EntityFieldQuery();
		  $query->entityCondition('entity_type', 'node')
		    ->propertyCondition('status', 1)
		    ->propertyCondition('type', array('article'))
		    ->propertyOrderBy('created', 'DESC');
		  $nodes = $query->execute();

		$month_actual = date( "F" );

		$arr_nodes = array( );
		$arr_nodes_ppal = array( );
		$arrTags = array( );
		$arr_nodes_other = array( );

		/*
		$parent_name = "";
		if( $term->field_category[ "und" ][0][ "taxonomy_term" ]->name == "Mexico" || $term->field_category[ "und" ][0][ "taxonomy_term" ]->name == "Jamaica" )
			$parent_name = "About " . $term->field_category[ "und" ][0][ "taxonomy_term" ]->name;
		*/

		foreach( $nodes[ "node" ] as $key => $node ){

			$node = node_load( $node->nid );

			$month = date( "F", strtotime( $node->field_date[ "und" ][ 0 ][ "value" ] ) );

			$node->field_image["und"][0]["url"] = file_create_url( $node->field_image["und"][0]["uri"] );
			$node->field_image_mobile["und"][0]["url"] = file_create_url( $node->field_image_mobile["und"][0]["uri"] );
			$node->body["und"][0]["summary"] = substr($node->body["und"][0]["summary"], 0, 150);
			
			$categoria = taxonomy_term_load( $node->field_categoria[ "und" ][0][ "tid" ] );
			$node->field_categoria[ "und" ][0][ "categoria" ] = $categoria->name;

			$arr_nodes[ $month ][ ] = $node;

			foreach( $node->field_tags["und"] as $tag ){
				$arrTags[ $tag["tid"] ] = $tag["tid"];
			}

			$related = false;
			foreach( $node->field_subcategoria["und"] as $cat ){

				if( ( $cat[ "tid" ] == $term->tid ) && $node->field_category["und"][0]["tid"]){

					$arr_nodes_ppal[ ] = $node;

				}else if( !$related ){
	 
					//Related articles
					$arr_nodes_other[] = $node;
					$related = true;

				}

			}

		}

		$arrTags = array_slice( $arrTags, 0, 10 );
		$arr_nodes = $arr_nodes[ $month_actual ];

		/**** CATEGORIAS Y SUBCATEGORIAS ****/

		?>
	
		<div class="banner-category custom-bg-block <?php echo ( $term->field_title_color["und"][0]["value"] == 0 ) ? "white" : "blue" ?>" bg-mod-d="<?php echo file_create_url( $term->field_image[ "und" ][ 0 ][ "uri" ] ) ?>" bg-mod-m="<?php echo file_create_url( $term->field_image_mobile[ "und" ][ 0 ][ "uri" ] ) ?>">
	      	<div class="title-section container">
				<h1><?php echo $term->name ?></h1>
				<div class="line-title blue"></div>
	     	</div>	
      	</div>
      
      	<?php 
			
		
      	for( $i = 0 ; $i <= 20 ; $i++ ){

			$first = array_values($arr_nodes_ppal)[$i];

			if( $first->title ){

				if( $i == 0 ){

					?>
			      	<article class="category-block featured-top">
			      	<div class="content-principal <?php if( $i % 2 == 0 ) echo "left"; else echo "right"; ?>">
			      		<div class="cont-image col-md-5 custom-bg-block" bg-mod-d="<?php echo file_create_url( $first->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $first->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>">
						</div>
			    		<div class="wrapper-description col-md-7">
			    			<div class="cont-description col-md-5">
								<h2><?php echo $first->title ?></h2>
								<div class="line"></div>
								<div class="content-likes elem-mobile">
									<div class="likes"><span>135</span></div>
									<div class="comments"><span>100</span></div>
								</div>
								<h4><?php echo $first->field_summary[ "und" ][0][ "field_subtitle" ][ "und" ][ 0 ][ "value" ] ?></h4>
								<p class="description"><?php echo $first->field_summary[ "und" ][0][ "field_description_1" ][ "und" ][ 0 ][ "value" ] ?></p>	
								<!-- div class="content-likes">
									<div class="likes"><span>135</span></div>
									<div class="comments"><span>100</span></div>
								</div -->
								<!-- p class="written-by">Presented by <span itemprop="name"> Palace Resorts</span></p-->
								<!-- p class="date"><time datetime="2017-12-11">December 11, 2017</time></p -->
								<div class="field-link"><a href="/<?php echo drupal_get_path_alias( 'node/' . $first->nid ); ?>" class="button btn-blue btn-medium">Read More <?php echo $parent_name ?></a></div>
								<div class="arrow"></div>
							</div>
			   				
			   				<?php if( $i == 0 ){ ?>
				   				<div class="content-tags col-md-5">
				   					<h3>Tags</h3>
				   					<ul>
				   						<?php foreach( $arrTags as $tag ){ 
				   							$tag = taxonomy_term_load( $tag );
				   						?>
				   							<li><a href="/<?php echo drupal_get_path_alias('taxonomy/term/' . $tag->tid ); ?>">
				                			<?php echo $tag->name ?></a></li>
				   						<?php } ?>
				   					</ul>
				   				</div>
				   			<?php } ?>

			    		</div>
			      	</div>
			      	</article>
				<?php 
				}else{ ?>

					<article class="category-block">
				      	<div class="content-principal <?php if( $i % 2 == 0 ) echo "left"; else echo "right"; ?>">
				      		<div class="cont-image col-md-7 custom-bg-block" bg-mod-d="<?php echo file_create_url( $first->field_image[ "und" ][ 0 ][ "uri" ] ); ?>" bg-mod-m="<?php echo file_create_url( $first->field_image_mobile[ "und" ][ 0 ][ "uri" ] ); ?>">
								</div>
				    		<div class="wrapper-description col-md-5">
				    			<div class="cont-description">
									<h2><?php echo $first->title ?></h2>
									<div class="line"></div>
									<div class="content-likes elem-mobile">
										<div class="likes"><span>135</span></div>
										<div class="comments"><span>100</span></div>
									</div>
									<h4><?php echo $first->field_summary[ "und" ][0][ "field_subtitle" ][ "und" ][ 0 ][ "value" ] ?></h4>
									<p class="description"><?php echo $first->field_summary[ "und" ][0][ "field_description_1" ][ "und" ][ 0 ][ "value" ] ?></p>	
									<div class="content-likes">
										<div class="likes"><span>135</span></div>
										<div class="comments"><span>100</span></div>
									</div>
									<!-- p class="written-by">Presented by <span itemprop="name"> Palace Resorts</span></p -->
									<p class="date"><time datetime="2017-12-11">December 11, 2017</time></p>
									<div class="field-link"><a href="/<?php echo drupal_get_path_alias('node/' . $first->nid ); ?>" class="button btn-blue btn-medium">Read More <?php echo $parent_name ?></a></div>
									<div class="arrow"></div>
								</div>
				    		</div>
				      	</div>
				      </article>

				<?php }
			}
		}
	?>
      
	<?php 

    if( !empty( $arr_nodes_other ) ){ ?>
	      <section class="category-related-block">
	      	<div class="general-article container">
	      		<h2 class="col-md-12">This Article is related to...</h2>
				<?php for( $i = 0 ; $i <= 2 ; $i++ ){ ?>
	      			<?php if( isset( $arr_nodes_other[ $i ] ) ){ ?>
						<article class="col-md-4">
							<div class="cont-image">
								<img class="image-desktop" src="<?php echo file_create_url( $arr_nodes_other[$i]->field_thumbnail_small["und"][0]["uri"] ) ?>" alt="" title="">
							</div>
							<div class="cont-description">
								<h3><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes_other[$i]->nid ); ?>"><?php echo $arr_nodes_other[$i]->title ?></a></h3>
								<div class="line"></div>
								<p><a href="/<?php echo drupal_get_path_alias('node/' . $arr_nodes_other[$i]->nid ); ?>">Read More <?php echo $parent_name ?></a></p>
							</div>
						</article>
					<?php } ?>
				<?php } ?>
			</div>
	      </section>
	<?php } ?>
      
      <?php for( $i = 2 ; $i < count( $tree[ $term->tid][ "childs" ] ) ; $i++ ){ 

      	$actual = $tree[$term->tid][ "childs" ][ $i ];

      ?>

      <article class="category-block">
      	<div class="content-principal left">
      		<div class="cont-image col-md-7">
				<img class="image-desktop" src="<?php echo file_create_url( $actual->field_image[ "und" ][ 0 ][ "uri" ] ) ?>" alt="" title="">
				<img class="image-mobile" src="<?php echo file_create_url( $actual->field_image_mobile[ "und" ][ 0 ][ "uri" ] ) ?>" alt="" title="">
			</div>
    		<div class="wrapper-description col-md-5">
    			<div class="cont-description">
					<h2><?php echo $actual->name ?></h2>
					<div class="line"></div>
					<div class="content-likes elem-mobile">
						<div class="likes"><span>135</span></div>
						<div class="comments"><span>100</span></div>
					</div>

					<h4><?php echo $actual->field_subtitle[ "und" ][ 0 ][ "value" ] ?></h4>
					<p class="description"><?php echo $actual->field_texto_intro[ "und" ][ 0 ][ "value" ] ?></p>	
					<div class="content-likes">
						<div class="likes"><span>135</span></div>
						<div class="comments"><span>100</span></div>
					</div>
					<p class="date"><time datetime="2017-12-11">December 11, 2017</time></p>
					<div class="field-link"><a href="#" class="button btn-blue btn-medium">Read More <?php echo $parent_name ?></a></div>
					<div class="arrow"></div>
				</div>
    		</div>
      	</div>
      </article>

      <?php } ?>

      </div>
		
<?php } ?>

