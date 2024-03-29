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
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>


<?php

  $page_id = "89";

  if (has_post_thumbnail($page_id) ):

  	$large_id = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'runner-large' );
	$large_url = $large_id[0];

  	$medium_id = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'runner-medium' );
	$medium_url = $medium_id[0];

  	$small_id = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'runner-small' );
	$small_url = $small_id[0];

   endif;
  
?>

<div class="hero">
	<picture>
	    <source srcset="<?php echo $large_url; ?>" media="(min-width: 1000px)" />
	    <source srcset="<?php echo $medium_url; ?>" media="(min-width: 600px)" />
	    <img srcset="<?php echo $small_url; ?>" alt="Sheringham Lifeboat" />
	</picture>

	<div class="hero-text">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
		<?php endwhile; ?>
	</div>

</div>



<div class="content-container">
	<article>

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<h2><?php the_title(); ?></h2>

		<?php endwhile; ?>

				<ul class="shout-details">
					<li><span>Date</span> <?php the_field('date'); ?></li>
					<li><span>Time</span> <?php the_field('time'); ?></li>
					<li><span>Location</span> <?php the_field('location'); ?></li>
				</ul>

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>

				<?php endwhile; ?>


				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<ul class="next-prev">
					<li class="prev"><?php next_post_link( '%link', '&laquo; Previous Event' ); ?></li>
					<li class="next"><?php previous_post_link( '%link', 'Next Event &raquo;' ); ?></li>
				</ul>

				<?php endwhile; ?>

			<?php //comments_template( '', true ); ?>


	</article>

<?php get_sidebar(); ?>

</div>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>