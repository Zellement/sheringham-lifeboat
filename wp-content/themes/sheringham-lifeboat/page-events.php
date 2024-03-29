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
 * Template Name: Events
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header', 'parts/shared/runner-image' ) ); ?>

<div class="content-container">

	<article>

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
		<?php endwhile; ?>

	<?php 

		$posts = get_posts(array(
			'posts_per_page'	=> -1,
			'post_type'			=> 'event',
			'meta_key'			=> 'date',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'DESC'
		));

		if( $posts ): ?>
			
			<ul class="shouts">
				
			<?php foreach( $posts as $post ): 
				
				setup_postdata( $post )
				
				?>
				<li>
					<i class="fa fa-bell"></i>
					<span class="date-time"><?php the_title(); ?></span>
					<ul>
						<li><span>Date</span> <?php the_field('date'); ?></li>
						<li><span>Tine</span> <?php the_field('time'); ?></li>
						<li><span>Location</span> <?php the_field('location'); ?></li>
					</ul>
					<a class="btn" href="<?php the_permalink(); ?>">See the details &raquo;</a>
				</li>
			
			<?php endforeach; ?>
			
			</ul>
			
			<?php wp_reset_postdata(); ?>

	<?php endif; ?>
		
	</article>

	<?php get_sidebar(); ?>

</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>