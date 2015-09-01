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

    public $username;

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
			array('id, tz, user_id, land_id', 'numerical', 'integerOnly'=>true),
			array('email, site, region, request_type, promo', 'length', 'max'=>150),
			array('requests, user_from, status, recreate_interval, recreate_date', 'length', 'max'=>255),
			array('money', 'length', 'max'=>8),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, site, region, tz, request_type, requests, user_from, money, status, user_id, date,
			recreate_interval, username, land_id, recreate_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user'		=> array( self::BELONGS_TO, 'User', 'user_id' ),
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
			'user_id'	=> 'User',
			'land_id'	=> 'Лендинг',
			'email'		=> 'Контакт',
			'site'		=> 'Cайт',
			'region'	=> 'Регион сбора запросов',
			'tz'		=> 'Нужно ли ТЗ копирайтеру?',
			'requests'	=> 'Пример нужных запросов',
			'user_from'	=> 'От партнера',
			'money'		=> 'Сумма',
			'status'	=> 'Статус',
			'user'		=> 'От партнера',
			'username'  => 'От партнера',
			'date'		=> 'Дата заявки',
			'promo'		=> 'Промо код',
			'request_type' => 'Какие запросы нужны?',
			'recreate_date' => 'Дата повторной оплаты',
			'recreate_interval' => 'Формат',
			'landing' 	=> 'Лендинг',
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
	public function search($pageSize = 10)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->with = array( 'user', 'landing' );

		if ( (int)Yii::app()->session['landing'] > 0 ) {
			$criteria->compare('`landing`.`land_id`', (int)Yii::app()->session['landing']);	
		}

		$criteria->compare('id',$this->id)
			->compare('email',$this->email,true)
			->compare('site',$this->site,true)
			->compare('region',$this->region,true)
			->compare('tz',$this->tz)
			->compare('request_type',$this->request_type,true)
			->compare('requests',$this->requests,true)
			->compare('user.username',$this->username,true)
			->compare('money', $this->money,true)
			->compare('`t`.`status`', $this->status,true)
			->compare('date',$this->date)
			->compare('recreate_interval',$this->recreate_interval,true)
			->compare('recreate_date',$this->recreate_date,true);
       
		$sort_attributes = array(
			'date' => array(
				'asc'  => 'date',
				'desc' => 'date DESC', 
			),
			'email' => array(
				'asc'  => 'email',
				'desc' => 'email DESC', 
			),
			'site' => array(
				'asc'  => 'site',
				'desc' => 'site DESC', 
			),
			'username' => array(
				'asc'  => 'user.username',
				'desc' => 'user.username DESC', 
			),
			'money' => array(
				'asc'  => 'money',
				'desc' => 'money DESC', 
			),
			'status' => array(
				'asc'  => '`t`.`status`',
				'desc' => '`t`.`status` DESC', 
			)
		);

		if (!isset(Yii::app()->session['landing']) || (int)Yii::app()->session['landing'] == 0) {
			$sort_attributes['land_id'] = array(
				'asc'  => 'landing.name',
				'desc' => 'landing.name DESC', 
			);
		}

		return new CActiveDataProvider($this, array(
			'criteria'	=> $criteria,
			'sort'  	=> array(
				'defaultOrder' 	=> 'date DESC', 
				'attributes' 	=> $sort_attributes,
			),
			'pagination'=> array('pageSize' => $pageSize),
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

    /**
     * Даем прибыль партнеру
     */
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
           	$promo = trim($this->promo);
            if($promo)
            {
            	$user  = User::model()->find("promo_code = '$promo'");
            	if ($user)
                {
                	$this->user_id = $user->id;
            	}
            }

            if ($this->_oldStatus == self::$STATUS_APPLIED )
            {
            	$this->status = self::$STATUS_APPLIED;
            }

            $land = Landings::model()->findByPk($this->land_id);
            $ref_user = UsersLandings::model()->findByAttributes(array('user_id' => $this->user_id, 'land_id' => $land->land_id));

            # если старый статус не равен новому и он равен "Оплачено"
			if(
				( $this->status!==$this->_oldStatus ) 
				&& $this->status == self::$STATUS_APPLIED 
            	&& $this->money > 0 && $this->user_id > 0)
            {
            	# если пользователь НЕ работает в режиме оплаты за переход
				if (!$ref_user->use_click_pay)
				{
                    $profit = Profit::model()->find('user_id = :id', array(':id'=>$this->user_id));

					if(is_null($profit))
                    {
						$profit = new Profit();
						$profit->user_id = $this->user_id;
					}

					# установим процент за заказ с лендинга для соответствующего стататуса клиента
					$land_percent = 0;
					if ($land)
                    {
						if ($this->user->status === "VIP")
						{
							$land_percent = $land->vip;
						}
						elseif ($this->user->status === "Расширенный")
						{
							$land_percent = $land->extended;
						}
						else
						{
							$land_percent = $land->standard;
						}
					}

					if ($ref_user->use_fixed_pay == 1 && $land->use_fixed_pay == 1)
					{
                        $payment = $land->fixed_pay;
                        $profit->profit += $payment;
                        $profit->full_profit += $payment;
                        $profit->save();
					}
					elseif (($ref_user->use_fixedpay != 1) && $land && $land_percent)
					{
						# если заказ был для определенного лендинга и для этого лендинга установлена цена заказа
						$payment = ($land_percent*$this->money)/100;
						$profit->profit += $payment;
						$profit->full_profit += $payment;
						$profit->save();
                    }
            	}
            }
        }
        return true;
    }

	public function setRecreate ()
	{
		if ($this->recreate_interval === '1')
		{
			$this->recreate_date = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($this->date)));
		}
		if ($this->recreate_interval === '0')
		{
			$this->recreate_date = '';
		}
	}

	public function getFormatIcons ()
	{
		if ($this->recreate_interval === '1')
		{
			return "<img class='center_icon' src='" . Yii::app()->controller->module->assetsUrl . "/img/icn_coin.png'>";
		}
	}

	public function getLandingIcon()
	{
		if (!is_null($this->landing)) {
			return $this->landing->getIcon();
		}
	}
}