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
}