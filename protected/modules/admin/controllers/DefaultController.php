<?php
class DefaultController extends AdminController
{
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */

    protected $index_items_count = 6;

	public function actionIndex()
	{
		//Список новых партнёров
		$userModel = User::model()->search( $this->index_items_count, 't.reg_date desc');

		//Список новых клиентов
		$referralModel = new CActiveDataProvider('Referrals', array(
			'criteria' => array(
				'select'=>'*',
				'condition'=>'status = "Заявка"',
				'order'=>'date DESC',
			),
			'pagination'=>array(
				'pageSize'=>$this->index_items_count,
			)
		));


		//Последние заявки
		$statedsModel = Stateds::model()->search( $this->index_items_count, 't.date desc');

		//Лучшие партнёры за 30 дней
		$bestPartnersModel = User::model()->search( $this->index_items_count, 'month_profit desc');

		$this->render('index',array(
			'userModel'=>$userModel,
			'referralModel'=>$referralModel,
			'statedsModel'=>$statedsModel,
			'bestPartnersModel'=>$bestPartnersModel,
		));
	}

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this -> render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $this->layout = '/layouts/loginLayout';
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

}