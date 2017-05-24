<?php
$categories = get_the_category();
$cat = $categories[0];
$term_id = $cat->term_id;
$term_meta = get_option("taxonomy_$term_id");
?>
        <div class="blog-block w-col w-col-4 w-dyn-item">
          <a class="blog-link project-link w-inline-block" href="<?php the_permalink(); ?>">
            <div class="blog-image-wrapper">
              <div class="blog-date"><?php the_date(); ?></div>
<?php
if ($cat->slug !== 'uncategorized') {
  $color = $term_meta['color'];
  printf('<div class="blog-category %s" style="background-color: #%s">%s</div>', $cat->slug, $color, $cat->name);
}

$image = '';
if (has_post_thumbnail()) {
  $image = get_the_post_thumbnail_url(null, 'gw-card-thumb');
} elseif (isset($term_meta['image']) && '' !== $term_meta['image']) {
  $image_id = $term_meta['image'];
  $image = wp_get_attachment_image_url($image_id, 'gw-card-thumb');
}
printf('<div class="blog-image" style="background-image: url(\'%s\');"></div>', $image);
?>
              <div class="blog-image"></div>
            </div>
            <div class="blog-title"><?php echo $post->post_title; ?></div>
            <div class="blog-description"><?php echo $post->post_excerpt; ?></div>
            <div>
              <div class="blog-author">Written by</div>
              <div class="blog-author"><?php the_author(); ?></div>
            </div>
          </a>
        </div>

