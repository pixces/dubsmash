<?php

/**
 * Description of Utility
 *
 * @author syed asfaquz Zaman
 */
class Utility
{

    /**
     * Social Media Authentication
     * @param Object $oParams
     * @return type
     */
    public static function socialMediaUserAuthentication($oParams)
    {
        $aResponse   = ['status' => false, 'message' => '', 'error' => 0];
        $serviceName = $oParams->serviceName;

        if (isset($serviceName)) {
            /** @var $eauth EAuthServiceBase */
            $eauth = Yii::app()->eauth->getIdentity($serviceName);
            try {
                if ($eauth->authenticate()) {
                    $identity = new EAuthUserIdentity($eauth);
                    // successful authentication
                    if ($identity->authenticate()) {
                        Yii::app()->user->login($identity);
                        $session                  = Yii::app()->session;
                        $session['eauth_profile'] = $eauth->attributes;
                        $aResponse                = ['status' => true, 'message' => 'User Authenticated Successfully.',
                            'error' => 0];
                    } else {

                        $aResponse = ['status' => false, 'message' => "User can't be authenticated.",
                            'error' => 1];
                    }
                } else {
                    $aResponse = ['status' => false, 'message' => 'Something went wrong.',
                        'error' => 1];
                }
            } catch (EAuthException $e) {
                $aResponse = ['status' => false, 'message' => $e->getMessage(), 'error' => 1];
            }

            return json_encode($aResponse);
        }
    }

    public static function mc_encrypt($encrypt, $key)
    {
        $encrypt   = serialize($encrypt);
        $iv        = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256,
                MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key       = pack('H*', $key);
        $mac       = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac,
            MCRYPT_MODE_CBC, $iv);
        $encoded   = base64_encode($passcrypt).'|'.base64_encode($iv);
        return $encoded;
    }

// Decrypt Function
    public static function mc_decrypt($decrypt, $key)
    {
        $decrypt = explode('|', $decrypt.'|');
        $decoded = base64_decode($decrypt[0]);
        $iv      = base64_decode($decrypt[1]);
        if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256,
                MCRYPT_MODE_CBC)) {
            return false;
        }
        $key       = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded,
                MCRYPT_MODE_CBC, $iv));
        $mac       = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac   = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if ($calcmac !== $mac) {
            return false;
        }
        $decrypted = unserialize($decrypted);
        return $decrypted;
    }
}