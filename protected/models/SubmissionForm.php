<?php

/**
 * SubmissionForm class.
 * SubmissionForm is the data structure for keeping
 * submission form data. It is used by the 'index' action of 'SiteController'.
 */
class SubmissionForm extends CFormModel
{
    public $username;
    public $email;
    public $url;
    public $phone;
    public $accept;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, url are required
            array('username, email, phone', 'required', 'message' => 'Please enter your {attribute}.'),
            array('url', 'required', 'message' => 'Please enter your Video Url.'),
            // email has to be a valid email address
            array('email', 'email'),
            array('accept', 'required', 'requiredValue' => 1, 'message' => 'You should accept terms to use our service'),
            array('url', 'validateUrl'),
            array('phone', 'numerical', 'integerOnly' => true,),
            array('phone', 'length', 'min'=>7, 'max'=>10),
        );
    }

    public function validateUrl()
    {

        if (filter_var($this->url, FILTER_VALIDATE_URL) === FALSE) {
            $this->addError('url', 'Please check invalid url.');
        }
    }
}