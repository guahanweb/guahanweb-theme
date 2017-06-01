<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@guahanweb" />
<?php
sprintf('<meta name="twitter:title" content="%s" />', single_post_title());
sprintf('<meta name="twitter:description" content="%s" />', apply_filters('get_the_excerpt', $post->the_excerpt));
echo '<meta name="twitter:image" content="" />';
?>
