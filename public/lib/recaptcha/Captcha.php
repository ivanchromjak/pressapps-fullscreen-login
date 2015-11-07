<?php
/**
 * Copyright (c) 2015, Aleksey Korzun <aleksey@webfoundation.net>
 * All rights reserved.
 *
 */

class PAFL_Captcha
{
    /**
     * reCaptcha's API server
     *
     * @var string
     */
    const SERVER = '//www.google.com/recaptcha/api';

    /**
     * reCaptcha's verify server
     *
     * @var string
     */
    const VERIFY_SERVER = 'www.google.com';

    /**
     * The Remote IP Address
     *
     * @var string
     */
    protected $remoteIp;

    /**
     * Private key
     *
     * @var string
     */
    protected $privateKey;

    /**
     * Public key
     *
     * @var string
     */
    protected $publicKey;

    /**
     * Custom error message to return
     *
     * @var string
     */
    protected $error;

    /**
     * The theme we use. The default theme is light, but you can change it using setTheme()
     *
     * @var string
     * @see https://developers.google.com/recaptcha/docs/display
     */
    protected $theme = 'light';

    /**
     * Type of widget to display. The default type is image.
     *
     * @var string
     * @see https://developers.google.com/recaptcha/docs/display
     */
    protected $type = 'image';

    /**
     * Size of widget to display. The default type is normal.
     *
     * @var string
     * @see https://developers.google.com/recaptcha/docs/display
     */
    protected $size = 'normal';

    /**
     * Optional tab index for input elements within the widget.
     *
     * @var int
     * @see https://developers.google.com/recaptcha/docs/display
     */
    protected $tabIndex = 0;

    /**
     * An array of supported themes.
     *
     * @var string[]
     * @see https://developers.google.com/recaptcha/docs/display
     */
    protected static $themes = array(
        'light',
        'dark'
    );

    /**
     * An array of supported data types.
     *
     * @var string[]
     * @see https://developers.google.com/recaptcha/docs/display
     */
    protected static $types = array(
        'image',
        'audio'
    );

    /**
     * An array of supported data sizes.
     *
     * @var string[]
     * @see https://developers.google.com/recaptcha/docs/display
     */
    protected static $sizes = array(
        'normal',
        'compact'
    );

    /**
     * An array of supported $ids.
     *
     * @var string[]
     */
    protected $id = array();

    /**
     * Set public key
     *
     * @param string $key
     * @return reCaptcha
     */
    public function setPublicKey($key)
    {
        $this->publicKey = $key;
        return $this;
    }

    /**
     * Retrieve currently set public key
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * Set private key
     *
     * @param string $key
     * @return reCaptcha
     */
    public function setPrivateKey($key)
    {
        $this->privateKey = $key;
        return $this;
    }

    /**
     * Retrieve currently set private key
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * Set remote IP
     *
     * @param string $ip
     * @return reCaptcha
     */
    public function setRemoteIp($ip)
    {
        $this->remoteIp = $ip;
        return $this;
    }

    /**
     * Get remote IP
     *
     * @return string
     */
    public function getRemoteIp()
    {
        if ($this->remoteIp) {
            return $this->remoteIp;
        }

        if (isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }

        return null;
    }

    /**
     * Set error string
     *
     * @param string $error
     * @return reCaptcha
     */
    public function setError($error)
    {
        $this->error = (string) $error;
        return $this;
    }

    /**
     * Retrieve currently set error
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Generates reCaptcha form to output to your end user
     *
     * @param $id
     * @throws Exception
     * @return string
     */
    public function html( $id )
    {
        if (!$this->getPublicKey()) {
            throw new PAFL_Exception('You must set public key provided by reCaptcha');
        }

        return
            '<div id="' . $id . '" class="g-recaptcha" data-sitekey="' . $this->getPublicKey() . '" data-theme="' . $this->theme . '"></div>';
    }


    /**
     * Load the Render Scripts for Captcha.
     *
     */
    public function load_scripts()
    {
        $output = "<script id=\"recaptcha-inline-script\" type=\"text/javascript\">";
        $output .= "/** ReCaptcha */\n";

        // get all the declared ID and assign to a variable
        $var_index = 0;
        foreach( $this->getID() as $var_item_id ):
            //added Captcha word on id
            $output .= "var " . $var_item_id . "Response = 'g-recaptcha-response" . ( $var_index < 1 ? "" : "-" . $var_index )."';";
            $output .= "var " . $var_item_id ."Captcha;";
            $var_index++;
        endforeach;

        $output .=  "var onloadCallback = function() {";
        if ( is_array( $this->getID() ) && $this->getID() ):
            $i = 0;
            foreach ( $this->getID() as $item_id ):
	        $output .= $item_id . "Captcha = grecaptcha.render('" . $item_id . "Captcha', {";
	        $output .= "'sitekey': document.getElementById('" . $item_id . "Captcha').getAttribute('data-sitekey'),";
	        $output .= "'theme': document.getElementById('" . $item_id . "Captcha').getAttribute('data-theme'),";
	        $output .= "'callback': function (response) {";
	        $output .= "document.getElementById('pafl-" . $item_id  . "').setAttribute( 'data-response', response );";
	        $output .= "}";
	        $output .= "});";
	        $i++;
            endforeach;
        endif;
            $output .= "};";
        $output .= "</script>";

        echo $output;
    }

