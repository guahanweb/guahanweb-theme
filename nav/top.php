<?php
$current_page = defined('CURRENT_PAGE') ? CURRENT_PAGE : '/';
$pages = array(
    '/' => 'Home',
    '/about' => 'About',
    '/blog' => 'Software',
    '/photos' => 'Photos',
    '/contact' => 'Contact'
  );

  echo <<<EOM
<div class="nav w-nav">
  <div class="w-container">
    <a href="#" class="w-nav-brand w--current">
      <div class="logo-text">GUAHAN<strong>WEB</strong></div>
    </a>
    <nav role="navigation" class="nav-menu w-nav-menu w-preserve-3d">
EOM;

  foreach ($pages as $k => $v) {
    $clsName = array('nav-link', 'w-nav-link');
    if ($k === '/contact') $clsName[] = 'contact';
    if ($k === $current_page) $clsName[] = 'w--current';

    printf("<a href=\"%s\" class=\"%s\">%s</a>\n", $k, implode(' ', $clsName), $v);
  }

  echo <<<EOM
    </nav>
    <div class="menu-button w-nav-button">
      <div class="w-icon-nav-menu"></div>
    </div>
  </div>
  <div class="w-nav-overlay"></div>
</div>
EOM;

