<?php
/**
 * Blog Page Template
 * The home page template file
 *
 * This is the template for the Home Page
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage GuahanwebTheme
 * @since GuahanWeb Theme 1.0
 */

define('CURRENT_PAGE', '/blog');
get_header();
?>
<section class="hero-section blog-hero">
    <?php get_template_part('nav/top'); ?>
    <h1 class="blog-heading"><?php _e('Ramblings of an Idle Mind', 'guahanweb'); ?></h1>
    <div class="hero-overlay"></div>
</section>
<section class="section">
    <div class="w-container">
      <div class="w-dyn-items w-row">
      <?php
      while (have_posts()) {
        the_post();
        get_template_part('post/list', 'item');
      }
      ?>
      </div>
    </div>
</section>
<section class="section">
  <nav class="page-nav">
    <?php
    $older = get_next_posts_link('Older posts', 10);
    $newer = get_previous_posts_link('Newer posts', 10);

    if (!empty($newer)) {
      printf('<div class="nav-link nav-previous">%s</div>', $newer);
    }

    if (!empty($older)) {
      printf('<div class="nav-link nav-next">%s</div>', $older);
    }
    ?>
  </nav>
</section>
<?php
get_template_part('content', 'cta');
get_footer();
?>

