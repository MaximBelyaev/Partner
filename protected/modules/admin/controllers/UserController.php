<?php

class UserController extends AdminController
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new User;
		$this->performAjaxValidation($model);

		if (isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			$model->save();

			$valid = $model->validate();
			if ($valid)
            {
				if (Yii::app()->request->isAjaxRequest)
                {
					echo CJSON::encode(array(
						'status'=>'success'
					));
					Yii::app()->end();
				}
                else
                {
					$this->redirect(array('update','id' => $model->id));
				}
			}

            if($model->save())
            {
                Yii::app()->user->setFlash('success', "Данные успешно сохранены!");
                $this->refresh();
            }
            else
            {
                //Yii::app()->user->setFlash('error', "Error!");
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
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
            if($model->save())
            {
                Yii::app()->user->setFlash('success', "Данные успешно сохранены!");
                $this->refresh();
            }
            else
            {
                Yii::app()->user->setFlash('error', "Error!");
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
        $model=new User('search');
        $model->unsetAttributes();  // clear any default values
		$this->performAjaxValidation($model);
		if(isset($_POST['ajax']) && $_POST['ajax']==='create-user-form')
		{
			echo CActiveForm::validate($model);
			$model->setScenario('ajax');
			Yii::app()->end();
		}
        $dataProvider = new CActiveDataProvider('User', array(

        ));

        if(isset($_GET['User'])) {
            $model->attributes=$_GET['User'];
        }

        $this->render('index',array(
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException( 404, "Партнер с ID $id не найден" );
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='create-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
