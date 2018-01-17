<?php
namespace GW\Theme;

class Category {
    static public function instance() {
        static $instance;
        if (null === $instance) {
            $instance = new Category();
            $instance->listen();
            $instance->template = file_get_contents(__DIR__ . '/category/template.html');
        }
        return $instance;
    }

    public function listen() {
        add_action('category_edit_form_fields', array($this, 'showExtras'), 10, 2);
        add_action('category_add_form_fields', array($this, 'showExtras'), 10, 2);

        add_action('edited_category', array($this, 'saveExtras'), 10, 2);
        add_action('created_category', array($this, 'saveExtras'), 10, 2);

        add_action('manage_edit-category_columns', array($this, 'addCustomColumn'));
        add_action('manage_category_custom_column', array($this, 'showCustomColumn'), 10, 3);

        add_action('after_setup_theme', array($this, 'setupTheme'));
        add_action('admin_footer', array($this, 'addScript'));

        // There is currently no easy way to populate and save, so don't show
        // add_action('quick_edit_custom_box', array($this, 'showQuickEdit'), 10, 2);
    }

    public function addScript() {
        printf('<script src="%s"></script>', get_template_directory_uri() . '/js/admin.js');
    }

    public function addCustomColumn($columns) {
        return array_merge($columns, array(
            'color' => __('Color', 'guahanweb'),
            'image' => __('Image', 'guahanweb')
        ));
    }

    public function setupTheme() {
        add_theme_support('post-thumbnails');
        add_image_size('gw-card-thumb', 0, 180); // crop to 180px tall for use in our responsive card summaries
    }

    public function showCustomColumn($deprecated, $column_name, $term_id) {
        $term_meta = get_option("taxonomy_$term_id");
        if ($column_name == 'color') {
            if (empty($term_meta['color'])) {
                printf('<span class="no-color">%s</span>', __('none', 'guahanweb'));
            } else {
                $color = '#' . $term_meta['color'];
                echo <<<EOC
<div class="category-color">
    <div class="color-sample" style="background-color: $color"></div>
</div>
EOC;
            }
        } elseif ($column_name == 'image') {
            if (empty($term_meta['image'])) {
                printf('<span class="no-image">%s</span>', __('none', 'guahanweb'));
            } else {
                $image = wp_get_attachment_image($term_meta['image'], array(100, 100));
                echo <<<EOC
<div class="category-image">
    <div class="image-thumb">$image</div>
</div>
EOC;
            }
        }
    }

    public function showQuickEdit($column_name, $post_type) {
        if ($post_type == 'edit-tags' && $column_name == 'color') {
            echo <<<EOF
<fieldset>
    <div class="inline-edit-col">
        <label>
            <span class="title">Color</span>
            <span class="input-text-wrap">
                <input type="text" name="color" class="ptitle" value="" />
            </span>
        </label>
    </div>
</fieldset>
EOF;
        }
    }

    public function showExtras($term = null) {
        $color = '';
        $image_id = '';
        $image = '';

        if (is_object($term)) {
            $term_id = $term->term_id;
            $term_meta = get_option("taxonomy_$term_id");

            if (isset($term_meta['color']) && '' !== $term_meta['color']) {
                $color = $term_meta['color'];
            }

            if (isset($term_meta['image']) && '' !== $term_meta['image']) {
                $image_id = $term_meta['image'];
                $image = wp_get_attachment_image($term_meta['image'], 'thumbnail');
            }
        }

        $this->render(array(
            'color' => $color,
            'image_id' => $image_id,
            'image' => $image
        ));
    }

    public function saveExtras($term_id) {
        if (isset($_POST['term_meta'])) {
            $term_meta = array();

            // color
            // @TODO: sanitize hex value
            $term_meta['color'] = isset($_POST['term_meta']['color']) ? sanitize_text_field($_POST['term_meta']['color']) : '';

            // image
            $term_meta['image'] = isset($_POST['term_meta']['image']) ? trim($_POST['term_meta']['image']) : '';

            update_option("taxonomy_$term_id", $term_meta);
        }
    }

    protected function render($props) {
        $matches = array();
        $replacements = array();

        foreach ($props as $prop => $val) {
            $matches[] = '{{' . $prop . '}}';
            $replacements[] = $val;
        }

        echo str_replace($matches, $replacements, $this->template);
    }
}
