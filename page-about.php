<?php
/**
 * About Page Template
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

define('CURRENT_PAGE', '/about');
get_header();
?>
<section class="hero-section about-page">
    <?php get_template_part('nav/top'); ?>
    <h1 class="blog-heading"><?php the_title(); ?></h1>
    <div class="hero-overlay"></div>
</section>
<section class="section">
    <div class="w-container">
        <div class="w-richtext">
            <?php
            while (have_posts()): the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</section>
<?php
get_template_part('content', 'cta');
get_footer();
?>

