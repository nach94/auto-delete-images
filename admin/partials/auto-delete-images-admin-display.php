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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
	<h1>Opciones de Auto Delete Images</h1>
	<form method="post" action="options.php">
		<?php
			settings_fields( 'auto_delete_images_options_group' );
			do_settings_sections( 'auto-delete-images' );
			submit_button();
		?>
	</form>
</div>