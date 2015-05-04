<?php
class MyUserController extends Controller
{
    public $layout='/layouts/cabinet';
    public $user;
    public $news_to_watch;
    public $news;
    public $news_views;
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
                'actions' => array('login', 'registration', 'captcha', 'verify', 'foget'),
                'users' => array('*'),// для всех
            ),
            array('allow',
                'actions' => array('index', 'range', 'logout', 'commercial', 'data', 'view', 'payRequest'),
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
        $this->user = User::model()->findByPk((int)Yii::app()->user->id);
        

        if(!array_key_exists(Yii::app()->getLanguage(), Yii::app()->params['languages'])) {
            Yii::app()->setLanguage('ru');
            Yii::app()->user->setState('language', 'ru');
        }
        $news = News::model()->findAll();
        $news_views = NewsViews::model()->findAll('user_id = ' . (int)Yii::app()->user->id );
        
        $this->news_to_watch = count($news) - count($news_views);
        $this->news = $news;
        $this->news_views = $news_views;     
    }
}