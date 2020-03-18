	<header class="site-header">

		<h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<a href="<?php echo home_url(); ?>"><img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" alt="" /></a>

		<div id="trigger-overlay"><i class="fa fa-bars"></i> Menu</div>

		<ul class="social">
			<li><a href="https://twitter.com/SheringhamRNLI"><i class="fa fa-twitter"></i></a></li>
			<li><a href="https://www.facebook.com/sheringhamlifeboat?ref=ts&fref=ts"><i class="fa fa-facebook"></i></a></li>
			<li><a href="https://plus.google.com/108618014306968005071/posts"><i class="fa fa-google-plus"></i></a></li>
		</ul>

		<div class="overlay overlay-door">
			<button type="button" class="overlay-close">Close</button>
			<nav>
				<h1>Navigation</h1>
				<?php wp_nav_menu( array('menu' => 'Primary', 'container' => false, 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', )); ?>
			</nav>
		</div>
	</header>