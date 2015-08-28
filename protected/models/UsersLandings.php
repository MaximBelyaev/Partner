<?php

/**
 * This is the model class for table "users_landings".
 *
 * The followings are the available columns in table 'users_landings':
 * @property integer $users_landings_id
 * @property integer $user_id
 * @property integer $land_id
 */
class UsersLandings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

    public $variable;

	public function tableName()
	{
		return 'users_landings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, land_id', 'required'),
			array('user_id, land_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('users_landings_id, user_id, land_id', 'safe', 'on'=>'search'),
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
            'landings'=> array(self::BELONGS_TO, 'Landings', 'land_id'),
            'user'=> array(self::HAS_ONE, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'users_landings_id' => 'Users Landings',
			'user_id' => 'User',
			'land_id' => 'Land',
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

		$criteria->compare('users_landings_id',$this->users_landings_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('land_id',$this->land_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersLandings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
