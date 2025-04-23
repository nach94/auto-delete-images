<?php

if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente.
}

class Clean_Up_Images {
    public function __construct() {
        add_action('before_delete_post', [$this, 'delete_post_images'], 10, 1);
    }

    public function delete_post_images($post_id) {
        $post_type = get_post_type($post_id);
        $posts_activate    = get_option('_activate_for_posts') == '1';
        $products_activate = get_option('_activate_for_products') == '1';
        $pages_activate    = get_option('_activate_for_pages') == '1';

        if ($posts_activate && $post_type === 'post') {
            $image_id = get_post_thumbnail_id($post_id);
            if ($image_id && !$this->is_image_used_elsewhere($image_id, $post_id)) {
                wp_delete_post($image_id, true);
            }
        }

        if ($pages_activate && $post_type === 'page') {
            $image_id = get_post_thumbnail_id($post_id);
            if ($image_id && !$this->is_image_used_elsewhere($image_id, $post_id)) {
                wp_delete_post($image_id, true);
            }
        }

        if ($products_activate && $post_type === 'product') {
            $product = wc_get_product($post_id);
            if (!$product) return;

            $featured_image_id = $product->get_image_id();
            $gallery_ids = $product->get_gallery_image_ids();

            if ($featured_image_id && !$this->is_image_used_elsewhere($featured_image_id, $post_id, 'product')) {
                wp_delete_post($featured_image_id, true);
            }

            foreach ($gallery_ids as $gallery_image_id) {
                if (!$this->is_image_used_elsewhere($gallery_image_id, $post_id, 'product', true)) {
                    wp_delete_post($gallery_image_id, true);
                }
            }
        }
    }

    private function is_image_used_elsewhere($image_id, $post_id, $post_type = '', $check_gallery = false) {
        global $wpdb;

        $query = $wpdb->get_var($wpdb->prepare("
            SELECT COUNT(*) FROM $wpdb->postmeta 
            WHERE meta_key = '_thumbnail_id' 
            AND meta_value = %d 
            AND post_id != %d
        ", $image_id, $post_id));

        if ($query > 0) return true;

        if ($post_type === 'product' && $check_gallery) {
            $query_gallery = $wpdb->get_var($wpdb->prepare("
                SELECT COUNT(*) FROM $wpdb->postmeta 
                WHERE meta_key = '_product_image_gallery' 
                AND post_id != %d 
                AND meta_value LIKE %s
            ", $post_id, '%' . $image_id . '%'));

            if ($query_gallery > 0) return true;
        }

        return false;
    }
}

new Clean_Up_Images();