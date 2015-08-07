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


        # подготовим информацию для кнопок с последними отрезками
        $times = array(
        	"now" => strtotime("now"),
            "last_week" => strtotime("-1 week"),
            "last_month" => strtotime("-1 month"),
            "last_quater" => strtotime("-3 month"),
            "last_year" => strtotime("-1 year"),
        );


		# статистика для отплаты за клик
		if ($user->use_click_pay) {
			$requests = Requests::model()->findAll(
				array(
					'select'	=> 'date',
					'condition'	=> 'partner_id = :user and click_pay = 1', 
					'params'	=> array(':user'=>$user->id), 
					'distinct'	=> true, 
					'order'		=> 'date DESC'
				)
			);

			$prevMonth = 0;
			$nextMonth = 1;
			$currentMonth = 0;
			$monthIndex = 0;
			foreach ($requests as $i => $value)
			{
				// Нужно для работы отношений
				$value->partner_id = $user->id;

				$currentMonth = date('m', strtotime($value->date));
				if (isset($requests[$i+1]->date)) {
					$nextMonth = date('m', strtotime($requests[$i+1]->date));
				} else {
					$nextMonth = $currentMonth+1;
				}

				// Если мы перешли на новый месяц
				if (($currentMonth != $prevMonth)) {
					// запишем статистику за прошлый месяц
					$statistic[$monthIndex]['month'] = Yii::app()->locale->getMonthName(
						(int)date("m",strtotime($value->date)), 
						"wide", 
						true
					) . " " . date("Y",strtotime($value->date));
				}

				$statistic[$monthIndex]['data'][] = array(
	                'date' => $value->date,
	                'followers' => count($value->getDayRequests(1)),
	                'profit' => $value->getDailyProfit(),
				);
                
                if ($currentMonth != $nextMonth) {
					$statistic[$monthIndex]['total'] = array(
						'total' => true,
						'requests' => count($value->getThisMonthRequests(1)),
						'total_profit' => $value->getThisMonthProfit(),
					);
					$monthIndex++;
				}
				$prevMonth = $currentMonth;
	        }
    	} else {
			$requests = Requests::model()->findAll(
				array(
					'select' => 'date',
					'condition' => 'partner_id = :user and click_pay = 0', 
					'params' => array(':user'=>$user->id), 
					'distinct' => true, 
					'order' => 'date DESC'
				)
			);
            
            $prevMonth = 0;
            $nextMonth = 1;
            $currentMonth = 0;
            $monthIndex = 0;
			foreach ($requests as $i => $value)
			{
				// Нужно для работы отношений
				$value->partner_id = $user->id;

				$currentMonth = date('m', strtotime($value->date));
				if (isset($requests[$i+1]->date)) {
					$nextMonth = date('m', strtotime($requests[$i+1]->date));
				} else {
					$nextMonth = $currentMonth+1;
				}

				// Если мы перешли на новый месяц
				if (($currentMonth != $prevMonth)) {
					// запишем статистику за прошлый месяц
					$statistic[$monthIndex]['month'] = Yii::app()->locale->getMonthName(
						(int)date("m",strtotime($value->date)), 
						"wide", 
						true
					) . " " . date("Y",strtotime($value->date));
				}

				$statistic[$monthIndex]['data'][] = array(
	                'date' => $value->date,
	                'followers' => count($value->getDayRequests(0)),
	                'profit' => $value->getDailyProfit(),

					'referrals' => count($value->getThisDayRefferals()),
					'payed' 	=> count($value->getThisDayPayedReferrals()),
					'sites' 	=> array_reduce($value->getThisDayPayedReferrals(), function($v, $m){ return ($v . '  ' . $m->site); }),
	                
				);
                
				if ( $currentMonth != $nextMonth ) {
					$statistic[$monthIndex]['total'] = array(
						'total' => true,
						'followers' => count($value->getThisMonthRequests(0)),
						'referrals' => count($value->getThisMonthReferrals(0)),
						'payed_referrals' => count($value->getThisMonthPayedReferrals()),
						'total_profit' => $value->getThisMonthProfit(),
					);
					$monthIndex++;
				}

				$prevMonth = $currentMonth;

	        }

    	}

        $this->render('index', array(
            'user'		=> $user,
            'statistic' => $statistic,
            'times'		=> $times,
        ));
    }

    public function actionFile()
    {
        header('Content-type: application/txt');//тут тип
        header('Content-Disposition: attachment; filename="prt_' . Yii::app()->user->id . '.txt"');//имя
        echo 'prt ' . Yii::app()->user->id;//файл
    }


    public function actionData()
    {
        $model = User::model()->findByPk(Yii::app()->user->id);

        $this->performAjaxValidation($model);
        
        if(isset($_POST['User']))
        {
            $model->old_site    = $model->site; 
            $model->attributes  = $_POST['User'];
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
        $this->render('data', array(
            'model'=>$model,
        ));
    }


    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
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
                    $this->redirect('/admin/default/index');
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

	public function actionCommercial()
	{
        if ( Yii::app()->session['landing'] ) {
            $condition = " land_id=" . (int)Yii::app()->session['landing'];
        } else {
            $condition = "";
        }
        $bannersList = Promobanns::model()->findAll( $condition );
        $promovideosList = Promovideo::model()->findAll( $condition );

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();

        /* скрипты для копирования текста из текстовых полей */
		$cs->registerScriptFile(
			$baseUrl . '/js/zeroclipboard-master/dist/ZeroClipboard.js', 
			CClientScript::POS_END
		);
		$cs->registerScript(
			'zrclpbrd', 
			"//ZeroClipboard.setMoviePath('" . $baseUrl . "/js/zeroclipboard-master/dist/ZeroClipboard.swf" . "');", 
			CClientScript::POS_END
		);
		$cs->registerScriptFile(
			$this->module->assetsUrl . '/js/commercial.js', 
			CClientScript::POS_END
		);
        
        $this->render('commercial', array(
        	'user' => $this->user,
            'bannersList' => $bannersList,
            'promovideosList' => $promovideosList
        ));
	}

    public function actionOffers ()
    {
        $landsList = Landings::model()->findAll(
            array('order' => 'sort_order ASC')
        );

        $usersLandsList = UsersLandings::model()->findAll(
            array('condition' => 'user_id=' . Yii::app()->user->id )
        );
        $ulands = array_map(function($ul){ return $ul->land_id; }, $usersLandsList);

        $offersList = [];
        foreach ($landsList as $key => $l) {
            $l->isOffer = (in_array($l->land_id, $ulands))?1:0;
        }

        $this->render('offers', array(
            'offersList' => $landsList,
        ));
    }

    public function actionOnOffer($id)
    {
        $sql = "INSERT INTO users_landings(land_id, user_id) VALUES (" . $id . ", " . Yii::app()->user->id . ")";
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $command->execute();
        $this->redirect(array('user/offers'));
    }

    public function actionOffOffer($id)
    {
        $sql = "DELETE FROM users_landings WHERE land_id = '" . $id . "' AND user_id = '" . Yii::app()->user->id . "'";
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $command->execute();
        $this->redirect(array('user/offers'));
    }


    public function actionChange() 
    {
        if (isset($_POST['land'])) {
            Yii::app()->session['landing'] = $_POST['land'];
            echo json_encode(array('status'=>'success'));
        } else {
            echo json_encode(array('status'=>'fail'));
        }
        Yii::app()->end();
    }


    public function actionPayRequest()
    {
        $model = new Stateds;
        $list  = new CActiveDataProvider( 'Stateds', array(
            'criteria'  => array(
                'condition' => 'user_id=' . Yii::app()->user->id
            ),
            'sort'      => array(
                'defaultOrder'  => 'date DESC',
                'attributes'    => array(
                    'username'  => array(
                        'asc'   => '`user`.`username`',
                        'desc'  => '`user`.`username` DESC',
                    ),
                    '*'
                ),
            )
        ));

        if(isset($_GET['Stateds'])){
            $list->attributes = $_GET['Stateds'];
        }

        $settings = [];
        foreach ($this->settingsList as $setting)
        {
            if ($setting->status === '1' and  $setting->type === 'pay_service')
            {
                $settings[$setting->header] = $setting->header;
            }
        }

        if(isset($_POST['Stateds']))
        {
            $model->attributes=$_POST['Stateds'];
            if($model->save()) {
                $this->redirect(array('user/payRequest'));
            }
        }
        $this->render('pay', array(
            'model'     => $model, 
            'settings'  => $settings, 
            'list'      => $list
        ));
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


	public function actionRange()
	{
		$user = $this->user;
		$get = $_GET;

		$chart = new Chart( Yii::app()->user->id );

		$requests  = $chart->getRangeRequestsData($get['start'], $get['end']);
		$referrals = $chart->getRangeReferralsData($get['start'], $get['end']);
		$payed = $chart->getRangeReferralsData($get['start'], $get['end'], 'payed');
			
		$charts = array(
			'requests'  => $requests, 
			'referrals' => $referrals,
			'payed'     => $payed, 
		);

		$stats = $chart->getRangeStat($get['start'], $get['end']);

		echo json_encode(array(
			'user'   => $user,
            'use_click_pay' => $user->use_click_pay,
			'get'    => $get,
			'stats'  => $stats,
			'charts' => $charts,
			'chart'  => $chart
		));
		Yii::app()->end();
	}
}