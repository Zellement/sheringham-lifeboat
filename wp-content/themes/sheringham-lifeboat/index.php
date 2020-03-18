<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file 
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

  $page_id = "12";

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
			<h1>Latest News</h1>
			<p>Read about what we've been up to.</p>
		<?php endwhile; ?>
	</div>

</div>

<div class="content-container">

	<article>

	<?php if ( have_posts() ): ?>
	<header>
		<h1>Latest News</h1>
	</header>
	<ol>
	<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<article>
				<h3><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> 
				<?php the_content(); ?>
			</article>
		</li>
	<?php endwhile; ?>
	</ol>
	<?php else: ?>
	<h2>No posts to display</h2>
	<?php endif; ?>
		
	</article>

	<?php get_sidebar(); ?>

</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>