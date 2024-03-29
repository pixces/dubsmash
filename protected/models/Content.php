<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $mobile
 * @property string $media_url
 * @property string $media_alternate_url
 * @property string $media_id
 * @property string $media_image
 * @property string $alternate_image
 * @property string $channel_name
 * @property string $media_category
 * @property string $media_title
 * @property string $message
 * @property string $auth_source
 * @property string $auth_user_id
 * @property string $auth_user_name
 * @property string $auth_profile_url
 * @property string $location
 * @property integer $is_ugc
 * @property string $share_url
 * @property integer $vote
 * @property string $status
 * @property string $workflow_status
 * @property string $date_created
 * @property string $date_modified
 */
class Content extends CActiveRecord
{
    public static $defaultSelectableFields = ['id', 'username', 'media_title', 'message', 'media_image', 'alternate_image', 'media_id', 'media_url', 'media_alternate_url', 'media_category',
        'vote'];

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'content';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username,email,mobile,share_url,media_category,message', 'required'),
            array('is_ugc, vote', 'numerical', 'integerOnly' => true),
            array('username, channel_name', 'length', 'max' => 150),
            array('email, media_url, media_image, alternate_image, media_title, auth_profile_url',
                'length', 'max' => 255),
            array('mobile', 'length', 'max' => 25),
            array('media_alternate_url, share_url', 'length', 'max' => 250),
            array('media_id', 'length', 'max' => 15),
            array('media_category', 'length', 'max' => 6),
            array('auth_source', 'length', 'max' => 8),
            array('auth_user_id', 'length', 'max' => 20),
            array('auth_user_name, location', 'length', 'max' => 100),
            array('status', 'length', 'max' => 12),
            array('workflow_status', 'length', 'max' => 10),
            array('date_modified', 'default', 'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update'),
            array('date_created,date_modified', 'default', 'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert'),
            array('message,', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, email, mobile, media_url, media_alternate_url, media_id, media_image, alternate_image, channel_name, media_category, media_title, message, auth_source, auth_user_id, auth_user_name, auth_profile_url, location, is_ugc, share_url, vote, status, workflow_status, date_created, date_modified',
                'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'media_url' => 'Media Url',
            'media_alternate_url' => 'Media Alternate Url',
            'media_id' => 'Media',
            'media_image' => 'Media Image',
            'alternate_image' => 'Alternate Image',
            'channel_name' => 'Channel Name',
            'media_category' => 'Media Category',
            'media_title' => 'Media Title',
            'message' => 'Message',
            'auth_source' => 'Auth Source',
            'auth_user_id' => 'Auth User',
            'auth_user_name' => 'Auth User Name',
            'auth_profile_url' => 'Auth Profile Url',
            'location' => 'Location',
            'is_ugc' => 'Is Ugc',
            'share_url' => 'Share Url',
            'vote' => 'Vote',
            'status' => 'Status',
            'workflow_status' => 'Workflow Status',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('media_url', $this->media_url, true);
        $criteria->compare('media_alternate_url', $this->media_alternate_url,
            true);
        $criteria->compare('media_id', $this->media_id, true);
        $criteria->compare('media_image', $this->media_image, true);
        $criteria->compare('alternate_image', $this->alternate_image, true);
        $criteria->compare('channel_name', $this->channel_name, true);
        $criteria->compare('media_category', $this->media_category, true);
        $criteria->compare('media_title', $this->media_title, true);
        $criteria->compare('message', $this->message, true);
        $criteria->compare('auth_source', $this->auth_source, true);
        $criteria->compare('auth_user_id', $this->auth_user_id, true);
        $criteria->compare('auth_user_name', $this->auth_user_name, true);
        $criteria->compare('auth_profile_url', $this->auth_profile_url, true);
        $criteria->compare('location', $this->location, true);
        $criteria->compare('is_ugc', $this->is_ugc);
        $criteria->compare('share_url', $this->share_url, true);
        $criteria->compare('vote', $this->vote);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('workflow_status', $this->workflow_status, true);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('date_modified', $this->date_modified, true);

        return new CActiveDataProvider($this,
            array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Content the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        if ($this->isNewRecord)
                $this->date_created = new CDbExpression('NOW()');

        $this->date_modified = new CDbExpression('NOW()');

        return parent::beforeSave();
    }
}