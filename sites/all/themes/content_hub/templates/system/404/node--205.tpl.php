<?php
global $language;
$lang_name = $language->language;
?>
<section class="section-page-404">
    <div class="content-text">
        <p><?php echo t('You can sometimes get lost while exploring the world');?>.</p>
       <?php echo t('<h2> Unfortunately There’s Nothing Here, Lets Go Back! </h2>');?>
        <a href="/<?php echo $lang_name; ?>"><?php echo t('return to the homepage');?></a>
    </div>
    <img src="<?php print base_path().drupal_get_path('theme', 'content_hub')."/images/404.jpg"?>" alt="">
</section>
