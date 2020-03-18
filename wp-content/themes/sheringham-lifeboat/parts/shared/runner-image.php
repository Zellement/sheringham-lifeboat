<?php if ( have_posts() ) while ( have_posts() ) : the_post();

	$large_id = get_post_thumbnail_id();
	$large_url_array = wp_get_attachment_image_src($large_id, 'runner-large', true);
	$large_url = $large_url_array[0];

	$medium_id = get_post_thumbnail_id();
	$medium_url_array = wp_get_attachment_image_src($medium_id, 'runner-medium', true);
	$medium_url = $medium_url_array[0];

	$small_id = get_post_thumbnail_id();
	$small_url_array = wp_get_attachment_image_src($small_id, 'runner-small', true);
	$small_url = $small_url_array[0];

endwhile; ?>

<div class="hero">
	<picture>
	    <source srcset="<?php echo $large_url; ?>" media="(min-width: 1000px)" />
	    <source srcset="<?php echo $medium_url; ?>" media="(min-width: 600px)" />
	    <img srcset="<?php echo $small_url; ?>" alt="Sheringham Lifeboat" />
	</picture>
	<?php if (!is_single($post)) : ?>
	<div class="hero-text">
		<h1><?php the_field('hero_title'); ?></h1>
		<p><?php the_field('sub_hero_title'); ?></p>
	</div>
<?php endif; ?>
</div>