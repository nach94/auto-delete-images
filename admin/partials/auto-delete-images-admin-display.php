<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://helloeveryone.me/
 * @since      1.0.0
 *
 * @package    Auto_Delete_Images
 * @subpackage Auto_Delete_Images/admin/partials
 */
?>

<style>
	#wpcontent {
		padding-left: 0;
	}
</style>

<div class="flex-column gap-s bg-dark-grey-2 text-white padding-l">	
	<img class="max-width-10" src="https://helloeveryone.me/wp-content/uploads/HelloEveryone-Logo-300x79.webp" alt="Logo Hello Everyone">
	<p class="text-xs">
		Desarrollado por <a class="text-white hover-1 transition-global" href="https://helloeveryone.me" rel="noreferrer" target="_blank"><strong>Hello Everyone</strong></a>
	</p>
</div>
<div class="padding-l text-black">
	<h1 class="text-l font-700"> Opciones de <span class="underline">Auto-Delete Images</span></h1>
	<hr class="margin-vertical-m">
	<form method="post" action="options.php">
		<p class="text-m">¿Activar funcionalidad para productos?</p>
		<div class="flex-row gap-4xs items-middle margin-top-s">
			<input class="margin-auto" type="checkbox" name="_activate_for_products" id="_activate_for_products" value="1" <?php checked(get_option('_activate_for_products'), 1); ?>>
			<label for="_activate_for_products" class="text-s">Activar en productos</label>
		</div>
		<hr class="margin-vertical-m">
		<p class="text-m">¿Activar funcionalidad para posts?</p>
		<div class="flex-row gap-4xs items-middle margin-top-s">
			<input type="checkbox" name="_activate_for_posts" id="_activate_for_posts" value="1" <?php checked(get_option('_activate_for_posts'), 1); ?>>
			<label for="_activate_for_posts" class="text-s">Activar en posts</label>
		</div>
		<hr class="margin-vertical-m">
		<p class="text-m">¿Activar funcionalidad para páginas?</p>
		<div class="flex-row gap-4xs items-middle margin-top-s">
			<input type="checkbox" name="_activate_for_pages" id="_activate_for_pages" value="1" <?php checked(get_option('_activate_for_pages'), 1); ?>>
			<label for="_activate_for_pages" class="text-s">Activar en páginas</label>
		</div>
		<hr class="margin-vertical-m">
		<?php
			settings_fields('auto_delete_images_options_group');
			do_settings_sections('auto-delete-images');
			submit_button();
		?>
	</form>
</div>