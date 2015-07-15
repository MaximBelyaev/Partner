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
			array('vip', 'standard', 'extended', 'max' => 255),
			array('user_panel', 'max' => 10),
			array('link', 'required'),
			array('link', 'url'),
			array('icon', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
            array('user_panel'=>'search'),
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

	public function attributeLabels()
	{
		return array(
			'link' => 'Ссылка',
			'icon' => 'Изображение',
			'name' => 'Название',
			'land_id' => 'ID',
            'vip' => 'VIP',
            'extended' => 'Расширенный',
            'standard' => 'Стандартный'
		);
	}

    public function search($pageSize = 10)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;


        $criteria->compare('user_panel',$this->user_panel);
        $criteria->order = 'date DESC';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize' => $pageSize),
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

