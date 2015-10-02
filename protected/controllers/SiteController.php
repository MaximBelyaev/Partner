<?php

class SiteController extends Controller
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
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index2.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        //$this->redirect('/user/user/index');
		//$this->render('index');
		if (Yii::app()->params->dbsetup !== "activated")
		{
			header('Location: /setup.php');
			exit();
		}

		$offers = Offers::model()->findAll();
		$registerForm = new User('register');
		$loginForm = new LoginForm();
    	$this->renderPartial('index', array(
			'offers' => $offers,
            'model' => $loginForm,
            'register' => $registerForm,
        ));
	}

	public function actionPreview()
	{
		$config = json_decode(file_get_contents('preview.json'));
		$configArr = (array) $config;
		$displayVars = [];
		foreach ($configArr as $key => $value)
		{
			if (stristr($key, 'displayvar'))
			{
				$displayVars[] = $key;
			}
		}

		if ($_POST)
		{
			foreach ($_POST as $k => $v)
			{
				if (stristr($k, 'textvar') || stristr($k, 'colorbgvar') || stristr($k, 'valuevar'))
				{
					$config->$k = $v;
				}
				foreach ($displayVars as $var)
				{
					$config->$var = 'none';
					if (isset($_POST[$var]))
					{
						$config->$var = '';
					}
				}
			}

			if ($_FILES)
			{
				$uploaddir = './img/';
				foreach($_FILES as $k => $file)
				{
					if (move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
					{
						$value = substr($uploaddir, 1);
						$value = $value .$file['name'];
						if (is_file(substr($config->$k, 1)))
						{
							unlink(substr($config->$k, 1));
						}
						$config->$k = $value;
					}
				}
			}

			$config = json_encode($config, JSON_UNESCAPED_UNICODE);
			$fp = fopen('preview.json', 'w');
			fwrite($fp, $config);
			fclose($fp);
		}

		$offers = Offers::model()->findAll();
		$registerForm = new User('register');
		$loginForm = new LoginForm();
		$this->renderPartial('preview', array(
			'offers' => $offers,
			'model' => $loginForm,
			'register' => $registerForm,
		));
	}

	public function actionCreatePreviewConfig ()
	{
		echo json_encode(array('post' => $_POST));
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if ($error=Yii::app()->errorHandler->error)
		{
			if (Yii::app()->request->isAjaxRequest)
            {
				echo $error['message'];
			}
            else
            {
				$this->render('error', $error);
			}
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

    public function actionComplete()
    {
        $model=new Referrals;
        $this->performAjaxValidation($model);

        if(isset($_POST['Referrals']))
        {
            $model->attributes=$_POST['Referrals'];
            if(isset($_GET['ref']))
                $model->user_id = (int) $_GET['ref'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('complete', array('model'=>$model));
    }

    /**
     * Performs the AJAX validation.
     * @param Referrals $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='referrals-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}