<?php

/**
 * SubmissionForm class.
 * SubmissionForm is the data structure for keeping
 * submission form data. It is used by the 'index' action of 'SiteController'.
 */
class ParticipateForm extends CFormModel
{
    public $username;
    public $email;
    public $mobile;
    public $media_url;
    public $media_title;
    public $message;
    public $media_category;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
             array('media_url', 'file', 'types'=>'jpg, gif, png', 'safe' => false),
            // name, email, url are required
            array('username,email,mobile,media_title,message,', 'required', 'message' => 'Please enter your {attribute}.'),
//            array('url', 'required', 'message' => 'Please enter your Video Url.'),
//            // email has to be a valid email address
//            array('email', 'email'),
//            array('accept', 'required', 'requiredValue' => 1, 'message' => 'You should accept terms to use our service'),
//            array('url', 'validateUrl'),
//            array('phone', 'numerical', 'integerOnly' => true,),
//            array('phone', 'length', 'min'=>7, 'max'=>10),
        );
    }

    public function validateUrl()
    {

        if (filter_var($this->url, FILTER_VALIDATE_URL) === FALSE) {
            $this->addError('url', 'Please check invalid url.');
        }
    }

    public function getAllCategories()
    {
        return array('Humour' => 'Humour', 'Action' => 'Action', 'Songs' => 'Songs', 'Drama' => 'Drama');
    }
}