(function( $ ) {
	'use strict';

var PA_FULLSCREEN_LOGIN = {
    common: {
        init: function(){
            jQuery( document ).ready(function( $ ) {

                /**
                 * Emulate 2 labels fields by splitting the default one for #pafl_modal_link
                 * and hide url for #pafl_modal_link and #pafl_modal_link_register
                 */
                $( '#update-nav-menu' ).bind( 'click', function( e ) {
                    if ( e.target && e.target.className && -1 != e.target.className.indexOf( 'item-edit' ) ) {
                        $( "input[value='#pafl_modal_login'][type=text]" ).parent().parent().parent().each( function(){
                            var $this = $( this );
                            var item_id = $this.attr('id').substring( 'menu-item-settings-'.length );
                            var $url = $( '#edit-menu-item-url-' + item_id );
                            var $title = $( '#edit-menu-item-title-' + item_id );
                            var helper_tpl = '<p class="description description-thin"><label for="pafl-helper-{item_id}-{item_part}">{item_label}<br><input id="pafl-helper-{item_id}-{item_part}" class="widefat" type="text"></label></p>';

                            // Hide unwanted fields
                            $url.parent().parent().hide();
                            $title.parent().parent().hide();

                            // Remove helpers added previously
                            $( 'input[id^="pafl-helper-"]' ).parent().parent().remove();

                            // Split the Label to two part, login and logout labels
                            $this.prepend( $ ( helper_tpl.replaceArray( ['{item_id}', '{item_part}', '{item_label}'] , [ item_id, '2', pafl_strings.label_logout ] ) ) );
                            $this.prepend( $ ( helper_tpl.replaceArray( ['{item_id}', '{item_part}', '{item_label}'] , [ item_id, '1', pafl_strings.label_login ] ) ) );

                            // Populate Labels
                            var val_1 = $title.val().substr( 0, $title.val().indexOf(' // ' ) );
                            var val_2 = $title.val().substr( - $title.val().length + ' // '.length + val_1.length );
                            $( '#pafl-helper-' + item_id + '-1' ).val( val_1 );
                            $( '#pafl-helper-' + item_id + '-2' ).val( val_2 );

                            // Bind on-change handlers that update the hidden label field
                            $( 'input[id^="pafl-helper-"]', $this ).keyup( function() {
                                $title.val (
                                    $( '#pafl-helper-' + item_id + '-1' ).val()
                                    + ' // ' +
                                    $( '#pafl-helper-' + item_id + '-2' ).val()
                                );
                            });
                        });
                        $( "input[value='#pafl_modal_register'][type=text]" ).parent().parent().parent().each( function(){
                            var $this = $( this );
                            var item_id = $this.attr('id').substring( 'menu-item-settings-'.length );
                            var $url = $( '#edit-menu-item-url-' + item_id );

                            // Hide unwanted fields
                            $url.parent().parent().hide();
                        });
                    }
                });
            });

            /**
             * Find/Replace with arrays as parameters, see http://stackoverflow.com/a/5069776/358906
             */
            String.prototype.replaceArray = function(find, replace) {
                var replaceString = this;
                var regex;
                for (var i = 0; i < find.length; i++) {
                    regex = new RegExp(find[i], "g");
                    replaceString = replaceString.replace(regex, replace[i]);
                }
                return replaceString;
            };
        }
    }
};

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