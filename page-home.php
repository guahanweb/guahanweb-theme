<?php
/**
 * Home Page Template
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

define('CURRENT_PAGE', '/');
get_header();
?>
<section class="hero-section home-page-hero">
    <?php get_template_part('nav/top'); ?>
    <h1 class="home-page-heading"><?php echo get_the_title(); ?></h1>
    <div class="hero-overlay"></div>
</section>
<section class="home-page section top-section">
    <div class="hero-container w-container">
        <div class="w-clearfix">
            <div class="_60block">
                <a href="/blog" class="technology hero-tile w-inline-block">
                    <div class="tile-text">Software</div>
                    <div class="tile-image">
                        <div class="tile-overlay"></div>
                    </div>
                </a>
            </div>
            <div class="_40block">
                <a href="/photography" class="photography hero-tile w-inline-block">
                    <div class="tile-text">Photos</div>
                    <div class="tile-image">
                        <div class="tile-overlay"></div>
                    </div>
                </a>
            </div>
            <div class="_33block">
                <a href="/about" class="about hero-tile w-inline-block">
                    <div class="tile-text">Photos</div>
                    <div class="tile-image">
                        <div class="tile-overlay"></div>
                    </div>
                </a>
            </div>
            <div class="_33block">
                <a href="/latest" class="latest hero-tile w-inline-block">
                    <div class="tile-text">Latest<br>Posts</div>
                    <div class="tile-image">
                        <div class="tile-overlay"></div>
                    </div>
                </a>
            </div>
            <div class="_33block">
                <div class="w-clearfix">
                    <a href="#" class="social-block w-inline-block"></a>
                    <a href="#" class="social-block facebook inline-block"></a>
                    <a href="#" class="social-block pinterest inline-block"></a>
                    <a href="#" class="social-block dribbble inline-block"></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
?>

