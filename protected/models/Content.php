<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $title
 * @property string $description
 * @property string $media_id
 * @property string $media_url
 * @property string $type
 * @property string $author
 * @property string $channel_name
 * @property integer $is_ugc
 * @property string $thumb_image
 * @property string $alternate_image
 * @property string $status
 * @property string $date_created
 * @property string $date_modified
 */
class Content extends CActiveRecord
{
    public static $defaultSelectableFields = ['id', 'username', 'title', 'thumb_image',
        'media_id', 'media_url', 'is_ugc'];

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
            array('username, email,google_id,google_profile_url,google_profilepicture',
                'required'),
            array('is_ugc', 'numerical', 'integerOnly' => true),
            array('username, author, channel_name', 'length', 'max' => 150),
            array('email, title, media_url, thumb_image, alternate_image', 'length',
                'max' => 255),
            array('media_id', 'length', 'max' => 15),
            array('type', 'length', 'max' => 5),
            array('status', 'length', 'max' => 12),
            array('date_modified', 'default', 'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update'),
            array('date_created,date_modified', 'default', 'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, email, title, description,channel_id, media_id, media_url, type, author, channel_name, is_ugc, thumb_image, alternate_image, status, date_created, date_modified,google_id,google_displayname,google_profilepicture,google_profile_url',
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
            'title' => 'Title',
            'description' => 'Description',
            'media_id' => 'Media',
            'media_url' => 'Media Url',
            'type' => 'Type',
            'author' => 'Author',
            'channel_name' => 'Channel Name',
            'is_ugc' => 'Is Ugc',
            'thumb_image' => 'Thumb Image',
            'alternate_image' => 'Alternate Image',
            'status' => 'Status',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('media_id', $this->media_id, true);
        $criteria->compare('media_url', $this->media_url, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('channel_name', $this->channel_name, true);
        $criteria->compare('is_ugc', $this->is_ugc);
        $criteria->compare('thumb_image', $this->thumb_image, true);
        $criteria->compare('alternate_image', $this->alternate_image, true);
        $criteria->compare('status', $this->status, true);
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