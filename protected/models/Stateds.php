<?php

/**
 * This is the model class for table "stateds".
 *
 * The followings are the available columns in table 'stateds':
 * @property integer $id
 * @property integer $user_id
 * @property string $money
 * @property integer $status
 * @property string $pay_type
 * @property string $requisites
 * @property string $description
 */
class Stateds extends CActiveRecord
{
    protected $_oldStatus;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stateds';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, money, pay_type, requisites', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('money', 'length', 'max'=>8),
			array('money', 'numerical', 'max'=>Yii::app()->user->isAdmin ? 9999999999 :User::model()->findByPk(Yii::app()->user->id)->profit),
			array('pay_type, requisites', 'length', 'max'=>50),
			array('description, status, date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, money, status, pay_type, date, requisites, description', 'safe', 'on'=>'search'),
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
            'user'=> array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'money' => 'Сумма',
			'status' => 'Статус',
			'pay_type' => 'Тип платежной системы',
			'requisites' => 'Номер счета',
			'description' => 'Дополнительно',
            'user' => 'От партнера',
            'date' => 'Дата добавлния',
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

        $criteria->order = 'date DESC';
		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('pay_type',$this->pay_type,true);
		$criteria->compare('requisites',$this->requisites,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeValidate()
    {
        if(parent::beforeValidate()) {
            if(!$this->user_id) {
                $this->user_id = Yii::app()->user->id;
            }
        }
        return true;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stateds the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Назначаем старый статус
     */
    protected function afterFind()
    {
        parent::afterFind();
        $this->_oldStatus = $this->status;
    }

    /**
     * Даем прибыль партнеру
     */
    protected function beforeSave()
    {
        if(parent::beforeSave()){
            if($this->status !== $this->_oldStatus)
            {
                if($this->_oldStatus == 'Отказано в оплате'){
                    $this->status = $this->_oldStatus;
                }
            }
        }
        return true;
    }

    protected function afterSave()
    {
        if($this->isNewRecord){
            $profit = Profit::model()->find('user_id = :id', array(':id'=>$this->user_id));
            $profit->profit -= $this->money;
            $profit->save();
        }

        if($this->_oldStatus != $this->status){
            if($this->status == 'Отказано в оплате'){
                $profit = Profit::model()->find('user_id = :id', array(':id'=>$this->user_id));
                $profit->profit += $this->money;
                $profit->save();
            }
        }
        parent::afterSave();
    }
}
