<?php

/**
 * Author : Syed Asfaquz Zaman
 */
class AuthController extends Controller
{

    public function init()
    {
        parent::init();
    }

    /**
     * Social Media Authentication
     */
    public function actionSocialAuthentication()
    {

        $socialNetwork = Yii::app()->getRequest()->getParam('socialNetwork', '');

        if (isset($socialNetwork)) {
            switch ($socialNetwork) {
                case "facebook":
                    if (!isset(Yii::app()->session['eauth_profile'])) {
                        $oParams              = new stdClass();
                        $oParams->serviceName = "facebook";
                        $aResponseJson        = Utility::socialMediaUserAuthentication($oParams);
                        $aResonse             = json_decode($aResponseJson, true);
                        if ($aResonse['error'] == 1 && $aResonse['status'] == false) {
                            $msg = $aResonse['message'];
                            throw new Exception($msg);
                        }
                    }

                case "google":
                    if (!isset(Yii::app()->session['eauth_profile'])) {
                        $oParams              = new stdClass();
                        $oParams->serviceName = "google";
                        $aResponseJson        = Utility::socialMediaUserAuthentication($oParams);
                        $aResonse             = json_decode($aResponseJson, true);
                        if ($aResonse['error'] == 1 && $aResonse['status'] == false) {
                            $msg = $aResonse['message'];
                            throw new Exception($msg);
                        }
                    }

                default:
                    $this->redirect($this->createAbsoluteUrl('/pages/register'));
            }
        }
    }
}