<?php
class MyUserController extends Controller
{
    public $layout = '/layouts/cabinet';
    public $user;
    public $news_to_watch;
    public $news;
    public $news_views;
    public $settingsList;
    public $payServices;
    public $landings;
    public $landingsAR;
    public $offers;
    public $land_id = 0;
    public $landingsList;
    
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
                	'view', 'payRequest', 'offers',
                    'onOffer', 'offOffer', 'changeOffer', 'change',
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

		//Список настроек партнёра
		$this->settingsList = Setting::model()->findAll();
		for ($i = 0; $i < count($this->settingsList); $i++)
		{
			$this->settingsList[$this->settingsList[$i]->name] = $this->settingsList[$i];
			if ( $this->settingsList[$i]->type == 'pay_service' ) {
				$this->payServices[$this->settingsList[$i]->name] = $this->settingsList[$i]->header;
			}
			unset($this->settingsList[$i]);
		}

		/* выбранный пользователь лендинг, статистику которого он видит */
		Yii::app()->session['landing'] = (Yii::app()->session['landing'])?Yii::app()->session['landing']:0;
		$this->land_id = (int)Yii::app()->session['landing'];

		/* список всех лендингов */
		$this->landingsAR = Landings::model()->findAll();
		$relations = UsersLandings::model()->findAll(
			array(
				'condition' => 'user_id = :user_id',
				'params' => array(':user_id'=>Yii::app()->user->id),
			));
		$userRelations = [];

        foreach ($relations as $relation)
        {
            $userRelations[$relation->land_id] = $relation->user_id;
        }


        if (count($this->landingsAR) > 0)
        {
            $this->landings = array( 0 => 'Все' );
            foreach ($this->landingsAR as $l)
			{
                if ( array_key_exists($l->land_id, $userRelations) ) {
                    $this->landings[ $l->land_id ] = $l->name;
                    $this->offers[ $l->land_id ] = $l;
                }
            }
		}
        else
		{
			$this->landings = false;
		}
        $this->landingsList = $this->landings;
        unset($this->landingsList[0]);

        $this->prepareNews();
	}


	/* записываем новости, кол-во непросмотренных новостей */
	protected function prepareNews()
    {
		if ($this->land_id > 0) {
			
			$news = News::model()->findAll('land_id = ' . (int)$this->land_id);
			$news_views = NewsViews::model()
				->with(array(
					'news' => array(
						'select' => '*',
						'joinType'=>'LEFT JOIN',
						'condition' => 'news.land_id = ' . (int)$this->land_id,
					)
				))
				->findAll('user_id = ' . (int)Yii::app()->user->id );
                
			$this->news_to_watch = count($news) - count($news_views);
			$this->news = $news;
			$this->news_views = $news_views;

		} else {
			$landings = $this->landings;
            if ($landings)
            {
                $lands_str = implode(',', array_keys($landings));
                $news = News::model()->findAll('land_id IN (' . $lands_str . ')');
                $news_views = NewsViews::model()
                    ->with(array(
                        'news' => array(
                            'select' => '*',
                            'joinType'=>'LEFT JOIN',
                            'condition' => 'news.land_id IN (' . $lands_str . ')',
                        )
                    ))
                    ->findAll('user_id = ' . (int)Yii::app()->user->id );

                $this->news_to_watch = count($news) - count($news_views);
                $this->news = $news;
                $this->news_views = $news_views;
            }
		}
	}

}