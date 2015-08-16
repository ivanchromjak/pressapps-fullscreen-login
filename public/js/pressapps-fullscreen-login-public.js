(function( $ ) {
	'use strict';

var PA_FULLSCREEN_LOGIN = {
    common: {
        init: function(){

        	var overlay 	= document.querySelector( 'div.pafl-overlay' ),
				triggerBttn = $( '#pafl-trigger-overlay, a[title=pafl-trigger-overlay]' ),
        		closeBttn 	= $( 'button.pafl-overlay-close' );
		
			triggerBttn.on( 'click', function(){
				PA_FULLSCREEN_LOGIN.common.show_screen( $(this) );
				PA_FULLSCREEN_LOGIN.common.toggleOverlay( overlay );
				return false;
			});

			closeBttn.on( 'click', function(){ 
				PA_FULLSCREEN_LOGIN.common.toggleOverlay( overlay );
				return false; 
			});

        },
        show_screen: function( me ){
        	var get_screen; 
        	if( typeof me.data("form") !== 'undefined' ){
        		get_screen = me.data("form")
        	}else if( typeof me.attr('href') !== 'undefined' ){
        		get_screen = me.attr('href')
        	}
        	$("div.pafl-overlay div[class*=pafl-modal-content]").hide();

        	if( get_screen == 'login' || get_screen == '#pafl_modal_login' ){
        		$("div.pafl-overlay div#login").show();
        	}else if( get_screen == 'register' || get_screen == '#pafl_modal_register' ){
        		$("div.pafl-overlay div#register").show();
        	}

        },
        toggleOverlay: function( overlay ) {
        		
        		var container = document.querySelector( 'body.pafl-container' );
				
				var transEndEventNames = {
					'WebkitTransition': 'webkitTransitionEnd',
					'MozTransition': 'transitionend',
					'OTransition': 'oTransitionEnd',
					'msTransition': 'MSTransitionEnd',
					'transition': 'transitionend'
				};

				var transEndEventName;

				if( typeof  Modernizr.prefixed !== 'undefined' ){
				 	transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ];
				}else{
					transEndEventName = transEndEventNames[  'transition'  ];
				}
				
				var support = { transitions : Modernizr.csstransitions };

				if( classie.has( overlay, 'open' ) ) {
					classie.remove( overlay, 'open' );
					classie.add( overlay, 'close' );
					if( container != null){
						classie.remove( container, 'pafl-overlay-open' );
					}

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
					if( container != null ){
						classie.add( container, 'pafl-overlay-open' );
					}
				}
		}
    }
}

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = PA_FULLSCREEN_LOGIN;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};
	
// Shuffle Array
$.fn.shuffle = function() {
    return this.each(function(){
        var items = $(this).children().clone(true);
        return (items.length) ? $(this).html($.shuffle(items)) : this;
    });
}
 
$.shuffle = function(arr) {
    for(var j, x, i = arr.length; i; j = parseInt(Math.random() * i), x = arr[--i], arr[i] = arr[j], arr[j] = x);
    return arr;
}

$(document).ready(UTIL.loadEvents);

})( jQuery );