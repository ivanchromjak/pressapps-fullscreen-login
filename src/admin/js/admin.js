(function( $ ) {
	'use strict';

var PA_FULLSCREEN_LOGIN = {
    common: {
        init: function(){
        	
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