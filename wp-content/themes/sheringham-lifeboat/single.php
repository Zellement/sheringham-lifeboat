<?php
/**
 * The Template for displaying all single posts
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