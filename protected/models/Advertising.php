<?php

/**
 * This is the model class for table "advertising".
 *
 * The followings are the available columns in table 'advertising':
 * @property integer $id
 * @property string $banner_name
 * @property string $banner_code
 * @property integer $height
 * @property integer $width
 * @property string $image
 */
class Advertising extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'advertising';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image', 'required'),
			array('height, width', 'numerical', 'integerOnly'=>true),
			array('banner_name, image, type, video_link', 'length', 'max'=>255),
			array('banner_code', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, banner_name, banner_code, type, height, width, image, video_link', 'safe', 'on'=>'search'),
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
			'banner_name' => 'Название',
			'banner_code' => 'Код',
			'type' => 'Тип',
			'height' => 'Высота',
			'width' => 'Ширина',
			'image' => 'Ссылка на изображение',
			'video_link' => 'Рекламное видео',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('banner_name',$this->banner_name,true);
		$criteria->compare('banner_code',$this->banner_code,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('height',$this->height);
		$criteria->compare('width',$this->width);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('video_link',$this->video_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Advertising the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
