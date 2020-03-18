<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header', 'parts/shared/runner-image' ) ); ?>

<div class="content-container">

	<article>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<header>
		<h1><?php the_title(); ?></h1>
		</header>

		<?php the_content(); ?>

		<?php endwhile; ?>

	</article>

	<?php get_sidebar(); ?>

</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>