    /**
     * Checks and validates user's response
     *
     * @param bool|string $captchaResponse Optional response string. If empty, value from $_POST will be used
     * @throws Exception
     * @return Response
     */
    public function check($captchaResponse = false)
    {
        if (!$this->getPrivateKey()) {
            throw new PAFL_Exception('You must set private key provided by reCaptcha');
        }

        // Skip processing of empty data
        if (!$captchaResponse) {
            if (isset($_POST['g-recaptcha-response'])) {
                $captchaResponse = $_POST['g-recaptcha-response'];
            }
        }

        // Create a new response object
        $response = new PAFL_Response();

        // Discard SPAM submissions
        if (strlen($captchaResponse) == 0) {
            $response->setValid(false);
            $response->setError('Incorrect-captcha-sol');
            return $response;
        }

        $process = $this->process(
            array(
                'secret' => $this->getPrivateKey(),
                'remoteip' => $this->getRemoteIp(),
                'response' => $captchaResponse
            )
        );

        $answer = @json_decode($process, true);

        if (is_array($answer) && isset($answer['success']) && $answer['success']) {
            $response->setValid(true);
        } else {
            $response->setValid(false);
            $response->setError(serialize($answer));
        }

        return $response;
    }

    /**
     * Make a signed validation request to reCaptcha's servers
     *
     * @throws Exception
     * @param array $parameters
     * @return string
     */
    protected function process($parameters)
    {
        // Properly encode parameters
        $parameters = http_build_query($parameters);

        // Make validation request
        $response = @file_get_contents('https://' . self::VERIFY_SERVER . '/recaptcha/api/siteverify?' . $parameters);
        if (!$response) {
            throw new PAFL_Exception('Unable to communicate with reCaptcha servers. Response: ' . serialize($response));
        }

        return $response;
    }

    /**
     * Returns a boolean indicating if a theme name is valid
     *
     * @param string $theme
     * @return bool
     */
    protected static function isValidTheme($theme)
    {
        return (bool)in_array($theme, self::$themes);
    }

    /**
     * Returns a boolean indicating if a widget size is valid
     *
     * @param string $size
     * @return bool
     */
    protected static function isValidSize($size)
    {
        return (bool)in_array($size, self::$sizes);
    }

    /**
     * Returns a boolean indicating if a widget type is valid
     *
     * @param string $type
     * @return bool
     */
    protected static function isValidType($type)
    {
        return (bool)in_array($type, self::$types);
    }

    /**
     * Set widget theme
     *
     * @param string $theme
     * @return Captcha
     * @throws Exception
     * @see https://developers.google.com/recaptcha/docs/customization
     */
    public function setTheme($theme)
    {
        // Check if the $theme that was pass is in the set and if not will set to default 'light'
        if ( in_array( $theme, self::$themes ) ){
            $this->theme = implode( '', (array) $theme );
        } else {
            $this->theme = 'light';
        }

        return $this;
    }

    /**
     * Set widget size
     *
     * @param string $size
     * @return Captcha
     * @throws Exception
     * @see https://developers.google.com/recaptcha/docs/customization
     */
    public function setSize($size)
    {
        if (!self::isValidSize($size)) {
            throw new PAFL_Exception(
                'Size ' . $size . ' is not valid. Please use one of [' . join(', ', self::$size) . ']'
            );
        }

        $this->size = (string)$size;

        return $this;
    }

    /**
     * Set widget type
     *
     * @param string $type
     * @return Captcha
     * @throws Exception
     * @see https://developers.google.com/recaptcha/docs/customization
     */
    public function setType($type)
    {
        if (!self::isValidSize($type)) {
            throw new PAFL_Exception(
                'Type ' . $type . ' is not valid. Please use one of [' . join(', ', self::$type) . ']'
            );
        }

        $this->type = (string)$type;

        return $this;
    }

    /**
     * Set widgets tab index
     *
     * @param int $tabIndex
     * @return Captcha
     * @throws Exception
     * @see https://developers.google.com/recaptcha/docs/customization
     */
    public function setTabIndex($tabIndex)
    {
        if (!is_numeric($tabIndex)) {
            throw new PAFL_Exception(
                'Tab index of ' . $tabIndex . ' is not valid.'
            );
        }

        $this->tabIndex = (int)$tabIndex;

        return $this;
    }

    /**
     * Get the ID that was set.
     * @return \string[]
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Set the ID of the Captcha
     * @param array $id
     */
    public function setID( $id )
    {
        if ( is_array( $id ) && ! empty( $id ) ){
            // filter all the ids that were passed if a corresponding captcha is enabled for that field.
            // will only filter 'login', 'register' and 'forgot'
            foreach ( $id as $id_checked ) {
                if ( pafl_is_captcha_field( $id_checked ) === false ) {
                    unset( $id_checked );
                } else {
                    //will add word captcha as identifier
                    $id_checked = $id_checked;

                    //merge to the existing id property
                    $this->id[] = $id_checked;
                }
            }


        }
    }
}

