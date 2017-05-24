<?php
/**
 * Photos Page Template
 * The photos page template file
 *
 * This is the template for the Photos Page
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage GuahanwebTheme
 * @since GuahanWeb Theme 1.0
 */

define('CURRENT_PAGE', '/photos');
get_header();
?>
<section class="hero-section portfolio-hero">
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

