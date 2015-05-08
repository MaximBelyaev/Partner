<?php

class StatedsController extends AdminController
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Stateds;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Stateds']))
		{
			$model->attributes=$_POST['Stateds'];
			$model->setRecreate();
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$old_interval = $model->recreate_interval;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Stateds']))
		{
			$model->attributes=$_POST['Stateds'];
			if ($old_interval !== $model->recreate_interval)
			{
				$model->recreate_date = date('Y-m-d H:i:s', strtotime('+1 month', time()));
			}
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('main', 'Данные успешно сохранены!'));
				$this->refresh();
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model=new Stateds('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Stateds']))
            $model->attributes=$_GET['Stateds'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Stateds the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Stateds::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,"Заявка с ID $id была удалена или не создана");
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Stateds $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='stateds-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
