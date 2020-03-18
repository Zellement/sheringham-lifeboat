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
 * Template Name: History
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

	<article class="lifeboats">

	<?php /* Start crew members */ ?>

		<?php if( have_rows('lifeboat_history') ): ?>

			<section>

				<header>
					<h2>Lifeboats Through the Ages</h2>
				</header>

				<ul class="lifeboat-history">

				<?php while( have_rows('lifeboat_history') ): the_row(); ?>

					<li>

						<h3 class="lifeboat"><?php the_sub_field('lifeboat'); ?></h3>
						<span class="from_to"><i class="fa fa-calendar-o"></i> <?php the_sub_field('from_to'); ?></span>
						<?php if (get_sub_field('additional_info')) : ?><span class="additional_info"><?php the_sub_field('additional_info'); ?></span><?php endif;?>
						<?php $image = get_sub_field('image');
							if( !empty($image) ): 
								$url = $image['url'];
								$alt = $image['alt'];
								$thumb = $image['sizes'][ 'runner-medium' ]; ?>
								<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
							<?php endif; ?>
						<span class="details"><?php the_sub_field('details'); ?></span>

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
        $('aside').insertAfter('article.lifeboats');
    }
});

</script>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>