<?php

class ReferralsController extends AdminController
{
    const NOTVIEW = 1;
    const ATTACH = 2;
    const CANCEL = 3;

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Referrals;
		$this->performAjaxValidation($model);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Referrals']))
		{
			$model->attributes=$_POST['Referrals'];
			if($model->save()){
				$this->redirect(array('index','id'=>$model->id));
			}
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Referrals']))
		{
			$model->attributes=$_POST['Referrals'];
			if($model->save()) {
                Yii::app()->user->setFlash('success', "Данные успешно сохранены!");
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model=new Referrals('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Referrals']))
            $model->attributes=$_GET['Referrals'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Referrals the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Referrals::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,"Клиент с ID $id был удален или не создан");
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Referrals $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='create-referral-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
