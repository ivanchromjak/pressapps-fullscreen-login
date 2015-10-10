(function( $ ) {
	'use strict';

	var PA_FULLSCREEN_LOGIN = {
		common : {
			init : function() {

				var overlay     = document.querySelector( 'div.pafl-overlay' ),
				    triggerBttn = $( '#pafl-trigger-overlay, .pafl-trigger-overlay' ),
				    closeBttn   = $( '.pafl-overlay-close' );

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
							url : pafl_modal_login_script.ajax,
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
							url : pafl_modal_login_script.ajax,
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
							url : pafl_modal_login_script.ajax,
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

				//check if fb_login_id object exist and execute the function
				if ( typeof pafl_modal_login_script.fb_login_id !== 'undefined' ) {
					PA_FULLSCREEN_LOGIN.common.facebook_login();
				}
				//check if twitter_login_id object exist and execute the function
				if ( typeof pafl_modal_login_script.twitter_login_id !== 'undefined' ) {
					PA_FULLSCREEN_LOGIN.common.twitter_login();
				}
				//check if google_plus_login_id object exist and execute the function
				if ( typeof pafl_modal_login_script.google_login_id !== 'undefined' ) {
					PA_FULLSCREEN_LOGIN.common.google_login();
				}
			},
			facebook_login : function() {
				$( function() {
					$.ajaxSetup({ cache: true });
					$.getScript('//connect.facebook.net/en_US/sdk.js', function(){

						if ( typeof pafl_modal_login_script.fb_login_id !== 'undefined' ) {
							FB.init({
								appId: pafl_modal_login_script.fb_login_id,
								version: 'v2.4'
							});
						}

						var $fb_login = $( '#pafl-fb-login' );
						//check if fb sdk is loaded and will removed disabled
						$fb_login.removeAttr('disabled' );
						//check on init if response status is connected or not
						FB.getLoginStatus( function( response ){
							//if user is connected to the app but not logged in to wp
							if ( response.status === 'connected' && ! pafl_modal_login_script.is_user_logged_in ) {
								FB.logout();
							}
						} );

						//trigger facebook login API on click of the fb login button
						$fb_login.on( 'click', function(e){
							e.preventDefault();
							FB.login( function( response ) {
								if ( response.authResponse ) {
									FB.api('/me', { 'fields' : ['email','last_name','first_name', 'picture'] },function( user ){
										//will do an ajax request to either create a user or login the user
										$.ajax( {
											type: 'GET',
											dataType : 'json',
											url : pafl_modal_login_script.ajax,
											data : {
												action : 'ajaxSocialLogin',
												email : user.email,
												id : response.authResponse.userID,
												fname : user.first_name,
												lname : user.last_name,
												auth : response.authResponse.accessToken,
												avatar : user.picture.data.url,
												nonce : $( '#pafl-fb-login' ).attr( 'data-nonce' )
											},
											success : function( data ) {
												if ( data.loggedin ) {
													PA_FULLSCREEN_LOGIN.common.display_success( data.message );
													PA_FULLSCREEN_LOGIN.common.redirectFunc( data.redirect );
												} else {
													PA_FULLSCREEN_LOGIN.common.display_error( data.message );
												}
											},
											error : function(e){
												console.log(e);
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
									});
								}
							}, { scope : 'public_profile, email' } );
						} ); // end of $fb_login on click
					});
				});
			},
			twitter_login : function() {

			},
			google_login : function() {
				$(function(){
					$.ajaxSetup({ cache: true });
					$.getScript( 'https://apis.google.com/js/platform.js', function(){
						//initialize API Call
						var $google_login = $( '#pafl-google-login' );
						$google_login.removeAttr('disabled');

						gapi.load( 'auth2', function(){
							gapi.auth2.init({
								client_id : pafl_modal_login_script.google_login_id,
								fetch_basic_profile : true
							});
						} );

						$google_login.on( 'click', function(){
							gapi.signin2.render('pafl-google-login', {
								'scope': 'https://www.googleapis.com/auth/plus.login',
								'onsuccess': PA_FULLSCREEN_LOGIN.common.google_login_success,
								'onfailure': PA_FULLSCREEN_LOGIN.common.google_login_fail
							});
						} );

					} );

				});
			},
			google_login_success : function( googleUser ) {
				var profile = googleUser.getBasicProfile();
				$.ajax( {
					type: 'GET',
					dataType : 'json',
					url : pafl_modal_login_script.ajax,
					data : {
						action : 'ajaxSocialLogin',
						email : profile.getEmail(),
						id : profile.getId(),
						fname : profile.getName(),
						lname : '',
						auth : googleUser.getAuthResponse().id_token,
						avatar : profile.getImageUrl(),
						nonce : $( '#pafl-google-login' ).attr( 'data-nonce' )
					},
					success : function( data ) {
						if ( data.loggedin ) {
							PA_FULLSCREEN_LOGIN.common.display_success( data.message );
							PA_FULLSCREEN_LOGIN.common.redirectFunc( data.redirect );
						} else {
							PA_FULLSCREEN_LOGIN.common.display_error( data.message );
						}
					},
					error : function(e){
						console.log(e);
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
			},
			google_login_fail : function() {
				gapi.auth2.init({
					client_id : pafl_modal_login_script.google_login_id,
					fetch_basic_profile : true
				});
				var profile = googleUser.getBasicProfile();
				console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
				console.log('Name: ' + profile.getName());
				console.log('Image URL: ' + profile.getImageUrl());
				console.log('Email: ' + profile.getEmail());
			},
			// Display error message on login screen
			display_error : function( $error_msg ) {
				$( '.pafl-message' ).remove();
				$( '.pafl-modal-wrap > h2' ).after( '<p class="pafl-message pafl-error"></p>' );
				$( '.pafl-modal-wrap > .pafl-message' ).text( $error_msg ).show();
			},
			display_info : function( $info_msg ) {
				$( '.pafl-message' ).remove();
				$( '.pafl-modal-wrap > h2' ).after( '<p class="pafl-message pafl-info"></p>' );
				$( '.pafl-modal-wrap > .pafl-message' ).text( $info_msg ).show();
			},
			display_success : function( $info_msg ) {
				$( '.pafl-message' ).remove();
				$( '.pafl-modal-wrap > h2' ).after( '<p class="pafl-message pafl-success"></p>' );
				$( '.pafl-modal-wrap > .pafl-message' ).text( $info_msg ).show();
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
	}

	$.shuffle = function( arr ) {
		for ( var j, x, i = arr.length; i; j = parseInt( Math.random() * i ), x = arr[ -- i ], arr[ i ] = arr[ j ], arr[ j ] = x );
		return arr;
	}

	$( document ).ready( UTIL.loadEvents );

})( jQuery );