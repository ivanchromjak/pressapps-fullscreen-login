(function( $ ) {
	'use strict';

	var PA_FULLSCREEN_LOGIN = {
		common : {
			init : function() {

				var overlay     = document.querySelector( 'div.pafl-overlay' );
				var triggerBttn = $( '#pafl-trigger-overlay, .pafl-trigger-overlay' );
				var closeBttn   = $( '.pafl-overlay-close' );

				$( 'body' ).addClass( 'pafl-container' );

				triggerBttn.on( 'click', function() {
					$( '.pafl-message' ).remove();
					$( 'body' ).addClass( 'pafl-open-modal' );
					PA_FULLSCREEN_LOGIN.common.show_screen( $( this ) );
					PA_FULLSCREEN_LOGIN.common.toggleOverlay( overlay );
					return false;
				} );

				//move .pafl-overlay after body
				$( '.pafl-overlay' ).insertAfter( 'body' );

				closeBttn.on( 'click', function() {
					$( '.pafl-message' ).remove();
					$( 'body' ).removeClass( 'pafl-open-modal' );
					PA_FULLSCREEN_LOGIN.common.toggleOverlay( overlay );
					return false;
				} );

				$( '.pafl-create-account' ).click( function() {
					$( '.pafl-message' ).remove();
					PA_FULLSCREEN_LOGIN.common.show_screen( $( this ) );
					return false;
				} );

				$( '.pafl-forgot-right, .pafl-forgot-left' ).click( function() {
					$( '.pafl-message' ).remove();
					PA_FULLSCREEN_LOGIN.common.show_screen( $( this ) );
					return false;
				} );

				$( ".pafl-allow-login" ).click( function() {
					$( '.pafl-message' ).remove();
					PA_FULLSCREEN_LOGIN.common.show_screen( $( this ) );
					return false;
				} );

				// Run our login ajax
				$( '.pafl-modal-content #pafl-form' ).on( 'submit', function( e ) {
					// Stop the form from submitting so we can use ajax.
					e.preventDefault();

					// Check what form is currently being submitted so we can return the right values for the ajax request.
					var form_id = $( this ).parent().attr( 'id' );
					// Remove any messages that currently exist.
					$( '.pafl-modal-wrap > p.message' ).remove();
					// Check if we are trying to login. If so, process all the needed form fields and return a failed or success message.

					if ( form_id === 'pafl-login' ) {
						//remove any message from previous request if there is
						$( '.pafl-message' ).remove();
						var loginData = $( '#pafl-login' ).attr( 'data-response' );
						$.ajax( {
							type : 'GET',
							dataType : 'json',
							url : PAFL.ajax_url,
							data : {
								'action' : 'ajaxlogin', // Calls our wp_ajax_nopriv_ajaxlogin
								'username' : $( '#pafl-form #login_user' ).val(),
								'password' : $( '#pafl-form #login_pass' ).val(),
								'rememberme' : ($( '#pafl-form #pafl-rememberme' ).is( ':checked' )) ? "TRUE" : "FALSE",
								'login' : $( '#pafl-form input[name="login"]' ).val(),
								'security' : $( '#pafl-form #security' ).val(),
								'g-recaptcha-response' : ( loginData != 'false' ? loginData : false ) //captcha response on user validation
							},
							success : function( results ) {
								// Check the returned data message. If we logged in successfully, then let our users know and remove the modal window.
								if ( results.loggedin && results.validation ) {
									$( '.pafl-modal-wrap > h2' ).after( '<p class="pafl-message pafl-success"></p>' );
									$( '.pafl-modal-wrap > .pafl-message' ).text( results.message ).show();
									PA_FULLSCREEN_LOGIN.common.redirectFunc( results.redirect );
								} else {
									$( '.pafl-modal-wrap > h2' ).after( '<p class="pafl-message pafl-error"></p>' );
									$( '.pafl-modal-wrap > .pafl-message' ).text( results.message ).show();
									if ( results.g_recaptcha_response !== false ) {
										//remove data-response for each completed request since it can't be reuse
										$( '#pafl-login' ).removeData( 'response' ).removeAttr( 'data-response' );
										//reset captcha
										grecaptcha.reset( loginCaptcha );
									}
								}
							},
							error : function( e ) {
								console.log( e );
							},
							beforeSend : function() {
								$( '.pafl-loader' ).fadeIn();
								$( '.pafl-section-container,.pafl-form-logo' ).css( {
									'-webkit-filter' : 'blur(5px)',
									'filter' : 'blur(5px)'
								} );
							},
							complete : function() {
								$( '.pafl-loader' ).fadeOut( 300, function() {
									$( '.pafl-section-container,.pafl-form-logo' ).css( {
										'-webkit-filter' : 'none',
										'filter' : 'none'
									} );
								} );
							}
						} );

					} else if ( form_id === 'pafl-register' ) {
						//remove any message from previous request if there is
						$( '.pafl-message' ).remove();
						var registerData = $( '#pafl-register' ).attr( 'data-response' );
						$.ajax( {
							type : 'GET',
							dataType : 'json',
							url : PAFL.ajax_url,
							data : {
								'action' : 'ajaxlogin', // Calls our wp_ajax_nopriv_ajaxlogin
								'username' : $( '#pafl-form #reg_user' ).val(),
								'email' : $( '#pafl-form #reg_email' ).val(),
								'register' : $( '#pafl-form input[name="register"]' ).val(),
								'security' : $( '#pafl-form #security' ).val(),
								'password' : $( '#pafl-form #reg_password' ).val(),
								'g-recaptcha-response' : ( registerData != 'false' ? registerData : false )//captcha response on user validation
							},
							success : function( results ) {
								if ( results.registerd && results.validation ) {
									$( '.pafl-modal-wrap > h2' ).after( '<p class="pafl-message pafl-success"></p>' );
									$( '.pafl-modal-wrap > .pafl-message' ).text( results.message ).show();
									$( '#pafl-register #pafl-form input:not(#user-submit)' ).val( '' );
									PA_FULLSCREEN_LOGIN.common.redirectFunc( results.redirect );
								} else {
									$( '.pafl-modal-wrap > h2' ).after( '<p class="pafl-message pafl-error"></p>' );
									$( '.pafl-modal-wrap > .pafl-message' ).text( results.message ).show();
									if ( results.g_recaptcha_response !== false ) {
										//remove data-response for each completed request since it can't be reuse
										$( '#pafl-login' ).removeData( 'response' ).removeAttr( 'data-response' );
										grecaptcha.reset( registerCaptcha );
									}
								}
							},
							error : function( e ) {
								console.log( e );
							},
							beforeSend : function() {
								$( '.pafl-loader' ).fadeIn();
								$( '.pafl-section-container,.pafl-form-logo' ).css( {
									'-webkit-filter' : 'blur(5px)',
									'filter' : 'blur(5px)'
								} );
							},
							complete : function() {
								$( '.pafl-loader' ).fadeOut();
								$( '.pafl-section-container,.pafl-form-logo' ).css( {
									'-webkit-filter' : 'none',
									'filter' : 'none'
								} );
							}
						} );

					} else if ( form_id === 'pafl-forgot' ) {
						//remove any message from previous request if there is
						$( '.pafl-message' ).remove();
						var forgotData = $( '#pafl-forgot' ).data( 'response' );
						$.ajax( {
							type : 'GET',
							dataType : 'json',
							url : PAFL.ajax_url,
							data : {
								'action' : 'ajaxlogin', // Calls our wp_ajax_nopriv_ajaxlogin
								'username' : $( '#pafl-form #forgot_login' ).val(),
								'forgotten' : $( '#pafl-form input[name="forgotten"]' ).val(),
								'security' : $( '#pafl-form #security' ).val(),
								'g-recaptcha-response' : ( forgotData != 'false' ? forgotData : false ) //captcha response on user validation
							},
							success : function( results ) {
								if ( results.reset && results.validation ) {
									$( '.pafl-modal-wrap > h2' ).after( '<p class="pafl-message pafl-success"></p>' );
									$( '.pafl-modal-wrap > .pafl-message' ).text( results.message ).show();
									$( '#pafl-forgot #pafl-form input:not(#pafl-forgot)' ).val( '' );
								} else {
									$( '.pafl-modal-wrap > h2' ).after( '<p class="pafl-message pafl-error"></p>' );
									$( '.pafl-modal-wrap > .pafl-message' ).text( results.message ).show();
									if ( results.g_recaptcha_response !== false ) {
										//remove data-response for each completed request since it can't be reuse
										$( '#pafl-login' ).removeData( 'response' ).removeAttr( 'data-response' );
										grecaptcha.reset( forgotCaptcha );
									}
								}
							},
							error : function( e ) {
								console.log( e );
							},
							beforeSend : function() {
								$( '.pafl-loader' ).fadeIn();
								$( '.pafl-section-container,.pafl-form-logo' ).css( {
									'-webkit-filter' : 'blur(5px)',
									'filter' : 'blur(5px)'
								} );
							},
							complete : function() {
								$( '.pafl-loader' ).fadeOut();
								$( '.pafl-section-container,.pafl-form-logo' ).css( {
									'-webkit-filter' : 'none',
									'filter' : 'none'
								} );
							}
						} );

					} else {
						// if all else fails and we've hit here... something strange happen and notify the user.
						$( '.pafl-modal-wrap > h2' ).after( '<p class="message error"></p>' );
						$( '.pafl-modal-wrap > p.message' ).text( 'Something  Please refresh your window and try again.' );
					}
				} );
				//implements the social login
				$( '.pafl-social-login' ).on( 'click', function(){
					$( '.pafl-loader' ).fadeIn();
					$( '.pafl-section-container,.pafl-form-logo' ).css( {
						'-webkit-filter' : 'blur(5px)',
						'filter' : 'blur(5px)'
					} );
				} );


				$( function(){
					var $pafl_message_window = $( '#pafl-message-window' );
					//will check if message window was displayed which occur during social login
					if ( $pafl_message_window.length !== 0 ) {
						$pafl_message_window.removeAttr('style').addClass('pafl-message-display');

						$( '.pafl-loader' ).fadeOut();
						$( '.pafl-section-container,.pafl-form-logo' ).css( {
							'-webkit-filter' : 'none',
							'filter' : 'none'
						} );

						//social login close function
						$( '.pafl-social-close' ).on( 'click', function(){
							$pafl_message_window.slideUp().delay(800).queue(function(next){
								$(this ).remove();
								next();
							});
						} );

						//will redirect toa the set page if success
						if ( $pafl_message_window.hasClass( 'pafl-success' ) ) {
							setTimeout( function(){
								window.location.assign( $pafl_message_window.attr( 'data-redirect' ) );
							}, 2000 );
						}
					}
				} );
			},
			show_screen : function( me ) {
				var get_screen;
				if ( typeof me.data( "form" ) !== 'undefined' ) {
					get_screen = me.data( "form" )
				} else if ( typeof me.attr( 'href' ) !== 'undefined' ) {
					get_screen = me.attr( 'href' )
				}
				$( "div.pafl-overlay div[class*=pafl-modal-content]" ).hide();

				if ( get_screen == 'login' || get_screen == '#pafl_modal_login' ) {
					$( "div.pafl-overlay div#pafl-login" ).show();
				} else if ( get_screen == 'register' || get_screen == '#pafl_modal_register' ) {
					$( "div.pafl-overlay div#pafl-register" ).show();
				} else if ( get_screen == 'forgot' || get_screen == '#pafl_modal_forgot' ) {
					$( "div.pafl-overlay div#pafl-forgot" ).show();
				}
			},
			toggleOverlay : function( overlay ) {

				var container = document.querySelector( 'body.pafl-container' );

				var transEndEventNames = {
					'WebkitTransition' : 'webkitTransitionEnd',
					'MozTransition' : 'transitionend',
					'OTransition' : 'oTransitionEnd',
					'msTransition' : 'MSTransitionEnd',
					'transition' : 'transitionend'
				};

				var transEndEventName;

				if ( typeof  Modernizr.prefixed !== 'undefined' ) {
					transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ];
				} else {
					transEndEventName = transEndEventNames[ 'transition' ];
				}

				var support = { transitions : Modernizr.csstransitions };

				if ( classie.has( overlay, 'pafl-open' ) ) {
					classie.remove( overlay, 'pafl-open' );
					classie.add( overlay, 'pafl-close' );
					if ( container != null ) {
						classie.remove( container, 'pafl-overlay-open' );
					}

					var onEndTransitionFn = function( ev ) {
						if ( support.transitions ) {
							if ( ev.propertyName !== 'visibility' ) {
								return;
							}
							this.removeEventListener( transEndEventName, onEndTransitionFn );
						}
						classie.remove( overlay, 'pafl-close' );
					};
					if ( support.transitions ) {
						overlay.addEventListener( transEndEventName, onEndTransitionFn );
					}
					else {
						onEndTransitionFn();
					}
				}
				else if ( ! classie.has( overlay, 'pafl-close' ) ) {
					classie.add( overlay, 'pafl-open' );
					if ( container != null ) {
						classie.add( container, 'pafl-overlay-open' );
					}
				}
			},

			redirectFunc : function( location ) {

				//if location is valid will redirect to location if not will redirect to current page
				if ( location !== '' ) {
					window.location.assign( location );
				} else {
					window.location.assign( PA_FULLSCREEN_LOGIN.common.currentPage() );
				}
			},

			currentPage : function() {
				return window.location.href;
			}
		}
	};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
	var UTIL = {
		fire : function( func, funcname, args ) {
			var namespace = PA_FULLSCREEN_LOGIN;
			funcname      = (funcname === undefined) ? 'init' : funcname;
			if ( func !== '' && namespace[ func ] && typeof namespace[ func ][ funcname ] === 'function' ) {
				namespace[ func ][ funcname ]( args );
			}
		},
		loadEvents : function() {
			UTIL.fire( 'common' );

			$.each( document.body.className.replace( /-/g, '_' ).split( /\s+/ ), function( i, classnm ) {
				UTIL.fire( classnm );
			} );
		}
	};

// Shuffle Array
	$.fn.shuffle = function() {
		return this.each( function() {
			var items = $( this ).children().clone( true );
			return (items.length) ? $( this ).html( $.shuffle( items ) ) : this;
		} );
	};

	$.shuffle = function( arr ) {
		for ( var j, x, i = arr.length; i; j = parseInt( Math.random() * i ), x = arr[ -- i ], arr[ i ] = arr[ j ], arr[ j ] = x );
		return arr;
	};

	$( document ).ready( UTIL.loadEvents );

})( jQuery );