<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $role
 * @property string $username
 * @property string $name
 * @property string $password
 * @property string $password_2
 * @property string $reg_date
 * @property string $skype
 */
class User extends CActiveRecord
{
	const ROLE_ADMIN = 'admin';
	const ROLE_USER = 'user';
	const ROLE_BANNED = 'banned';

	const PAY_CLICK = 'Оплата за переход';
	const PAY_REFERR = 'Процент с заказа';
	const VIP_DISPLAY = '|||';
	const EXPANDED_DISPLAY = '||';
	const STANDARD_DISPLAY = '|';

	public $password_2;
	public $requests_count;
	public $referrals_count;
	public $referrals_payed_count;
	public $old_site = '';
	public $month_profit;

	public $warnings = array();

	public function getProfit()
	{
		if ($this->money)
			return $this->money->profit;
		else
			return 'Не зарегистрирован';
	}

	public function getFullProfit()
	{
		if ($this->money)
			return $this->money->full_profit;
		else
			return 'Не зарегистрирован';
	}

	public function getRequest($use_click_pay = 1)
	{
		$count_req = sizeof(Requests::model()->findAll(array(
			'select' => 'id',
			'condition' => 'partner_id = :user and click_pay = :click_pay',
			'params' => array(':user' => $this->id, ':click_pay' => $use_click_pay)
		)));
		return $count_req;
	}

