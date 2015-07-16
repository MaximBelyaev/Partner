<?php
class MyUserController extends Controller
{
    public $layout='/layouts/cabinet';
    public $user;
    public $news_to_watch;
    public $news;
    public $news_views;
    public $settingsList;
    public $landings;
    
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array(
                	'login', 'registration', 'captcha', 
                	'verify', 'foget'
                ),
                'users' => array('*'),// для всех
            ),
            array('allow',
                'actions' => array(
                	'index', 'range', 'logout', 
                	'file', 'commercial', 'data', 
                	'view', 'payRequest', 'changeOffer'
                ),
                'roles' => array('user'),// для авторизованных
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function init()
    {
		parent::init();

        if (Yii::app()->params->dbsetup !== "activated")
        {
            header('Location: /setup.php');
            exit();
        }

        if (Yii::app()->params->activation !== "activated")
        {
            header('Location: /activate.php');
            exit();
        }

        $this->user = User::model()->findByPk((int)Yii::app()->user->id);

        if(isset($this->user) && $this->user->unc_site) {
			# если файла на сервере нет, то появится ошибка 404
			# с помощью @ мы ее глушим
			if( @fopen($this->user->unc_site . '/prt_' . $this->user->id . ".txt", 'r') ) {
				# значит у пользователя есть доступ к сайту 
				# и он может в него положить файл
				$this->user->site 		= $this->user->unc_site;
				$this->user->unc_site 	= '';
				$this->user->save();
			}
		}

        if(!array_key_exists(Yii::app()->getLanguage(), Yii::app()->params['languages'])) {
            Yii::app()->setLanguage('ru');
            Yii::app()->user->setState('language', 'ru');
        }
        $news = News::model()->findAll();
        $news_views = NewsViews::model()->findAll('user_id = ' . (int)Yii::app()->user->id );
        
        $this->news_to_watch = count($news) - count($news_views);
        $this->news = $news;
        $this->news_views = $news_views;

        //Список настроек партнёра
        $this->settingsList = Setting::model()->findAll();
        for ($i = 0; $i < count($this->settingsList); $i++)
        {
            $this->settingsList[$this->settingsList[$i]->name] = $this->settingsList[$i];
            unset($this->settingsList[$i]);
        }


        Yii::app()->session['landing'] = (Yii::app()->session['landing'])?Yii::app()->session['landing']:0;
        $landings = Landings::model()->findAll();
        if (count($landings) > 1) {
            $lands = array( 0 => 'Все' );
            foreach ($landings as $l) {
                $lands[ $l->land_id ] = $l->name; 
            } 
            $this->landings = $lands;
        } else {
            $this->landings = false;
        }
    }
}