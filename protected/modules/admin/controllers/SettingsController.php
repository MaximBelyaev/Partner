<?php

class SettingsController extends AdminController
{
	public function actionIndex()
	{
    	$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sys_update.js');

		$model = $this->settingsList;
        $allModels = Setting::model()->findAll();
        $paymentMethods = Setting::model()->findAll(array('condition' => "type = 'pay_service'"));
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
            'allModels' => $allModels,
			'model' => $model,
			'l' 	=> $l,
            'paymentMethods' => $paymentMethods,
		));
	}

	public function actionLand()
	{
		$this->render('land',array(

		));
	}

	public function actionLandEdit()
	{
		$dataProvider=new CActiveDataProvider('Offers');

		$config = json_decode(file_get_contents('config.json'));
		$configArr = (array) $config;
		$displayVars = [];
		foreach ($configArr as $key => $value)
		{
			if (stristr($key, 'displayvar'))
			{
				$displayVars[] = $key;
			}
		}

		if ($_POST)
		{
			foreach ($_POST as $k => $v)
			{
				if (stristr($k, 'textvar') || stristr($k, 'colorbgvar'))
				{
					$config->$k = $v;
				}
				foreach ($displayVars as $var)
				{
					$config->$var = 'none';
					if (isset($_POST[$var]))
					{
						$config->$var = '';
					}
				}
			}

			if ($_FILES)
			{
				$uploaddir = './img/';
				foreach($_FILES as $k => $file)
				{
					if (move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
					{
						$value = substr($uploaddir, 1);
						$value = $value .$file['name'];
						if (is_file(substr($config->$k, 1)))
						{
							unlink(substr($config->$k, 1));
						}
						$config->$k = $value;
					}
				}
			}

			$config = json_encode($config, JSON_UNESCAPED_UNICODE);
			$fp = fopen('config.json', 'w');
			fwrite($fp, $config);
			fclose($fp);
			$this->refresh();
		}

		$this->render('editland', array(
			'dataProvider'=>$dataProvider,
			'config' => $configArr
		));
	}

    public function actionAddPayment()
    {
        $model = new Setting();
        $model->type = 'pay_service';
        $model->header = $_POST['name'];
        $model->status = '1';
        if ($model->header)
        {
            $model->name = $model->transliteration($model->header);
            $model->save();
        }
        echo json_encode(array('obj_id' => $model->setting_id, 'obj_header' => $model->header));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
    }

    public function loadModel($id)
    {
        $model=Setting::model()->findByPk($id);
        if($model===null)
            throw new CHttpException( 404, "Настройка с ID $id не найдена" );
        return $model;
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
