<?php

class PromobannsController extends AdminController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	private $typesList = array(
		'gif' => 'GIF',
		'jpg' => 'JPEG'
	);

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to t;he 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Promobanns;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$videoModel = new Promovideo;
		if(isset($_POST['Promovideo']))
		{
			$videoModel->attributes=$_POST['Promovideo'];
			$videoModel->save();
			Yii::app()->user->setFlash('success', "Данные успешно сохранены!");
			$this->refresh();
		}
		if(isset($_POST['Promobanns']))
		{
			//Загрузка изображения
			$rnd = rand(0,9999);
			$model->attributes=$_POST['Promobanns'];
			$uploadedFile=CUploadedFile::getInstance($model,'image');
			$fileName = "{$rnd}-{$uploadedFile}";
				if ($uploadedFile)
				{
					$uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/'.$fileName);
					$model->image = $fileName;
				}
			if ($model->save())
			{
				Yii::app()->user->setFlash('success', "Данные успешно сохранены!");
			}
		}


		$this->render('create',array(
			'model'=>$model,
			'typesList'=>$this->typesList,
			'videoModel'=>$videoModel,
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

		if(isset($_POST['Promobanns']))
		{
			$_POST['Promobanns']['image'] = $model->image;;
			$model->attributes=$_POST['Promobanns'];
			$uploadedFile=CUploadedFile::getInstance($model,'image');
			if(!empty($uploadedFile))  // проверка, присутствует ли изображение
				{
					$rnd = rand(0,9999);
					$fileName = "{$rnd}-{$uploadedFile}";
					$uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/uploads/'.$fileName);
					unlink(Yii::app()->request->baseUrl.'uploads/'.$model->image);
					$model->image = $fileName;
					$model->save();
					Yii::app()->user->setFlash('success', "Данные успешно сохранены!");
					$this->refresh();
				}
		}

		$this->render('update',array(
			'typesList'=>$this->typesList,
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
		$model = $this->loadModel($id);
		if ($model->image)
		{
			unlink(Yii::app()->request->baseUrl.'uploads/'.$model->image);
			$model->image = '';
		}
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Promobanns('search');
		$model->unsetAttributes();
		if(isset($_GET['Promobanns']))
			$model->attributes=$_GET['Promobanns'];

		$this->render('index',array(
			'model'=>$model
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Promobanns('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Promobanns']))
			$model->attributes=$_GET['Promobanns'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Banners the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		if ((boolean)$id == true) {
			$model=Promobanns::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
		} else {
			echo 'no id';
		}
	}

	/**
	 * Performs the AJAX validation.
	 * @param Banners $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='promobanns-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
