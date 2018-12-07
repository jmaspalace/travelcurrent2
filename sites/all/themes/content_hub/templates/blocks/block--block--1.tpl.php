<?php 

$menu = menu_tree_all_data( "menu-footer" );

?>
	<div class="container">
		<div class="content">
		<?php 

		foreach( $menu as $item ){ 

				$child = $item[ "link" ];
			?>

			<div class="block-footer">
					<div class="block-title"><?php echo l( $child[ "link_title" ], $child[ "href" ] ) ?></a></div>
					<ul>
					<?php foreach( $item[ "below" ] as $child ){ 
							$child = $child[ "link" ];
					?>
						<li class="<?php echo $child["options"]["attributes"]["class"][0] ?>"><?php echo l( $child[ "link_title" ], $child[ "href" ] ) ?></li>
					
				<?php } ?>
				</ul>
			</div>

		<?php } ?>

			
			<div class="block-footer block-shares">
				<div class="block-title">
					<a href="#"><img src="<?php echo variable_get('seeing_blue_logo_footer', "") ?>" alt="" title=""></a>
					<ul>
						<li><a class="icon-share icon-fb" href="https://www.facebook.com/palaceresorts" target="_blank">Facebook</a></li>
						<li><a class="icon-share icon-twt" href="https://twitter.com/PalaceResorts" target="_blank">Twitter</a></li>
						<li><a class="icon-share icon-ig" href="https://www.instagram.com/palaceresorts" target="_blank">Instagram</a></li>
						<li><a class="icon-share icon-yt" href="https://www.youtube.com/user/PalaceResorts123" target="_blank">Youtube</a></li>
						<li><a class="icon-share icon-pt" href="https://co.pinterest.com/palaceresorts" target="_blank">Pinteres</a></li>
					</ul>
					<img class="sponsered" src="/sites/all/themes/content_hub/images/sponsered.png" alt="sponsered by Palace Resort®" title="sponsered by Palace Resort®">
				</div>
			</div>
		</div>
	</div>
	
	<div class="legal">
	<small>Copyright&reg; 2017 <span>The Travel Current</span></small>
	<small>All Rigths Reserved</small>
	<small><a href="https://www.palaceresorts.com/en/general-privacy-notice-marketing-and-advertising" target="_blank">Privacy Notice</a></small>
</div>
