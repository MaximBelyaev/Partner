<?php

/**
 * This is the model class for table "promobanns".
 *
 * The followings are the available columns in table 'promobanns':
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $image
 * @property integer $width
 * @property integer $height
 */
class Promobanns extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'promobanns';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, image', 'required'),
			array('width, height', 'numerical', 'integerOnly'=>true),
			array('type, name, image', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, name, image, width, height', 'safe', 'on'=>'search'),
			array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
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
			'id' => 'ID',
			'type' => 'Тип',
			'name' => 'Название',
			'image' => 'Изображение',
			'width' => 'Ширина',
			'height' => 'Высота',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('width',$this->width);
		$criteria->compare('height',$this->height);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banners the static model class
	 */

	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			if ($this->type === 'gif')
			{

			}
		}
		return true;
	}

	protected function afterFind()
	{
		parent::afterFind();
		return true;
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}