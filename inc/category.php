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
        add_action('create_category', array($this, 'saveExtras'), 10, 2);

        add_action('manage_edit-category_columns', array($this, 'addCustomColumn'));
        add_action('manage_category_custom_column', array($this, 'showCustomColumn'), 10, 3);

        // There is currently no easy way to populate and save, so don't show
        // add_action('quick_edit_custom_box', array($this, 'showQuickEdit'), 10, 2);
    }

    public function addCustomColumn($columns) {
        return array_merge($columns, array(
            'color' => __('Color', 'guahanweb')
        ));
    }

    public function showCustomColumn($deprecated, $column_name, $term_id) {
        if ($column_name == 'color') {
            $term_meta = get_option("taxonomy_$term_id");
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
        if (is_object($term)) {
            $term_id = $term->term_id;
            $term_meta = get_option("taxonomy_$term_id");
            $color = $term_meta['color'];
        }

        $this->render(array(
            'color' => $color
        ));
    }

    public function saveExtras($term_id) {
        if (isset($_POST['term_meta'])) {
            $term_meta = array();
            $term_meta['color'] = isset($_POST['term_meta']['color']) ? sanitize_text_field($_POST['term_meta']['color']) : '';
            // @TODO: sanitize hex value
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
