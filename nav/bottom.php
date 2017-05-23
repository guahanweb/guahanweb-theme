            <a href="#" class="contact nav-link footer-link">Contact</a>
<?php
$pages = array(
  '/photography' => 'Photos',
  '/blog' => 'Software',
  '/about' => 'About',
  '/' => 'Home'
);

$current_page = defined('CURRENT_PAGE') ? CURRENT_PAGE : '/';
foreach ($pages as $uri => $text) {
  printf('<a href="%s" class="nav-link footer-link%s">%s</a>', $uri, ($current_page === $uri ? ' w--current' : ''), $text);
}
?>

