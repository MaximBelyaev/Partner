<?php 


class Landings extends CActiveRecord
{

	public $isOffer;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'landings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
            array('use_click_pay, use_fixed_pay', 'length', 'max'=>1),
			array('link, name', 'length', 'max'=>255),
            array('fixed_pay, click_pay', 'length', 'max'=>11),
			array('vip, standard, extended', 'length', 'max'=>250),
			array('sort_order', 'length', 'max'=>15),
			array('isOffer', 'numerical', 'integerOnly' => true),
			array('link', 'required'),
			array('link', 'url'),
			array('icon', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
            array('link, name, vip, standard, extended, sort_order', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'referrals' => array(self::HAS_MANY, 'Referrals', 'land_id'),
			'requests' => array(self::HAS_MANY, 'Requests', 'land_id'),
			'users' => array(self::HAS_MANY, 'User', 'land_id'),
			'news' => array(self::HAS_MANY, 'News', 'land_id'),
			'promobanns' => array(self::HAS_MANY, 'Promobanns', 'land_id'),
			'users_landings' => array(self::HAS_MANY, 'UsersLandings', 'land_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'link' => 'Ссылка',
			'icon' => 'Изображение',
			'name' => 'Название',
			'land_id' => 'ID',
            'vip' => 'VIP',
            'extended' => 'Расширенный',
            'standard' => 'Стандартный',
            'sort_order' => 'Порядок сортировки',
            'click_pay' => 'Оплата за переход',
            'fixed_pay' => 'Фиксированная оплата',
		);
	}


	public function search($pageSize = 10)
	{
		$criteria = new CDbCriteria;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize' => $pageSize),
			'sort' => array(
				'defaultOrder' => 't.sort_order ASC',
			)
		));
	}
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function getIcon()
	{
		if ($this->icon) {
			return "<img 
				src='" . Yii::app()->params['uploadPath'] . $this->icon . "' 
				class='land_icon'
				title='" . $this->name . "'
			>";
		}
		return '';
	}
}

