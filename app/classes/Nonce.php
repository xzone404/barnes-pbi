<?php
/**
 * This class does the operations related to Nonce
 * 
 * It takes care of creating a nonce & verifying a nonce
 * 
 * Example
 *
 * STEP 1 - CREATION OF NONCE: 
 * <code>
 *      $nonceObject = new Nonce();
 *      $nonce = $nonceObject->createNonce('my-action');
 * </code>
 *
 * In your form, you can add a hidden field and place this 
 * $nonce variable. It may look something like this
 * <code>
 *      <input type="hidden" name="nonce" "value="<?php echo $nonce; ?>" />
 * </code>
 * 
 * STEP 2 - VALIDATION OF NONCE:
 * When the form is submitted, you will get the nonce in global.
 * For above given example this is how nonce can be validated.
 * 
 * <code>
 *      $isNonceVerified = (new Nonce())->verifyNonce($_REQUEST['nonce], 'my-action');
 * </code>
 * 
 * $isNonceVerified will return either 1, 2 or false; 1 & 2 are 
 * acceptable values. If it returns false, that means nonce is
 * not verified.
 * 
 */
class Nonce {

    private const NONCE_LIFE = 3600; // 1 Hour lifecycle
    private const SALT = 'SOME STRONG STRING'; // change it to whatever you want but keep it strong
    private const IS_WEBSITE_SSL = false; // Is website https?
    /**
     * Creates a cryptographic token to be used in the request.
     *
     * @param string $action Action against which nonce to be verified. Cookie with name 'browser' + $action is created in browser.
     * @param string $browserIdentifier Cookie value used to identify browser.
     * @param integer $offset
     * @return string
     */
    public function createNonce($action='', $browserIdentifier = '', $offset = 0) : string {

        if(empty($browserIdentifier)){
            $browserIdentifier = $this->createBrowserIdentifier($action);
        }

	return substr(hash_hmac('md5', ( $this->tick() - $offset) . $browserIdentifier . '-nonce', self::SALT ), -12, 10);
    }
    
    /**
     * Verify that correct nonce was used with time limit.
     *
     * @param string $nonce Nonce to verify
     * @param string $action Action against which nonce to be verified.
     * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
     *                   0-30 mins ago, 2 if the nonce is valid and generated between 30-60 mins ago.
     */
    public function verifyNonce($nonce, $action = '') {

        $cookieName = $this->getCookieName($action);

        // Since our nonce is cookie based, cookie must be present.
        if(!isset($_COOKIE[$cookieName])){
            return false;   
        }

        $browserIdentifier = $_COOKIE[$cookieName];

	// Nonce generated 30 mins ago
	if ( $this->createNonce($action, $browserIdentifier) == $nonce )
          return 1;
    
	// Nonce generated 60 mins ago
	if ( $this->createNonce($action, $browserIdentifier ,1) == $nonce )
          return 2;
            
	// Invalid nonce
	return false;
    }
    
    /**
     * Returns the cookie name to be used to create cookie
     *
     * @param string $action
     * @return string
     */
    public function getCookieName($action = '') : string{
        return 'uuid-' . $action;
    }

    /**
     * Get the time-dependent variable for nonce creation.
     *
     * A nonce has a lifespan of two ticks.
     *
     * @return float Float value rounded up to the next highest integer.
     */
    private function tick() : float {
	return ceil(time() / ( self::NONCE_LIFE / 2 ));
    }


    /**
     * Sets httpOnly cookie on the browser to identify it
     *
     * @return string Returns cookie value
     */
    private function createBrowserIdentifier($action = '') : string{
        $browserIdentifier = substr(str_shuffle(MD5(microtime())), 0, 32); // 32 characters browser identifier

        setcookie($this->getCookieName($action) , $browserIdentifier, time() + self::NONCE_LIFE, "/", "", self::IS_WEBSITE_SSL, true); // Set cookie for 12 hours

        return $browserIdentifier;
    }

}