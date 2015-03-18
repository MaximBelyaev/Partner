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
 */
class User extends CActiveRecord
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';

    public $password_2;

    public function getProfit()
    {
        if($this->money)
            return $this->money->profit;
        else
            return 'Не зарегистрирован';
    }

    public function getFullProfit()
    {
        if($this->money)
            return $this->money->full_profit;
        else
            return 'Не зарегистрирован';
    }

    public function getRequest()
    {
        $count_req = sizeof(Requests::model()->findAll(array('select'=>'id','condition'=>'partner_id = :user', 'params'=>array(':user'=>$this->id))));
        return $count_req;
    }

    public function getRefer()
    {
        $count_ref = sizeof(Referrals::model()->findAll(
            array('select'=>'id','condition'=>'user_id = :user',
                'params'=>array(':user'=>$this->id))));
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
			array('role, telephone', 'length', 'max'=>50),
			array('username, country, region, city', 'length', 'max'=>150),
			array('name, password, avatar, verification', 'length', 'max'=>255),
			array('reg_date, birth_date, full_profit', 'safe'),
			array('id, role, username, full_profit, name, password, reg_date, birth_date, sex, country, region, city, avatar, verification, active, telephone', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'money'=> array(self::HAS_ONE, 'Profit', 'user_id'),
            'clients' => array(self::HAS_MANY, 'Referrals', 'user_id'),
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
			'username' => 'email',
			'name' => 'ФИО',
			'password' => 'Пароль',
			'reg_date' => 'Дата регистрации',
			'birth_date' => 'Дата рождения',
			'sex' => 'Пол',
			'country' => 'Страна',
			'region' => 'Область',
			'city' => 'Город',
			'avatar' => 'Аватар',
			'verification' => 'Verification',
			'active' => 'Active',
			'telephone' => 'Телефон',
			'money' => 'На счету',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('reg_date',$this->reg_date,true);
        $criteria->order = 'reg_date DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function sendMail($user, $subject, $link)
    {
        // несколько получателей
        $to  = $user->username;
        // текст письма
        $message = '
            <h1>'.$subject.'</h1>
            <p style="text-align: center;">Здравствуйте, '.$user->name.'! Для '.$subject.', перейдите пожалуйста по нижеуказаной ссылке:</p>
            '.$link.'
        ';

        // Для отправки HTML-письма должен быть установлен заголовок Content-type
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Дополнительные заголовки
        $headers .= 'To: '.$user->name.' <'.$user->username.'>'. "\r\n";
        $headers .= 'From: '.Yii::app()->createAbsoluteUrl('/site/index').' <admin@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
}
