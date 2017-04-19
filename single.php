<?php
/**
 * Single Post Template
 *
 * This is the template for a single blog post
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage GuahanwebTheme
 * @since GuahanWeb Theme 1.0
 */

define('CURRENT_PAGE', '/blog');
get_header();
if (have_posts()): the_post();
    $id = get_the_ID();
?>
<section class="hero-section blog-post-hero">
    <?php get_template_part('nav/top'); ?>
    <div class="hero-text-wrapper w-container">
        <h1 class="blog-heading"><?php the_title(); ?></h1>
        <div>
            <div class="blog-details"><?php the_author(); ?></div>
            <div class="blog-details">|</div>
            <div class="blog-details">Node.js</div>
            <div class="blog-details">|</div>
            <div class="blog-details"><?php the_date(); ?></div>
        </div>
    </div>
    <div class="hero-overlay"></div>
</section>
<section class="top-section">
    <div class="hero-container w-container">
        <div class="blog-post-wrapper">
            <div class="project-text w-richtext">
                <?php the_content(); ?>
            </div>
        </div>
        <div class="author-wrapper">
            <?php echo get_avatar(get_the_author_meta('ID'), 150, null, false, array(
                'class' => 'author-image',
                'extra_attr' => 'sizes="150px"'
            )); ?>
            <div class="author-name"><?php the_author(); ?></div>
            <div class="author-bio"><?php echo get_the_author_meta('bio'); ?></div>
        </div>
    </div>
</section>
<?php else: ?>
<section class="no-post">
    No post!
</section>
<?php endif; ?>

<?php
// show recent posts, if we can query some
$query = new WP_Query(array(
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 3,
    'post__not_in' => array($id)
));
if ($query->have_posts()):
?>
<section class="section gray-section">
    <div class="w-container">
        <div class="center">
            <h2>Recent Blog Posts</h2>
            <div class="dark-divider small-divider"></div>
        </div>
        <div class="w-dyn-list">
            <div class="w-dyn-items w-row">
            <?php
            while ($query->have_posts()): $query->the_post();
                get_template_part('post/list', 'item');
            endwhile;
            ?>
            </div>
        </div>
    </div>
</section>
<?php
endif;
?>

<?php
get_template_part('content', 'cta');
get_footer();
?>

