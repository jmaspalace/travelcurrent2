<?php

/**
 * @file
 * Default theme implementation for displaying a single search result.
 *
 * This template renders a single search result and is collected into
 * search-results.tpl.php. This and the parent template are
 * dependent to one another sharing the markup for definition lists.
 *
 * Available variables:
 * - $url: URL of the result.
 * - $title: Title of the result.
 * - $snippet: A small preview of the result. Does not apply to user searches.
 * - $info: String of all the meta information ready for print. Does not apply
 *   to user searches.
 * - $info_split: Contains same data as $info, split into a keyed array.
 * - $module: The machine-readable name of the module (tab) being searched, such
 *   as "node" or "user".
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Default keys within $info_split:
 * - $info_split['module']: The module that implemented the search query.
 * - $info_split['user']: Author of the node linked to users profile. Depends
 *   on permission.
 * - $info_split['date']: Last update of the node. Short formatted.
 * - $info_split['comment']: Number of comments output as "% comments", %
 *   being the count. Depends on comment.module.
 *
 * Other variables:
 * - $classes_array: Array of HTML class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $title_attributes_array: Array of HTML attributes for the title. It is
 *   flattened into a string within the variable $title_attributes.
 * - $content_attributes_array: Array of HTML attributes for the content. It is
 *   flattened into a string within the variable $content_attributes.
 *
 * Since $info_split is keyed, a direct print of the item is possible.
 * This array does not apply to user searches so it is recommended to check
 * for its existence before printing. The default keys of 'type', 'user' and
 * 'date' always exist for node searches. Modules may provide other data.
 * @code
 *   <?php if (isset($info_split['comment'])): ?>
 *     <span class="info-comment">
 *       <?php print $info_split['comment']; ?>
 *     </span>
 *   <?php endif; ?>
 * @endcode
 *
 * To check for all available data within $info_split, use the code below.
 * @code
 *   <?php print '<pre>'. check_plain(print_r($info_split, 1)) .'</pre>'; ?>
 * @endcode
 *
 * @see template_preprocess()
 * @see template_preprocess_search_result()
 * @see template_process()
 *
 * @ingroup themeable
 */

if( !isset( $_SESSION[ "count" ] ) )
  $_SESSION[ "count" ] = 0;
else{
  $_SESSION[ "count" ]++;
}

?>
<!--li class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <h3 class="title"<?php print $title_attributes; ?>>
    <a href=""></a>
  </h3>
  <?php print render($title_suffix); ?>
  <div class="search-snippet-info">
    <?php if ($snippet): ?>
      <p class="search-snippet"</p>
    <?php endif; ?>
    <?php if ($info): ?>
      <p class="search-info"></p>
    <?php endif; ?>
  </div>
</li-->

<?php 

global $base_url;

$query = new EntityFieldQuery();

  $alias = str_replace( $base_url . "/" , "", $url);
  $alias = substr($alias, 0, strlen( $alias ) - 1 );
  $path = drupal_lookup_path("source", $alias);
  $node = menu_get_object("node", 1, $path);

  if (!empty($entities['node'])) {
    $node = node_load(array_shift(array_keys($entities['node'])));
  }

if( $_SESSION[ "count" ] >= 2 ){
?>
<article class="general-article">
    <div class="cont-image col-md-7 col-sm-7">
   		<picture>
      		<img src="<?php echo file_create_url( $node->field_thumbnail_medium["und"][0]["uri"] ) ?>" alt="">
    	</picture>
    </div>
    <div class="description col-md-5 col-sm-5">
      	<h2><a href="<?php print $url; ?>"><?php print render( $title ); ?></a></h2>
      	<p><?php print $node->field_summary["und"][0]["field_description_1"]["und"][0]["value"]; ?>...<a href="<?php print $url; ?>"> Read More</a></p>
    </div>
  </article>

<?php }else{ ?>

  <article class="content-principal">
	<picture>
  		<img src="<?php echo file_create_url( $node->field_thumbnail_medium["und"][0]["uri"] ) ?>" alt="">
	</picture>
  	<div class="description">
		<h2><a href="<?php print $url; ?>"><?php print render( $title ); ?></a></h2>
    	<p><?php print $node->field_summary["und"][0]["field_description_1"]["und"][0]["value"]; ?>...<a href="<?php print $url; ?>"> Read More</a></p>
  	</div>
  </article>

<?php } ?>