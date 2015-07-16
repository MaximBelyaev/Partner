<?php 


class LandingsController extends AdminController
{
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Landings');
		$model = new Landings;
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}


	public function actionCreate()
	{
		$model = new Landings;
		$this->performAjaxValidation( $model );

		if(isset($_POST['Landings']))
		{
            $model->attributes = $_POST['Landings'];
//            $model->icon = CUploadedFile::getInstanceByName('Landings[icon]');
			$model->icon = CUploadedFile::getInstance($model, 'icon');
            if($model->save())
			{
				if ($model->icon) {
					$path = Yii::getPathOfAlias('webroot').'/uploads/' . $model->icon->getName();
					$model->icon->saveAs($path);
				}
				$this->redirect(array('update','id'=>$model->land_id));
			}
			else
			{
				var_dump($model->getErrors());
				exit();
			}
		}

		$this->render('create',array(
			'model' => $model,
		));
	}


	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$this->performAjaxValidation($model);

		if(isset($_POST['Landings']))
		{
			$model->attributes = $_POST['Landings'];
			if($model->save())
			{
				$this->refresh();
			}
			else
			{
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionSort()
    {
        $model = Landings::model()->findAll(array('order' => 'sort_order ASC'));

        if(isset($_POST['Landings']))
        {
            $valid = true;
            foreach( $model as $i => $item )
            {
                if(isset($_POST['Landings'][$i]))
                {
                    $item->attributes = $_POST['Landings'][$i];
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
                $this->redirect(array('landings/sort'));
            }  // все элементы корректны
        }

        $this->render('sort',array(
            'model'=>$model,
        ));
    }


	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	public function actionChange() 
	{
		if (isset($_POST['land'])) {
			Yii::app()->session['landing'] = $_POST['land'];
			echo json_encode(array('status'=>'success'));
		} else {
			echo json_encode(array('status'=>'fail'));
		}
		Yii::app()->end();
	}


	protected function performAjaxValidation($model)
	{
		if( isset($_POST['ajax']) && ($_POST['ajax'] === 'landings-form') )
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function loadModel($id)
	{
		$model = Landings::model()->findByPk($id);
		if( $model === null )
			throw new CHttpException( 404, "Лендинг с ID $id не найден" );
		return $model;
	}
}