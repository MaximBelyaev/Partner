<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property integer $id
 * @property string $site_name
 * @property string $email
 * @property integer $top_news_count
 * @property integer $short_description_symbols
 */
class Settings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('top_news_count, short_description_symbols', 'numerical', 'integerOnly'=>true),
			array('site_name, email', 'length', 'max'=>150),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'site_name' => Yii::t('main', 'Название сайта'),
			'email' => 'Email',
			'top_news_count' => Yii::t('main', 'Количество топ новостей'),
			'short_description_symbols' => Yii::t('main', 'Количество символов короткого описания новостей'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Settings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
