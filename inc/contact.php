<?php
namespace GW\Theme;

class Contact {
    static public function instance() {
        static $instance;
        if (null === $instance) {
            $instance = new Contact();
            $instance->listen();
        }
        return $instance;
    }

    public function listen() {
        add_action('wp_ajax_gw_send_message', array($this, 'sendMessage'));
        add_action('wp_ajax_nopriv_gw_send_message', array($this, 'sendMessage'));
        add_action('wp_mail_content_type', array($this, 'getContentType'));

        add_action('wp_mail_failed', array($this, 'handleMailFailure'));
    }

    public function getContentType() {
        return 'text/html';
    }

    public function handleMailFailure($err) {
        // var_dump($err);
    }

    public function sendMessage() {
        $message = isset($_POST['message']) ? trim($_POST['message']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $name = isset($_POST['name']) ? trim($_POST['name']) : null;

        if ($message && $email && $name) {
            // validate email and fail if invalid
            if (!preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i', $email)) {
                wp_send_json(array(
                    'success' => false,
                    'field' => 'email',
                    'error' => 'ERR_INVALID',
                    'error_msg' => 'Invalid email address provided'
                ));
            }

            $to = get_option('admin_email');
            $headers = sprintf('From: %s <%s>', $name, $email);
            $subject = 'guahanweb.com | New message from ' . $name;

            $contents = file_get_contents(__DIR__ . '/contact/template.html');
            $matches = array('{{name}}', '{{email}}', '{{message}}');
            $replacements = array($name, $email, wpautop($message));
            $html = str_replace($matches, $replacements, $contents);
            

            $mail = wp_mail($to, $subject, $html, $headers);
            if ($mail) {
                wp_send_json(array(
                    'success' => true
                ));
            } else {
                wp_send_json(array(
                    'success' => false,
                    'field' => null,
                    'error' => 'UNKNOWN',
                    'error_msg' => 'Could not send email'
                ));
            }
        }
    }
}
