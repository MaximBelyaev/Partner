<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property integer $setting_id
 * @property string $name
 * @property string $value
 */
class Setting extends CActiveRecord
{

    public static $currencieslist = [
        'RUB' => 'Рубли (₽)',
        'USD' => 'Доллары ($)',
        'UAH' => 'Гривна (₴)',
        'EUR' => 'Евро (€)'
    ];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'settings';
	}

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, header, status', 'length', 'max'=>128),
			array('type', 'length', 'max'=>255),
			array('value', 'length', 'max'=>4095),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('setting_id, name, value, status, type', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'setting_id' => 'ID',
			'name' => 'Имя',
			'value' => 'Значение',
			'status' => 'Статус'
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

		$criteria->compare('setting_id',$this->setting_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Settings the static model class
	 */

	public function setDisplayIcon()
	{
		if ($this->name === 'qiwi')
		{
			return "<img src=" . Yii::app()->controller->module->assetsUrl . "/img/qiwi_icon.jpg>";
		}
		elseif ($this->name === 'webmoney')
		{
			return "<img src=" . Yii::app()->controller->module->assetsUrl . "/img/webmoney_icon2.png>";
		}
		elseif ($this->name === 'paypal')
		{
			return "<img src=" . Yii::app()->controller->module->assetsUrl . "/img/paypal_icon.png>";
		}
		elseif ($this->name === 'yandex_money')
		{
			return "<img src=" . Yii::app()->controller->module->assetsUrl . "/img/yandexmoney_icon.png>";
		}
	}

    public function setCurrencyIcon()
    {
        if ($this->value === 'RUB')
        {
            echo '₽';
        }
        elseif ($this->value === 'USD')
        {
            echo '$';
        }
        elseif ($this->value === 'UAH')
        {
            echo '₴';
        }
        elseif ($this->value === 'EUR')
        {
            echo '€';
        }
    }

    public static function transliteration($str)
    {
        $transliteration = array(
            'А' => 'A', 'а' => 'a',
            'Б' => 'B', 'б' => 'b',
            'В' => 'V', 'в' => 'v',
            'Г' => 'G', 'г' => 'g',
            'Д' => 'D', 'д' => 'd',
            'Е' => 'E', 'е' => 'e',
            'Ё' => 'Yo', 'ё' => 'yo',
            'Ж' => 'Zh', 'ж' => 'zh',
            'З' => 'Z', 'з' => 'z',
            'И' => 'I', 'и' => 'i',
            'Й' => 'J', 'й' => 'j',
            'К' => 'K', 'к' => 'k',
            'Л' => 'L', 'л' => 'l',
            'М' => 'M', 'м' => 'm',
            'Н' => "N", 'н' => 'n',
            'О' => 'O', 'о' => 'o',
            'П' => 'P', 'п' => 'p',
            'Р' => 'R', 'р' => 'r',
            'С' => 'S', 'с' => 's',
            'Т' => 'T', 'т' => 't',
            'У' => 'U', 'у' => 'u',
            'Ф' => 'F', 'ф' => 'f',
            'Х' => 'H', 'х' => 'h',
            'Ц' => 'Cz', 'ц' => 'cz',
            'Ч' => 'Ch', 'ч' => 'ch',
            'Ш' => 'Sh', 'ш' => 'sh',
            'Щ' => 'Shh', 'щ' => 'shh',
            'Ъ' => 'ʺ', 'ъ' => 'ʺ',
            'Ы' => 'Y`', 'ы' => 'y`',
            'Ь' => '', 'ь' => '',
            'Э' => 'E`', 'э' => 'e`',
            'Ю' => 'Yu', 'ю' => 'yu',
            'Я' => 'Ya', 'я' => 'ya',
            '№' => '#', 'Ӏ' => '‡',
            '’' => '`', 'ˮ' => '¨',
        );

        $str = strtr($str, $transliteration);
        $str = mb_strtolower($str, 'UTF-8');
        $str = preg_replace('/[^0-9a-z\-]/', '', $str);
        $str = preg_replace('|([-]+)|s', '-', $str);
        $str = trim($str, '-');

        return $str;
    }

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
