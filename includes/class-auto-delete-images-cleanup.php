<?php

if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente.
}

class Auto_Delete_Images_Cleanup {

    public function __construct() {
        add_action('before_delete_post', array($this, 'maybe_delete_attached_images'));
    }

    /**
     * Verifica las opciones y decide si eliminar las imágenes adjuntas del post.
     *
     * @param int $post_id El ID del post que se va a eliminar.
     */
    public function maybe_delete_attached_images($post_id) {
        $delete_for_posts = get_option('_activate_for_posts');
        $delete_for_products = get_option('_activate_for_products');
        $post_type = get_post_type($post_id);

        if (($post_type === 'post' && $delete_for_posts === '1') || ($post_type === 'product' && $delete_for_products === '1')) {
            $this->delete_attached_images($post_id);
        }
    }

    /**
     * Elimina las imágenes adjuntas a un post al momento de su eliminación.
     *
     * @param int $post_id El ID del post que se va a eliminar.
     */
    private function delete_attached_images($post_id) {
        $attachments = get_attached_media('image', $post_id);

        if ($attachments) {
            foreach ($attachments as $attachment_id => $attachment) {
                $this->maybe_delete_attachment($attachment_id, $post_id);
            }
        }
    }

    /**
     * Comprueba si la imagen adjunta está siendo utilizada por otros posts antes de eliminarla.
     *
     * @param int $attachment_id El ID de la imagen adjunta.
     * @param int $current_post_id El ID del post que se está eliminando.
     */
    private function maybe_delete_attachment($attachment_id, $current_post_id) {
        $posts_using_attachment = get_posts(array(
            'post_type' => 'any',
            'fields' => 'ids',
            'meta_query' => array(
                array(
                    'key' => '_thumbnail_id',
                    'value' => $attachment_id,
                ),
            ),
            'exclude' => $current_post_id, // Excluir el post que se está eliminando
        ));

        // Buscar la imagen en el contenido de otras publicaciones
        $posts_using_attachment_in_content = get_posts(array(
            'post_type' => 'any',
            'fields' => 'ids',
            's' => wp_get_attachment_url($attachment_id),
            'exclude' => $current_post_id, // Excluir el post que se está eliminando
        ));

        if (empty($posts_using_attachment) && empty($posts_using_attachment_in_content)) {
            wp_delete_attachment($attachment_id, true); // true para eliminar también los archivos del disco
        }
    }

}

new Auto_Delete_Images_Cleanup();