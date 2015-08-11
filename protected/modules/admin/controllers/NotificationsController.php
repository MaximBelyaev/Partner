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
		$model = Notifications::model()->findByPk( $id );
		if( $model === null )
			throw new CHttpException( 404 , "Уведомление с ID $id было удалено или не создано" );
		return $model;
	}

	public function actionIndex()
	{
		$model = new Notifications('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Notifications'])) {
			$model->attributes = $_GET['Notifications'];
		}
		$this->render('index',array(
			'model'=>$model,
		));
	}
}