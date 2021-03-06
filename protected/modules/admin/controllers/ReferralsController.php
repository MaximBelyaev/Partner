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
		$model->date = date('Y-m-d H:i:s', time());
		$this->performAjaxValidation($model);

		if(isset($_POST['Referrals']))
		{
			$model->attributes=$_POST['Referrals'];
			$model->setRecreate();
			$model->save();

			$valid=$model->validate();
			if($valid){
				echo CJSON::encode(array(
					'status'=>'success'
				));
				Yii::app()->end();
			}

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
		$old_interval = $model->recreate_interval;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Referrals']))
		{
			$model->attributes=$_POST['Referrals'];
			if ($old_interval !== $model->recreate_interval)
			{
				$model->recreate_date = date('Y-m-d H:i:s', strtotime('+1 month', time()));
			}
			if ($model->recreate_interval == '0')
			{
				$model->recreate_date = '';
			}
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
        $model = new Referrals('search');
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

	public function actionGetLands()
	{
		$relations = UsersLandings::model()->findAll(array("select"=>"land_id", 'condition' => "user_id = " . $_POST['user_id']));
		if ($relations)
		{
			$ids = [];
			foreach ($relations as $r)
			{
				$ids[] = $r->land_id;
			}
			$lands = Landings::model()->findAll("land_id IN (" . implode(',', $ids) . ")");

			echo '<label for="Referrals_land_id">Лендинг</label> <select class="dropdown" id="dropdown-land" name="Referrals[land_id]">';
			foreach ($lands as $land)
			{
				echo '<option value="' . $land->land_id . '">' . $land->name . '</option>';
			}
			echo '</select> <div class="errorMessage" id="Referrals_land_id_em_" style="display:none"></div>';
		}
		else
		{
			echo '<label for="Referrals_land_id">Лендинг</label> <select class="dropdown" id="dropdown-land" name="Referrals[land_id]"><option value="">- - - офферы не включены - - -</option></select>
			<div class="errorMessage" id="Referrals_land_id_em_" style="display:none"></div>';
		}
	}
}