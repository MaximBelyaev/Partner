<?php 


class Landings extends CActiveRecord
{
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
			array('link, name', 'length', 'max' => 255),
			array('link', 'required'),
			array('link', 'url'),
			array('icon', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
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
			'users' => array(self::HAS_MANY, 'Users', 'land_id'),
		);
	}

	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}

