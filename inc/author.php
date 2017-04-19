<?php
namespace GW\Theme;

class Author {
    static public function instance() {
        static $instance;
        if (null === $instance) {
            $instance = new Author();
            $instance->listen();
            $instance->template = file_get_contents(__DIR__ . '/author/template.html');
        }
        return $instance;
    }

    public function listen() {
        add_action('show_user_profile', array($this, 'showExtras'));
        add_action('edit_user_profile', array($this, 'showExtras'));

        add_action('personal_options_update', array($this, 'saveExtras'));
        add_action('edit_user_profile_update', array($this, 'saveExtras'));
    }

    public function showExtras($user) {
        $this->render(array(
            'bio' => get_the_author_meta('bio', $user->ID)
        ));
    }

    public function saveExtras($user_id) {
        if (!current_user_can('edit_user', $user_id)) return false;

        // update fields
        update_usermeta($user_id, 'bio', $_POST['bio']);
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
