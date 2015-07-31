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
			array('link, name', 'length', 'max'=>255),
			array('vip, standard, extended, click_pay', 'length', 'max'=>250),
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
            'click_pay' => 'Оплата за переход'
		);
	}

	public function joinUser( $user_id = 0 )
	{
		$cdb = $this->getDbCriteria();
		
		$cdb->mergeWith(array(
	        'join' => ' LEFT JOIN users_landings USING(land_id) ',
			'select' => $cdb->select . ',(users_landings.user_id IS NOT NULL) as isOffer '
		));
		if ((int)$user_id) {
			$this->getDbCriteria()->addCondition( 
				' (users_landings.user_id = ' . (int)$user_id 
				. ' OR users_landings.user_id IS NULL) ' 
			);
		}
	    return $this;
	}


    public function search($pageSize = 10)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize' => $pageSize),
            'sort' => array(
                'defaultOrder' => 't.sort_order ASC',
            )));
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

