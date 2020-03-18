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
 * Template Name: Home Page
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

	<?php 

	$customMedium = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'square-large' );
	$displayMedium = $customMedium['0'];

	$customLarge = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'soft-large' );
	$displayLarge = $customLarge['0'];

	if ( has_post_thumbnail() ) : ?>

		<style>

			.full-bg {
				background-image: url(<?php echo $displayMedium; ?>);
			}

			@media (min-width: 600px) {
				.full-bg {background-image: url(<?php echo $displayLarge; ?>)};
			}

		</style>

	<?php endif; ?>

<div class="full-bg">
	
	<div class="index-hero">

		<h1>Saving life at sea.</h1>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
		<a class="btn" href="<?php echo home_url(); ?>/lifeboat">The Lifeboat</a>
		<a class="btn" href="<?php echo home_url(); ?>/crew">The Crew</a>

	</div>

</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>