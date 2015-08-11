<?php

class SettingsController extends AdminController
{
	public function actionIndex()
	{
    	$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sys_update.js');

		$model = $this->settingsList;
		$l = Yii::app()->db->createCommand()
				->select('version')
				->from('versions')
				->limit(1)
				->order('date DESC')
				->queryRow();

		if(isset($_POST['Setting']))
		{
			$valid = true;
			foreach( $model as $i => $item )
			{
				if(isset($_POST['Setting'][$i]))
				{
					$item->attributes = $_POST['Setting'][$i];
				}
				$valid = $item->validate() && $valid;
			}
			if($valid)
			{
				foreach ($model as $m)
				{
					$m->save();
				}
				Yii::app()->user->setFlash('success', "Данные успешно сохранены!");
			}  // все элементы корректны
		}

		$this->render('index',array(
			'model' => $model,
			'l' 	=> $l
		));
	}

	public function actionLand()
	{
		$this->render('land',array(

		));
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
