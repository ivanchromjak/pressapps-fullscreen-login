<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Framework page settings
 */
$settings = array(
    'header_title' => 'Fullscreen Login',
    'menu_title'   => 'Fullscreen Login',
    'menu_type'    => 'add_submenu_page',
    'menu_slug'    => 'pressapps-fullscreen-login',
    'ajax_save'    => false,
);


/**
 * sections and fields option
 * @var array
 */
$options        = array();

/*
 *  Styling options tab and fields settings
 */
$options[]      = array(
    'name'        => 'styling',
    'title'       => 'Styling',
    'icon'        => 'fa fa-paint-brush',
    'fields'      => array(
        array(
            'id'      => 'modal_background', 
            'type'    => 'color_picker',
            'title'   => 'Modal Background',
        ),
        array(
            'id'      => 'text_color', 
            'type'    => 'color_picker',
            'title'   => 'Text Color',
            'help'    => 'Change content color, texts, links, icons "Content"',
        ),
        array(
            'id'      => 'modal_effect',
            'type'    => 'select',
            'title'   => 'Effect',
            'options' => array(
                'hugeinc'       => 'Huge Inc',
                'corner'        => 'Corner',
                'slidedown'     => 'Slide Down',
                'scale'         => 'Scale',
                'door'          => 'Door',
                'contentpush'   => 'Content Push',
                'contentscale'  => 'Content Scale',
                'simplegenie'   => 'Simple Genie',
            ),
            'default'    => 'hugeinc',
        ),
        array(
            'id'      => 'custom_css', 
            'type'    => 'textarea',
            'title'   => 'Custom CSS',
            'help'    => 'Overrides the default styles',
        ),
      
    ),
);

/*
 * General options tab and fields settings
 */
$options[]      = array(
    'name'        => 'social',
    'title'       => 'Social',
    'icon'        => 'fa fa-cogs',
    'fields'      => array(
        array(
            'id'      => 'followus', 
            'type'    => 'text',
            'title'   => 'Title',
            'default' => 'Follow Us',
        ),
        array(
            'id'              => 'social_links',
            'type'            => 'group',
            'title'           => 'Social Links',
            'button_title'    => 'Add New Social Link',
            'accordion_title' => 'Add New Field',
            'fields'          => array(
                array(
                    'id'      => 'social_icons',
                    'type'    => 'select',
                    'title'   => 'Icons',
                    'options' => array(
                        'facebook'  => "Facebook",
                        'googleplus'     => 'Google Plus',
                        'twitter'   => 'Twitter',
                        'feed'      => 'Feed',
                        'youtube'   => 'Youtube',
                        'vimeo'     => 'Vimeo',
                        'flickr'    => 'Flickr',
                        'picassa'   => 'Picassa',
                        'dribbble'   => 'Dribbble',
                        'github'    => 'Github',
                        'soundcloud'=> 'Soundcloud',
                        'linkedin'  => 'Linkedin',
                        'pinterest' => 'Pinterest',
                    ),
                    'default' => 'facebook',
                    'class'   =>'chosen',
                    'after'   => '<span id="pafb-icon-preview" class="fni-facebook"></span>'
                ),
                array(
                  'id'        => 'social_url',
                  'type'      => 'text',
                  'title'     => 'URL',
                ),
                
            ),
        ),
    ),
);

SkeletFramework::instance( $settings, $options );
