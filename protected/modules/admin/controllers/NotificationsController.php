<?php

class NotificationsController extends AdminController
{
	
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		if($model->is_new) {
			$model->is_new = 0;
			if($model->save()){
				$this->notifications_count--;
			}
		}
		$this->render('update', array(
			'model' => $model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}

	public function loadModel($id)
	{
		$model=Notifications::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,"Уведомление с ID $id было удалено или не создано" );
		return $model;
	}

	public function actionIndex()
	{
		$model = new Notifications('search');
        $model->unsetAttributes();  // clear any default values

        if(isset($_GET['User'])) {
            $model->attributes=$_GET['User'];
        }
        $this->render('index',array(
            'model'=>$model,
        ));
	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}