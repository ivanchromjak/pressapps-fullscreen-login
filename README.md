#Pressapps Fullscreen Plugin

###Login Link Shortcode

**Description**

`[pafl_login_link login_text="" logout_text=""]` use to generate the login link and logout link.

**Options**

| Attributes  | Description |
| ----------- | ----------- |
| `login_text`  | text to be displayed on a login link |
| `logout_text` | text to be displayed on a logout link |

**Function**

```
function pafl_login_link( $atts ) {
  $atts = shortcode_atts(
      array(
          'login_text'      => __( 'Login', 'pressapps-fullscreen-login' ),
          'logout_text' 	=> __( 'Logout', 'pressapps-fullscreen-login' )
      ), $atts, 'pafl_login_link'
  );

  if ( is_user_logged_in() ){
      return '<a href="' . wp_logout_url() . '" >' . $atts['logout_text'] . '</a>';
  } else {
      return '<a href="#" onclick="return false" data-form="login"  title="pafl-trigger-overlay">' . $atts['login_text'] . '</a>';
  }
}
```

---

###Register Link Shortcode

**Description**

`[pafl_register_link register_text=""]` use to generate the registration link.

**Option**

| Attribute  | Description |
| ----------- | ----------- |
| `register_text`  | text to be displayed on a registration link |


**Function**

```
function pafl_register_link( $atts ) {
  $atts = shortcode_atts(
    array(
        'register_text' => __( 'Create an Account', 'pressapps-fullscreen-login' )
    ), $atts, 'pafl_register_link'
  );
    
  if ( ! is_user_logged_in() ){
     return '<a href="#" onclick="return false" data-form="register"  title="pafl-trigger-overlay">' . $atts['register_text'] . '</a>';
  }
}
```