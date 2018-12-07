<?php

/**
 * @file
 * Default theme implementation for displaying search results.
 *
 * This template collects each invocation of theme_search_result(). This and
 * the child template are dependent to one another sharing the markup for
 * definition lists.
 *
 * Note that modules may implement their own search type and theme function
 * completely bypassing this template.
 *
 * Available variables:
 * - $search_results: All results as it is rendered through
 *   search-result.tpl.php
 * - $module: The machine-readable name of the module (tab) being searched, such
 *   as "node" or "user".
 *
 *
 * @see template_preprocess_search_results()
 *
 * @ingroup themeable
 */

?>

<div class="page-search-result">

<div class="container">
<form class="search-mini-form" action="/search/node/" method="post">
	<div class="form-search">
		<input id="search" type="text" value="<?php echo str_replace("search/node/", "", $_GET[ "q" ]) ?>" class="input-text">
	</div>
</form>

<section class="wrapper-content-news col-md-8">
	<header class="filter-header">
		<div class="results col-md-2"><span><?php echo $GLOBALS['pager_total_items'][0] ?> Results</span></div>
		<div class="sort-by">
			<span>Sort By:</span>
			<ul>
				<li><a>Oldest</a></li>
				<li class="active"><a>Newest</a></li>
				<li><a>Relevance</a></li>
			</ul>
		</div>
	</header>
	<div class="content-news">
		
		<?php if ($search_results): ?>
			<?php print $search_results; ?>
		<?php else : ?>
		  <div class="no-results">
		  		<h2><?php print t('Your search yielded no results');?></h2>
		  		<?php print search_help('search#noresults', drupal_help_arg()); ?>
		  </div>
		<?php endif; ?>
		<?php print $pager; ?>
		
	</div>
</section>

<aside class="col-md-4">
<?php 

	echo views_embed_view('home_most_popular', 'block_1');
	$_SESSION[ "count" ] = 0;

?>
</aside>

</div>

</div>
