<?php

/**
 * This is the model class for table "requests".
 *
 * The followings are the available columns in table 'requests':
 * @property integer $id
 * @property string $ip
 * @property string $date
 * @property integer $partner_id
 */
class Requests extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'requests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip, partner_id', 'required'),
			array('partner_id, land_id', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>255),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ip, date, partner_id', 'safe', 'on'=>'search'),
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
			'user'		=> array( self::BELONGS_TO, 'User', 'partner_id' ),
			'landing'	=> array( self::BELONGS_TO, 'Landings', 'land_id' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'		=> 'ID',
			'partner_id'=> 'Partner',
			'land_id'	=> 'Landing id',
			'ip'		=> 'Ip',
			'date'		=> 'Date',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('partner_id',$this->partner_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Requests the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getThisDayRefferals()
	{
		return Referrals::model()->findAll(
			array(
				'select'=>'*',
				'condition'=>'user_id = :user and date >= :date_start AND date <= :date_end',
				'params'=>array(
					':user'=>Yii::app()->user->id,
					':date_start' => $this->date.' 00:00:00',
					':date_end' => $this->date.' 23:59:59',
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
		$month_start = ( date('Y-m-01', strtotime($this->date)) );
		$month_end = ( date('Y-m-t', strtotime($this->date)) );	
		
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


	public function getPayedReferrals()
	{
		return Referrals::model()->findAll(
			array(
				'select' => '*',
				'condition' => 'user_id = :user and date >= :date_start AND date <= :date_end AND status= :status',
				'params' => array(
					':user' => Yii::app()->user->id,
					':date_start' => $this->date.' 00:00:00',
					':date_end' => $this->date.' 23:59:59',
					':status' => Referrals::$STATUS_APPLIED,
				)
			)
		);
	}

	public function getThisMonthRequests($use_click_pay = 1) {
		$month_start = ( date('Y-m-01', strtotime($this->date)) );
		$month_end = ( date('Y-m-t', strtotime($this->date)) );	
		
		return Requests::model()->findAll(
				array(
					'select'=>'*',
					'condition'=>'
						partner_id = :user 
						AND date >= :date_start 
						AND date <= :date_end
						AND click_pay = :click_pay',
					'params'=>array(
						':user' => Yii::app()->user->id,
						':date_start' => $month_start,
						':date_end'   => $month_end,
						':click_pay'  => $use_click_pay,
					)	
				)
			);
	}

	public function getThisMonthProfit()
	{
		if ( $this->user->use_click_pay ) {
			$requests = $this->getThisMonthRequests();
			if($this->user->click_pay > 0) {
				$click_pay = $this->user->click_pay;
			} else {
				$click_pay = Setting::model()->find('name = "click_pay"');
				$click_pay = $click_pay->value;
			}
			return $click_pay * count($requests);
			//var_dump(count($requests));
		} else {
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
	}


	public function getDayRequests($use_click_pay = 1)
	{
		return ($this->user->getDayRequests($this->date, $use_click_pay));
	}


	public function getDailyProfit()
	{
		if ($this->user->use_click_pay) {
			if($this->user->click_pay > 0) {
				$click_pay = $this->user->click_pay;
			} else {
				$click_pay = Setting::model()->find('name = "click_pay"');
				$click_pay = $click_pay->value;
			}
			return $click_pay * count($this->getDayRequests());
		} else {
			$full_price = array_reduce(
				$this->getPayedReferrals(), 
				function($c,$v){ 
					return ($c ." ". (float)$v->money); 
				}
			);
			$partners_part = $full_price * (Yii::app()->params['profit_percent'] * 0.01);
			return $partners_part;
		}
	}

}
