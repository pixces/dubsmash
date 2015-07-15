<?php

class LoginForm extends CFormModel
{

    const ERROR_USERNAME_INVALID = "Username is Invalid";
    const ERROR_PASSWORD_INVALID = "Password is Invalid";
    const ERROR_VERIFIED_INVALID = "Email id not verified, please verify your email id";

    public $username;
    public $password;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('username, password', 'required'),
            // username has to be a valid email address
            array('username', 'email'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe' => 'Remember me next time',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate()) {

                if ($this->_identity->errorCode === UserIdentity::ERROR_ROLE_INVALID) {
                    $this->addError('password', self::ERROR_ROLE_INVALID);
                } else if ($this->_identity->errorCode === UserIdentity::ERROR_USERNAME_INVALID) {
                    $this->addError('password', self::ERROR_USERNAME_INVALID);
                } else if ($this->_identity->errorCode === UserIdentity::ERROR_PASSWORD_INVALID) {
                    $this->addError('password', self::ERROR_PASSWORD_INVALID);
                } else if ($this->_identity->errorCode === UserIdentity::ERROR_VERIFIED_INVALID) {
                    $this->addError('password', self::ERROR_VERIFIED_INVALID);
                }
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }

        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            //$duration = $this->rememberMe ? 3600 * 24 * 60 : 0; // 60 days
            $duration = 0; // 60 days
            Yii::app()->user->login($this->_identity, $duration);
            Admin::model()->updateByPk($this->_identity->getId(), array('last_login_time' => new CDbExpression('NOW()')));
            return true;
        } else
            return false;
    }
}