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
 * Template Name: Crew
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

	<article class="crew">

	<?php /* Start crew members */ ?>

		<?php if( have_rows('crewmen') ): ?>

			<section>

				<header>
					<h2>Crewmen &amp; Crewwomen</h2>
				</header>

				<ul class="crew-members">

				<?php while( have_rows('crewmen') ): the_row(); ?>

					<li>
						<?php $image = get_sub_field('image');
							if( !empty($image) ): 
								$url = $image['url'];
								$alt = $image['alt'];
								$thumb = $image['sizes'][ 'crew-image' ]; ?>
								<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
							<?php else : ?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/missing-crew-member.jpg" alt="Missing photo" />
							<?php endif; ?>

						<span class="name"><?php the_sub_field('name'); ?></span>
						<span class="role"><?php the_sub_field('role'); ?></span>

					</li>

				<?php endwhile; ?>

				</ul>

			</section>

		<?php endif; ?>

		<?php if( have_rows('shoremen') ): ?>

			<section>

				<header>
					<h2>Shoremen &amp; Shorewomen</h2>
				</header>

				<ul class="crew-members">

				<?php while( have_rows('shoremen') ): the_row(); ?>

					<li>
						<?php $image = get_sub_field('image');
							if( !empty($image) ): 
								$url = $image['url'];
								$alt = $image['alt'];
								$thumb = $image['sizes'][ 'crew-image' ]; ?>
								<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
							<?php else : ?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/missing-crew-member.jpg" alt="Missing photo" />
							<?php endif; ?>

						<span class="name"><?php the_sub_field('name'); ?></span>
						<span class="role"><?php the_sub_field('role'); ?></span>

					</li>

				<?php endwhile; ?>

				</ul>

			</section>

		<?php endif; ?>

		<?php if( have_rows('other') ): ?>

			<section>

				<header>
					<h2>Support</h2>
				</header>

				<ul class="crew-members">

				<?php while( have_rows('other') ): the_row(); ?>

					<li>
						<?php $image = get_sub_field('image');
							if( !empty($image) ): 
								$url = $image['url'];
								$alt = $image['alt'];
								$thumb = $image['sizes'][ 'crew-image' ]; ?>
								<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
							<?php else : ?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/missing-crew-member.jpg" alt="Missing photo" />
							<?php endif; ?>

						<span class="name"><?php the_sub_field('name'); ?></span>
						<span class="role"><?php the_sub_field('role'); ?></span>

					</li>

				<?php endwhile; ?>

				</ul>

			</section>

		<?php endif; ?>

	</article>

</div>

<script>
$(document).ready(function() {
    if ($('article').css("float") != "left" ){
    	//alert("oh hi");
        $('aside').insertAfter('article.crew');
    }
});

</script>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>