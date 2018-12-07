<?php
/**
 * Template file for each menu item.
 *
 * Variables:
 * $manu_name: the machine name of the menu.
 * $link: the rendered link for this menu item.
 * $title: the sanitised link text.
 * $href: the uri of the link.
 * $description: the markup-checked description for this menu item.
 * $class: the classes for this menu item as a single string.
 * $class_array: the classes as an array.
 * $items: the array of all menu itmes.  Note that the descriptions are raw
 *   input and should be passed through check_markup before use!
 * $delta: the index into $items for this particular menu item.
 */
?>
<dt class="<?php print $class; ?>"><?php print $link; ?></dt>
<dd class="<?php print $class; ?>"><?php print $description; ?></dd>