	public function getRefer()
	{
		$count_ref = sizeof(Referrals::model()->findAll(
			array('select' => 'id', 'condition' => 'user_id = :user',
				'params' => array(':user' => $this->id))));
		return $count_ref;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('username, password', 'required'),
			array('username', 'email'),
			array('role, telephone, status', 'length', 'max' => 50),
			array('use_click_pay, click_pay', 'numerical'),
			array('username, country, region, city', 'length', 'max' => 150),
			array('name, password, avatar, verification', 'length', 'max' => 255),
			array('skype, promo_code, reg_date, birth_date, full_profit', 'safe'),
			array('site', 'url', 'defaultScheme' => 'http'),
			array('site, promo_code, money, requests_count, referrals_count, status, use_click_pay,
			referrals_payed_count, id, role, username, full_profit, name, password, reg_date,
			birth_date, sex, country, region, city, avatar, verification, active, telephone, month_profit', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'money' => array(self::HAS_ONE, 'Profit', 'user_id'),
			'clients' => array(self::HAS_MANY, 'Referrals', 'user_id'),
			'requests' => array(self::HAS_MANY, 'Requests', 'partner_id'),
			'news' => array(self::HAS_MANY, 'News', 'news_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role' => 'Role',
			'username' => 'Email',
			'name' => 'ФИО',
			'password' => 'Пароль',
			'status' => 'Статус',
			'site' => 'Сайт',
			'reg_date' => 'Зарегистрирован',
			'birth_date' => 'Дата рождения',
			'sex' => 'Пол',
			'country' => 'Страна',
			'region' => 'Область',
			'city' => 'Город',
			'avatar' => 'Аватар',
			'verification' => 'Verification',
			'active' => 'Active',
			'telephone' => 'Телефон',
			'skype' => 'Скайп',
			'money' => 'На счету',
			'money[profit]' => 'На счету',
			'requests_count' => 'Всего переходов',
			'referrals_count' => 'Всего заявок',
			'referrals_payed_count' => 'Всего заказов',
			'use_click_pay' => 'Формат',
			'click_pay' => 'Стоимость перехода',
			'month_profit' => 'Прибыль за 30 дней'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($pageSize = 10, $defaultOrder = 't.username')
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('money');

		$requests_table = Requests::model()->tableName();
		$requests_count_sql = "(SELECT COUNT(*) FROM $requests_table rt WHERE rt.partner_id = t.id) ";

		$referrals_table = Referrals::model()->tableName();
		$referrals_count_sql = "(SELECT COUNT(*) FROM $referrals_table reft WHERE reft.user_id = t.id) ";
		$referrals_payed_sql = "(SELECT COUNT(*) FROM $referrals_table reft WHERE reft.user_id = t.id AND reft.status = 'Оплачено') ";
		$month_profit_sql = "(SELECT SUM(money) FROM $referrals_table reft WHERE reft.user_id = t.id AND reft.date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()) ";


		$criteria->select = array(
			'*',
			$requests_count_sql . "as requests_count",
			$referrals_count_sql . "as referrals_count",
			$referrals_payed_sql . "as referrals_payed_count",
			$month_profit_sql . "as month_profit",
		);

		$criteria->compare($requests_count_sql, $this->requests_count);
		$criteria->compare($referrals_count_sql, $this->referrals_count);
		$criteria->compare($referrals_payed_sql, $this->referrals_payed_count);
		$criteria->compare($month_profit_sql, $this->month_profit);

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.reg_date', $this->reg_date, true);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('site', $this->site, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('use_click_pay', $this->use_click_pay, true);

		//$criteria->compare('money.profit',$this->money->profit);
		//$criteria->compare('money.full_profit',$this->money->full_profit);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
			'pagination' => array('pageSize' => $pageSize),
			'sort' => array(
				'defaultOrder' => $defaultOrder,
				'attributes' => array(
					'requests_count' => array(
						'asc' => 'requests_count ASC',
						'desc' => 'requests_count DESC',
					),
					'referrals_count' => array(
						'asc' => 'referrals_count ASC',
						'desc' => 'referrals_count DESC',
					),
					'referrals_payed_count' => array(
						'asc' => 'referrals_payed_count ASC',
						'desc' => 'referrals_payed_count DESC',
					),
					'money.profit' => array(
						'asc' => 'money.profit',
						'desc' => 'money.profit DESC',
					),
					'money.full_profit' => array(
						'asc' => 'money.full_profit',
						'desc' => 'money.full_profit DESC',
					),
					'month_profit' => array(
						'asc' => 'month_profit',
						'desc' => 'month_profit DESC',
					),
					'*',
				),
			)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function sendMail($user, $subject, $link)
	{
		// несколько получателей
		$to = $user->username;
		// текст письма
		$message = '
            <h1>' . $subject . '</h1>
            <p style="text-align: center;">Здравствуйте, ' . $user->name . '! Для ' . $subject . ', перейдите пожалуйста по нижеуказаной ссылке:</p>
            ' . $link . '
        ';

		// Для отправки HTML-письма должен быть установлен заголовок Content-type
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// Дополнительные заголовки
		$headers .= 'To: ' . $user->name . ' <' . $user->username . '>' . "\r\n";
		$headers .= 'From: ' . Yii::app()->createAbsoluteUrl('/site/index') . ' <admin@' . $_SERVER['HTTP_HOST'] . '>' . "\r\n";
		mail($to, $subject, $message, $headers);
	}

	protected function beforeValidate()
	{
		parent::beforeValidate();
		return true;
	}

	protected function beforeSave()
	{
		parent::beforeSave();
		
		# если введен новый сайт и не установлен старый сайт
		if ( ($this->old_site != $this->site) && $this->old_site != '' ) {
			# устанавливаем сайт для подтверждения
			$this->unc_site = $this->site;
			# а старый сайт вернем
			$this->site = $this->old_site;
		}
		/*
		$this->site = trim(trim($this->site), '/');
		if ($this->site != '') {

			$host = parse_url($this->site, PHP_URL_HOST);
			if (is_null($host)) {
				$this->addError('site',
					"Не удалось разобрать введенный URL. <br> 
					Попробуйте ввести заново или изменить формат ввода");
			}
			$is_excepted = Setting::model()->find('name = "exception_sites" AND value LIKE "%' . $host . '%"');

			if ($is_excepted) {
				$this->addError('site', 'Этот сайт находится в списке исключений');
			}

			$duplicate_sites = User::model()->find(array(
				'select' => 'id',
				'condition' => "id!={$this->id} AND site LIKE '%$host%'",
			));
			if ($duplicate_sites) {
				$this->addError('site', 'Данный сайт уже используется другим партнером');
			}
		}
		*/
		
		$promo_code = trim($this->promo_code);
		if ($promo_code != '') {
			$duplicate_codes = User::model()->findAll(array(
				'select' => 'id',
				'condition' => "id!={$this->id} AND promo_code = '{$promo_code}'",
			));

			if (!empty($duplicate_codes)) {
				$this->addError('promo_code', 'Данный код уже используется');
			}
		}
		if ($this->hasErrors()) {
			return false;
		}
		return true;
	}

	protected function afterSave()
	{
		parent::afterSave();
		$this->setIsNewRecord(false);

		if ($this->old_site != $this->site) {
			// Добавляем уведомления
			$notification = new Notifications();
			$notification->user_id = $this->id;
			$notification->theme = Notifications::$THEME_SITE_CHANGED;
			$notification->is_new = 1;
			$notification->save();
		}

		if ($this->promo_code == '') {
			$this->promo_code = "PROMO_" . $this->id;
			$this->save();
		}

		if (isset($_POST['User']['money'])) {
			if (is_null($this->money)) {
				$this->money = new Profit();
				$this->money->user_id = $this->id;
			}
			$this->money->attributes = $_POST['User']['money'];

			if ($this->money->save()) {
				Yii::app()->user->setFlash('success', "Данные успешно сохранены!");
				return true;
			};
		}
	}

	protected function afterDelete()
	{
		parent::afterDelete();
		# удаление заявок на вывод
		$stateds = Stateds::model()->findAll(array(
			'condition' => 'user_id = :user',
			'params' => array(
				':user' => $this->id,
			),
		));
		foreach ($stateds as $stat) {
			$stat->delete();
		}

		# удаление уведомлений
		$nots = Notifications::model()->findAll(array(
			'condition' => 'user_id = :user',
			'params' => array(
				':user' => $this->id,
			),
		));
		foreach ($nots as $not) {
			$not->delete();
		}

		# удаление прибыли
		$this->money->delete();

		# удаление просмотров новостей
		$nws = NewsViews::model()->findAll(array(
			'condition' => 'user_id = :user',
			'params' => array(
				':user' => $this->id,
			),
		));
		foreach ($nws as $nw) {
			$nw->delete();
		}
	}

	protected function afterFind()
	{
		parent::afterFind();
		$this->reg_date = date('d.m.Y', strtotime($this->reg_date));
		$this->birth_date = date('d.m.Y', strtotime($this->birth_date));

		if ($this->unc_site) {
			$this->warnings['site'] = "У вас есть неподтвержденный сайт " . $this->unc_site . ".<br>Вставьте данный файл в корень вашего сайта <a href='/user/user/file'>prt_" . $this->id .  ".txt</a>";
		}
		return true;
	}


	public function getDayRequests($date, $use_click_pay = 1)
	{
		return Requests::model()->findAll(array(
			'select' => 'id',
			'condition' => 'partner_id = :user and date = :date and click_pay = :click_pay',
			'params' => array(
				':user' => $this->id,
				':date' => $date,
				':click_pay' => $use_click_pay,
			)
		));
	}

	public function renderClickPay()
	{
		if ($this->use_click_pay > 0) {
			return self::PAY_CLICK;
		} else {
			return self::PAY_REFERR;
		}
	}

	public function setStatusIcon()
	{
		if ($this->status === "VIP") {
			return self::VIP_DISPLAY;
		} elseif ($this->status === "Стандартный") {
			return self::STANDARD_DISPLAY;
		} elseif ($this->status === "Расширенный") {
			return self::EXPANDED_DISPLAY;
		}
	}

	public function setFormatIcon()
	{
		if ($this->use_click_pay > 0) {
			return "<img src=" . Yii::app()->controller->module->assetsUrl . "/img/icn_coin.png>";
		} else {
			return "<img src=" . Yii::app()->controller->module->assetsUrl . "/img/icn_percent.png>";
		}
	}


	public function getRangeData($start, $end) {
		$start = strtotime($start);
		$end = strtotime($end);
		$delta = Yii::app()->params['chartTimePoints'];
		
		$requests = $this->getRangeRequest($start, $end, $this->use_click_pay);
		return $requests;
	}

	public function getRangeRequest($start, $end, $use_click_pay = 0) {
		$req = Requests::model()->findAll(array(
			'select' => 'id',
			'condition' => 'partner_id = :user and click_pay = :click_pay and UNIX_TIMESTAMP(date) < :start and UNIX_TIMESTAMP(date) < :end ', 
			'params' => array( ':user' => $this->id, ':click_pay' => $use_click_pay, ':start' => $start, ':end' => $end )
		));
		return $req;
	}
}
