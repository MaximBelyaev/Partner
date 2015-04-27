<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $news_id
 * @property string $header
 * @property string $text
 * @property string $date
 */
class News extends CActiveRecord
{

	public static $VIEWED = "Просмотрено";
	public static $IS_NEW = "Новое";


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('header, text', 'required'),
			array('header', 'length', 'max'=>255),
			array('text', 'length', 'max'=>4095),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('news_id, header, text, date', 'safe', 'on'=>'search'),
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
			'newsViews'=> array(self::HAS_MANY, 'NewsViews', 'news_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'news_id' => 'Новость',
			'header' => 'Заголовок',
			'text' => 'Текст',
			'date' => 'Дата',
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

		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('header',$this->header,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date',$this->date,true);
		$criteria->order = 'date DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function userSearch()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->join = 'LEFT JOIN news_views AS nw ON nw.news_id = t.news_id AND nw.user_id = ' . Yii::app()->user->id;
		$criteria->select = array('`t`.`news_id`, `t`.`header`, `t`.`text`, `t`.`date`, `nw`.`news_views_id`, `nw`.`user_id`');
		$criteria->together = true; //
		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('header',$this->header,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date',$this->date,true);

		$criteria->order = 'nw.user_id IS NULL DESC, nw.news_views_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function getIsViewed() {
		if(count(NewsViews::model()->find("news_id = {$this->news_id} AND user_id = " . Yii::app()->user->id))) {
			return self::$VIEWED;
		} else {
			return self::$IS_NEW;
		}
	}

	protected function afterSave() 
	{
		$users = User::model()->findAll();
		foreach ($users as $user) {
			$email = Yii::app()->email;
			$email->from = 'Александр Павлуцкий <'.Yii::app()->params['adminEmail'].'>';
			$email->to = $user->username;
			$email->language = 'ru';
			$email->type = 'text/html';
			$email->contentType = 'utf-8';
			$email->subject = "Партнерка по семантике: {$this->header}";
			$email->message = str_replace('src="', 'src="' . Yii::app()->getBaseUrl(true), $this->text);
			$email->send();
		}
	}

	public function afterDelete()
	{
		parent::afterDelete();
		$news_views = $this->newsViews;
		foreach ($news_views as $nw) {
			$nw->delete();
		}
	}

}
