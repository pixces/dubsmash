<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 29/07/15
 * Time: 1:46 AM
 */

class Mailer {

    private static $mailer = null;

    public static function Approved($aParams){

        if ($aParams && is_array($aParams)){

            if (!$aParams['to']){
                Yii::log("Mail Error: Recepient email address not provided.");
                return false;
            }

            if (!$aParams['data']){
                $data = array();
            } else {
                $data = $aParams['data'];
            }

            $subject = (isset($aParams['subject'])) ? Yii::app()->params['mailConfig']['SubjectPrefix'].trim($aParams['subject']) : Yii::app()->params['mailConfig']['SubjectPrefix']." Your submission is approved.";
            $template = 'thankyou';
            $to = $aParams['to'];

            return self::SendMail($to,$data,$subject,$template);

        } else {
            Yii::log("Mail Error: All mandatory params missing. Cannot send email.");
            return false;
        }
    }

    public static function Rejected($aParams){

        if ($aParams && is_array($aParams)){

            if (!$aParams['to']){
                Yii::log("Mail Error: Recepient email address not provided.");
                return false;
            }

            if (!$aParams['data']){
                $data = array();
            } else {
                $data = $aParams['data'];
            }

            $subject = (isset($aParams['subject'])) ? Yii::app()->params['mailConfig']['SubjectPrefix'].trim($aParams['subject']) : Yii::app()->params['mailConfig']['SubjectPrefix']." Your submission is rejected.";
            $template = 'thankyou';
            $to = $aParams['to'];

            return self::SendMail($to,$data,$subject,$template);

        } else {
            Yii::log("Mail Error: All mandatory params missing. Cannot send email.");
            return false;
        }
    }

    public static function Acknowledgement($aParams){

        if ($aParams && is_array($aParams)){

            if (!$aParams['to']){
                Yii::log("Mail Error: Recepient email address not provided.");
                return false;
            }

            if (!isset($aParams['data'])){
                $data = array();
            } else {
                $data = $aParams['data'];
            }

            $subject = (isset($aParams['subject'])) ? Yii::app()->params['mailConfig']['SubjectPrefix'].trim($aParams['subject']) : Yii::app()->params['mailConfig']['SubjectPrefix']." Thank you for your submission.";
            $template = 'thankyou';
            $to = $aParams['to'];

            return self::SendMail($to,$data,$subject,$template);

        } else {
            Yii::log("Mail Error: All mandatory params missing. Cannot send email.");
            return false;
        }
    }

    public static function GetMailer(){
        if (!isset(self::$mailer)){

            $mailConfig = Yii::app()->params['mailConfig'];

            $mail = new YiiMailer();
            $from = $mailConfig['senderEmail'];
            $from_name = $mailConfig['senderName'];

            $mail->setFrom($from,$from_name);

            $mail->IsSMTP();
            $mail->IsHTML();
            $mail->SMTPAuth = $mailConfig['SMTPAuth'];
            $mail->Host = $mailConfig['SMTPHost'];
            $mail->Port = $mailConfig['SMTPPort'];
            $mail->Username = $mailConfig['SMTPUser'];
            $mail->Password = $mailConfig['SMTPPass'];
            $mail->SMTPSecure = 'tls';
            $mail->SMTPDebug = 2;

            //assign this to the mailer instance
            self::$mailer = $mail;
        }

        //return mailer instance
        return self::$mailer;
    }

    public static function SendMail($to,$data,$subject,$view='thankyou'){

        $mail = self::GetMailer();
        $mail->setTo($to);
        $mail->setSubject($subject);
        $mail->setData($data);
        $mail->setView($view);

        //now send email log exceptions
        if ($mail->send()) {
            return true;
        } else {
            print_r($mail->getError());
            Yii::log("Mail Error: ".$mail->getError());
            debug_print_backtrace();
            return false;
        }
    }

} 