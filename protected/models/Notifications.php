<?php

/**
 * This is the model class for table "notifications".
 *
 * The followings are the available columns in table 'notifications':
 * @property integer $notification_id
 * @property integer $user_id
 * @property integer $theme
 * @property string $text
 * @property string $date
 * @property integer $is_new
 * @property integer $stated_id
 */
class Notifications extends CActiveRecord
{

	public static $THEME_NEW_STATED   = 1;
	public static $THEME_SITE_CHANGED = 2;

	public static $themes_aliases = array(
		1 => 'Заявка на вывод',
		2 => 'Изменение сайта',
	);

	public $username;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, theme, is_new', 'required'),
			array('user_id, stated_id, theme, is_new', 'numerical', 'integerOnly'=>true),
			array('text', 'length', 'max'=>4095),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stated_id, notification_id, user_id, theme, text, date, is_new', 'safe', 'on'=>'search'),
			array('username, user.username', 'safe')
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'user'	=> array(self::BELONGS_TO, 'User', 'user_id'),
            'stated'=> array(self::HAS_ONE, 'Stateds', 'stated_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'notification_id' => 'Уведомление',
			'user_id' => 'Пользователь',
			'username' => 'Партнер',	
			'theme' => 'Тема',
			'text' => 'Текст',
			'date' => 'Дата',
			'is_new' => 'Статус',
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
	public function search($pageSize = 9)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->with = array('user');

		$criteria->addSearchCondition('user.username', $this->username);
		
		$criteria->compare('notification_id',$this->notification_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('theme', $this->searchThemesKeysByString());
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('is_new',$this->is_new);
		
		return new CActiveDataProvider($this, array(
			'pagination'=> array('pageSize' => $pageSize),
			'sort' 		=> array(
				'defaultOrder' => 'date DESC',
				'attributes' => array(
					'username' => array(
						'asc' => 'user.username',
						'desc' => 'user.username DESC',
					),
					'*'
				)
			),
			'criteria'	=> $criteria,
		));
	}

	protected function searchThemesKeysByString($str='') {

		if ($this->theme != '' && !is_null($this->theme)) {
			$keys = array();
			foreach(Notifications::$themes_aliases as $i => $t) {
				if(mb_stripos($t, $this->theme, null, 'UTF-8') !== false) {
					array_push($keys, $i);
				}
			}
			return $keys;
		} else {
			return array();
		}

	}

	public function getUsername() {
		if ($this->username === null) {
	        $this->username = $this->user->username;
	    }
	    return $this->username;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Notifications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterSave()
	{
	}
}
