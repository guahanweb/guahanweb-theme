<?php
namespace GW\Theme;

class CategoryMeta {
    static public function instance() {
        static $instance;
        if (null === $instance) {
            $instance = new CategoryMeta();
            $instance->listen();
        }
        return $instance;
    }

    public function listen() {
        add_action('category_add_form_fields', array($this, 'addCategoryImage'), 10, 2);
        add_action('created_category', array($this, 'saveCategoryImage'), 10, 2);
        add_action('category_edit_form_fields', array($this, 'updateCategoryImage'), 10, 2);
        add_action('edited_category', array($this, 'updatedCategoryImage'), 10, 2);
        add_action('admin_footer', array($this, 'addScript'), 10, 2);
    }

    public function addCategoryImage($taxonomy) { ?>
        <div class="form-field term-group">
            <label for="category-image-id"><?php _e('Image'); ?></label>
            <input type="hidden" name="category-image-id" id="category-image-id" class="custom_media_url" value="">
            <div id="category-image-wrapper"></div>
            <p>
                <input type="button" class="button button-secondary gw-tax-media-button" id="gw-tax-media-button" value="<?php _e('Add Image'); ?>">
                <input type="button" class="button button-secondary gw-tax-media-button" id="gw-tax-media-remove" value="<?php _e('Remove Image'); ?>">
            </p>
        </div>
    <?php
    }

    public function saveCategoryImage($term_id, $tt_id) {
        if (isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']) {
            $image = $_POST['category-image-id'];
            add_term_meta($term_id, 'category-image-id', $image, true);
        }
    }

    public function updateCategoryImage($term, $taxonomy) { ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="category-image-id"><?php _e('Image'); ?></label>
            </th>
            <td>
                <?php $image_id = get_term_meta($term->term_id, 'category-image-id', true); ?>
                <input type="hidden" name="category-image-id" id="category-image-id" class="custom_media_url" value="<?php echo $image_id; ?>">
                <div class="category-image-wrapper">
                    <?php if ($image_id) { ?>
                        <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                    <?php } ?>
                </div>
                <p>
                    <input type="button" class="button button-secondary gw-tax-media-button" id="gw-tax-media-button" value="<?php _e('Add Image'); ?>">
                    <input type="button" class="button button-secondary gw-tax-media-button" id="gw-tax-media-remove" value="<?php _e('Remove Image'); ?>">
                </p>
            </td>
        </tr>
    <?php
    }

    public function updatedCategoryImage($term_id, $tt_id) {
        if (isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']) {
            $image = $_POST['category-image-id'];
            update_term_meta($term_id, 'category-image-id', $image);
        } else {
            update_term_meta($term_id, 'category-image-id', '');
        }
    }

    public function addScript() {

    }
}
