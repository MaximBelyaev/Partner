<?php
class DefaultController extends AdminController
{
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */

    public function actionIndex()
    {
        $userModel = User::model()->search('4', 't.id desc');
        $referralModel = Referrals::model()->search('4', 't.id desc');
        $statedsModel = Stateds::model()->search('4', 't.id desc');
        //Лучшие партнёры за 30 дней
        $bestPartnersModel = User::model()->search('4', 'month_profit desc');


        $this->render('index',array(
            'userModel'=>$userModel,
            'referralModel'=>$referralModel,
            'statedsModel'=>$statedsModel,
            'bestPartnersModel'=>$bestPartnersModel,
        ));


    }
    public function recursion($model, $s = 0)
    {
        $start = $s;
        if($mod = $model->findAllByAttributes(array('parent_id'=>array($start))))
        {
            echo '<ul>';
            foreach($mod as $items)
            {
                echo '<li>'.$items->title;
                $this->recursion($model, $items->id);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    /**
     * @param $model Menu;
     * @param int $s start from menu level
     */
    public function recursionArray($model, $s = 0)
    {
        $start = $s;
        if($mod = $model->findAll('parent_id=:parent_id ORDER BY pos ASC', array(':parent_id'=>$start)))
        {
            echo '<ul>';
            foreach($mod as $items)
            {
                echo '<li>'.$items->title;
                $this->recursion($model, $items->id);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app() -> errorHandler -> error) {
            if (Yii::app() -> request -> isAjaxRequest)
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