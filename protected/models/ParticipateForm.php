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
            array('media_url', 'file', 'types' => 'mp4','allowEmpty' => true),
            array('media_category','safe'),
            array('username,email,mobile,media_title,message', 'required', 'message' => 'Please enter your {attribute}.'),

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
        return array('Humour' => 'Humour', 'Action' => 'Action', 'Songs' => 'Songs',
            'Drama' => 'Drama','Just Like That' => 'Just Like That');
    }
}