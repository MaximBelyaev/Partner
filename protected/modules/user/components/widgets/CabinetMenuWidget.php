<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 09.11.14
 * Time: 13:43
 */
class CabinetMenuWidget extends CWidget
{
    protected $_model;
    public function init()
    {
        $this->_model = User::model()->findByPk(Yii::app()->user->id);
    }
    public function run()
    {
        $this->render('cabinetMenu', array('model'=>$this->_model));
    }
}