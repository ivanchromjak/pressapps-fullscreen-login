#Pressapps Fullsrcreen Plugin

##Shortcode Usage

###Login Link Shortcode

Shortcode use to generate the login and logout link.


| Attributes  | Description |
| ----------- | ----------- |
| login_text  | text to be displayed on a login link |
| logout_text | text to be displayed on a logout link |

**Login Link Function**


```
function pafl_login_link( $atts ) {
  $atts = shortcode_atts(
      array(
          'login_text'      => __( 'Login', 'pressapps-fullscreen-login' ),
          'logout_text' 	=> __( 'Logout', 'pressapps-fullscreen-login' )
      ), $atts, 'pafl_login_link'
  );

  if ( is_user_logged_in() ){
      echo '<a href="' . wp_logout_url() . '" >' . $atts['logout_text'] . '</a>';
  } else {
      echo '<a href="#" onclick="return false" data-form="login"  title="pafl-trigger-overlay">' . $atts['login_text'] . '</a>';
  }
}
```

###Login Link Shortcode

Shortcode use to generate the Registration Link


| Attributes  | Description |
| ----------- | ----------- |
| register_text  | text to be displayed on a Registration link |


**Register Link Function**


```
function pafl_register_link( $atts ) {
  $atts = shortcode_atts(
    array(
        'register_text' => __( 'Create an Account', 'pressapps-fullscreen-login' )
    ), $atts, 'pafl_register_link'
  );
    
  echo '<a href="#" onclick="return false" data-form="register"  title="pafl-trigger-overlay">' . $atts['register_text'] . '</a>';
}
```