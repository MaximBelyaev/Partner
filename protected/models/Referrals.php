<?php

/**
 * This is the model class for table "referrals".
 *
 * The followings are the available columns in table 'referrals':
 * @property integer $id
 * @property string $email
 * @property string $site
 * @property string $region
 * @property integer $tz
 * @property string $request_type
 * @property string $requests
 * @property string $user_from
 * @property string $money
 * @property string $status
 * @property string $promo
 * @property integer $user_id
 * @property string $old_status
 */
class Referrals extends CActiveRecord
{
    protected $_oldStatus;

    public static $STATUS_WAITING = 'Ждет обработки';
    public static $STATUS_REQUEST = 'Заявка';
    public static $STATUS_APPLIED = 'Оплачено';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'referrals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'required'),
			array('id, tz, user_id', 'numerical', 'integerOnly'=>true),
			array('email, site, region, request_type, promo', 'length', 'max'=>150),
			array('requests, user_from, status', 'length', 'max'=>255),
			array('money', 'length', 'max'=>8),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, site, region, tz, request_type, requests, user_from, money, status, user_id, date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
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
			'email' => 'Email',
			'site' => 'Адрес сайта',
			'region' => 'Регион сбора запросов',
			'tz' => 'Нужно ли ТЗ копирайтеру?',
			'request_type' => 'Какие запросы нужны?',
			'requests' => 'Пример нужных запросов',
			'user_from' => 'От какого партнера',
			'money' => 'Сумма',
			'status' => 'Статус',
			'user_id' => 'User',
			'user' => 'От партнера',
			'date' => 'Дата заявки',
            'promo' => 'Промо код',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('tz',$this->tz);
		$criteria->compare('request_type',$this->request_type,true);
		$criteria->compare('requests',$this->requests,true);
		$criteria->compare('user_from',$this->user_from,true);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date',$this->date);
		$criteria->order = 'date DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Referrals the static model class
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


    public function getThisMonthReferrals()
	{
		$month_start = ( date('Y-m-01', strtotime($this->date)) );
		$month_end = ( date('Y-m-t', strtotime($this->date)) );	
	
		return Referrals::model()->findAll(
			array(
				'select'=>'*',
				'condition'=>'user_id = :user and date >= :date_start AND date <= :date_end',
				'params'=>array(
					':user'=>Yii::app()->user->id,
					':date_start' => $month_start . ' 00:00:00',
					':date_end' => $month_end . ' 23:59:59',
				)
			)
		);
	}


	public function getThisMonthPayedReferrals()
	{
		$month_start = date('Y-m-01', strtotime($this->date));
		$month_end = date('Y-m-t', strtotime($this->date));	
		
		return Referrals::model()->findAll(
			array(
				'select' => '*',
				'condition' => 'user_id = :user and date >= :date_start AND date <= :date_end AND status= :status',
				'params' => array(
					':user' => Yii::app()->user->id,
					':date_start' => $month_start . ' 00:00:00',
					':date_end' => $month_end . ' 23:59:59',
					':status'=> Referrals::$STATUS_APPLIED,
				)
			)
		);
	}	

	public function getThisDayRefferals()
	{
		$day_start = date('Y-m-d 00:00:00', strtotime($this->date));
		$day_end   = date('Y-m-d 23:59:59', strtotime($this->date));
		return Referrals::model()->findAll(
			array(
				'select'=>'*',
				'condition'=>'user_id = :user and date >= :date_start AND date <= :date_end',
				'params'=>array(
					':user'=>Yii::app()->user->id,
					':date_start' => $day_start,
					':date_end' => $day_end,
				)
			)
		);
	}

	public function getThisDayPayedReferrals()
	{
		$day_start = date('Y-m-d 00:00:00', strtotime($this->date));
		$day_end   = date('Y-m-d 23:59:59', strtotime($this->date));
		
		return Referrals::model()->findAll(
			array(
				'select' => '*',
				'condition' => 'user_id = :user and date >= :date_start AND date <= :date_end AND status= :status',
				'params' => array(
					':user' => Yii::app()->user->id,
					':date_start' => $day_start,
					':date_end' => $day_end,
					':status'=> Referrals::$STATUS_APPLIED,
				)
			)
		);
	}	


	public function getThisDayProfit()
	{
		$refs = $this->getThisDayPayedReferrals();
		if (!empty($refs))
        {
			$full_price = array_reduce(
				$refs, 
				function($c,$v){ 
					return ($c + (float)$v->money); 
				}
			);
			$full_price = $full_price * (Yii::app()->params['profit_percent'] * 0.01);
		} else
            {
			$full_price = 0;
		    }

		return $full_price;
	}


	public function getThisMonthProfit()
	{
		$refs = $this->getThisMonthPayedReferrals();
		if (!empty($refs)) {
			$full_price = array_reduce(
				$refs, 
				function($c,$v){ 
					return ($c + (float)$v->money); 
				}
			);
			$full_price = $full_price * (Yii::app()->params['profit_percent'] * 0.01);
		} else {
			$full_price = 0;
		}
		return $full_price;
	}


    /**
     * Даем прибыль партнеру
     */
    protected function beforeSave()
    {
        if(parent::beforeSave()){
           	$promo = trim($this->promo);
            if($promo)
            {
            	$user  = User::model()->find("promo_code = '$promo'");
            	if ($user) {
                	$this->user_id = $user->id;
            	}
            }

            if ($this->_oldStatus == self::$STATUS_APPLIED )
            {
            	$this->status = self::$STATUS_APPLIED;
            }

			if($this->status !== $this->_oldStatus && $this->status == self::$STATUS_APPLIED 
            	&& $this->money > 0 && $this->user_id > 0)
            {
            	if (!$this->user->use_click_pay)
                {
					$profit = Profit::model()->find('user_id = :id', array(':id'=>$this->user_id));
					$res_profit = $this->money * (Yii::app()->params['profit_percent'] / 100);
					var_dump($res_profit);
					$profit->profit += $res_profit;
					$profit->full_profit += $res_profit;
					$profit->save();
            	}
            }
        }
        return true;
    }
}
