<?php

class UserController extends MyUserController
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            )
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $statistic = array();
        $this->layout = '/layouts/cabinet';
        $user = User::model()->findByPk(Yii::app()->user->id);
        $requests = Requests::model()->findAll(array('select'=>'date','condition'=>'partner_id = :user', 'params'=>array(':user'=>$user->id), 'distinct'=>true, 'order' => 'date DESC'));
        $dataProvider = new CActiveDataProvider('Referrals',
            array(
                'criteria'=>array(
                    'condition'=>'user_id = :id',
                    'params'=>array(':id'=>$user->id),
                    'order'=>'date DESC',
                ),
                'pagination'=>array(
                    'pageSize'=>12,
                ),
            )
        );
        foreach ($requests as $i => $value)
        {
            $statistic[$i] = array(
                'date'=>$value->date,
                'followers'=>sizeof(Requests::model()->findAll(array('select'=>'id','condition'=>'partner_id = :user and date = :date', 'params'=>array(':user'=>Yii::app()->user->id, ':date'=>$value->date)))),
                'zakazu'=>sizeof(Referrals::model()->findAll(
                    array('select'=>'id','condition'=>'user_id = :user and date >= :date_start AND date <= :date_end',
                    'params'=>array(
                        ':user'=>Yii::app()->user->id,
                        ':date_start'=>$value->date.' 00:00:00',
                        ':date_end'=>$value->date.' 23:59:59',
                        )
                    ))
                ),
                'sites'=>
                    Referrals::model()->findAll(
                        array('select'=>'site','condition'=>'user_id = :user and date >= :date_start AND date <= :date_end AND status= :status',
                            'params'=>array(
                                ':user'=>Yii::app()->user->id,
                                ':date_start'=>$value->date.' 00:00:00',
                                ':date_end'=>$value->date.' 23:59:59',
                                ':status'=>'Подтвержден',
                            )
                        )
                    ),
                'oplata'=>sizeof(Referrals::model()->findAll(
                    array('select'=>'id','condition'=>'user_id = :user and date >= :date_start AND date <= :date_end AND status = "Подтвержден"',
                        'params'=>array(
                            ':user'=>Yii::app()->user->id,
                            ':date_start'=>$value->date.' 00:00:00',
                            ':date_end'=>$value->date.' 23:59:59',
                        )
                    ))
                ),
                'sum'=>Referrals::model()->findAll(
                        array('select'=>'money','condition'=>'user_id = :user and date >= :date_start AND date <= :date_end AND status = "Подтвержден"',
                            'params'=>array(
                                ':user'=>Yii::app()->user->id,
                                ':date_start'=>$value->date.' 00.00.00',
                                ':date_end'=>$value->date.' 23.59.59',
                            )
                        )
                    )
            );
        }

        $this->render('index', array(
            'user'=>$user,
            'dataProvider'=>$dataProvider,
            'statistic'=>$statistic,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Registration for users
     */
    public function actionRegistration()
    {
        $this->layout = '/layouts/login';
        $model = new User('register');
        if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
        {
            echo CActiveForm::validate($model);
            $model->setScenario('ajax');
            Yii::app()->end();
        }
        if(isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];
            $user = User::model()->find('username=:username', array(':username' => $_POST['User']['username']));

            if (is_null($user)) {
                if($model->save())
                {
                    $this->regMail($model->username, 'Регистрация в партнерской программе', '<a class="text-center"  href="http://partner.alexpavlutskiy.com/user/user/login/language/index.html">Войти</a>');

                    $login=new LoginForm;
                    $login->username = $model->username;
                    $login->password = $model->password;
                    $login->login();

                    $profit = new Profit();
                    $profit->user_id = $model->id;
                    $profit->save();
                    
                    $identity=new UserIdentity($model->username, $model->password);
                    $identity->authenticate();

                    Yii::app()->user->login($identity,1);
                        $this->redirect('/user/user/index');  
                    
                }
            } else {
                $model->addError('username', 'Пользователь с таким электронным адресом уже зарегистрирован.' );
            }
                
        }
        else
        {
            $this->createAction('captcha')->getVerifyCode(true);
        }
        $this->render('registration', array('model'=>$model));
    }

    /**
     * Foget for users
     */
    public function actionFoget()
    {
        $this->layout = '/layouts/login';
        $model = new User('foget');
        if(isset($_POST['ajax']) && $_POST['ajax']==='foget-form')
        {
            echo CActiveForm::validate($model);
            $model->setScenario('ajax');
            Yii::app()->end();
        }
        if(isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];
            $pass = User::model()->find(array('select'=>'password','condition'=>'username = :user',
                    'params'=>array(
                        ':user'=>$model->username,
                    )
            ));
            $this->fogetMail($model->username, 'Восстановление пароля', $pass['password']);
            $this->redirect('/site/index');
        }
        else
        {
            $this->createAction('captcha')->getVerifyCode(true);
        }
        $this->render('foget', array('model'=>$model));
    }

    public function actionVerify()
    {
        $user = User::model()->find('verification = :verification', array(':verification'=>$_GET['verification']));
        if(isset($user))
        {
            $user->active = 1;
            $user->verification = uniqid();
            $user->password_2 = md5($user->password);
            $user->password = md5($user->password);
            if($user->save()) {
                $newProfitModel = new Profit();
                $newProfitModel->user_id = $user->id;
                $newProfitModel->save();
                Yii::app()->user->setFlash('success', Yii::t('main', 'Спасибо за регистрацию, Вы можете войти на сайт, используя указаные Вами данные при регистрации'));
            }
            else
                Yii::app()->user->setFlash('error', CHtml::errorSummary($user));
        }
        else
        {
            Yii::app()->user->setFlash('success',Yii::t('main', 'Такого пользователя не найдено, либо ссылка уже не активна'));
        }
        $this->redirect('/');
    }

    /**
     * Logs in user and redirect to reference page.
     */
    public function actionLogin()
    {
        $this->layout = '/layouts/login';
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

            if($model->validate()) {
                $identity=new UserIdentity($model->username, $model->password);
                $identity->authenticate();
                Yii::app()->user->login($identity,1);
                if ((Yii::app()->user->role) == 'admin') {
                    $this->redirect('/admin/referrals/index');
                } else {
                    $this->redirect('/user/user/index');
                }
            }

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

    public function actionPayRequest()
    {
        $model=new Stateds;
        if(isset($_POST['Stateds']))
        {
            $model->attributes=$_POST['Stateds'];
            if($model->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('pay', array('model'=>$model));
    }

    /**
     * @param $user
     * @param $subject
     * @param $link
     */
    public function setMail($user, $subject, $link)
    {
        // несколько получателей
        $to  = $user->username;
        // текст письма
        $message = '
            <h1>'.$subject.'</h1>
            <p style="text-align: center;">Здравствуйте, '.$user->name.'! Для '.$subject.', перейдите пожалуйста по нижеуказаной ссылке:</p>
            '.$link.'
        ';

        // Для отправки HTML-письма должен быть установлен заголовок Content-type
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Дополнительные заголовки
        $headers .= 'To: '.$user->name.' <'.$user->username.'>'. "\r\n";
        $headers .= 'From: Future <admin@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    /**
     * @param $user
     * @param $subject
     * @param $link
     */
    public function regMail($user, $subject, $link)
    {
        // несколько получателей
        $to  = $user;
        // текст письма
        $message = '
            <h1>'.$subject.'</h1>
            <p style="text-align: center;">Здравствуйте, '.$user.'! Вы успешно зарегестрировались, перейдите пожалуйста по нижеуказаной ссылке:</p>
            '.$link.'
        ';

        // Для отправки HTML-письма должен быть установлен заголовок Content-type
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        // Дополнительные заголовки
        $headers .= 'To: '.$user.' <'.$user.'>'. "\r\n";
        $headers .= 'From: Future <admin@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
    /**
     * @param $user
     * @param $subject
     * @param $link
     */
    public function fogetMail($user, $subject, $pass)
    {
        // несколько получателей
        $to  = $user;
        // текст письма
        $message = '
            <h1>'.$subject.'</h1>
            <p style="text-align: center;">Здравствуйте, '.$user.'! Ваш пароль от партнерской программы: '.$pass.'</p>
            ';

        // Для отправки HTML-письма должен быть установлен заголовок Content-type
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Дополнительные заголовки
        $headers .= 'To: '.$user.' <'.$user.'>'. "\r\n";
        $headers .= 'From: Future <admin@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
}