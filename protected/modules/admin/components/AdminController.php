<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='/layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    public $notifications_count;
    public $newUser;
    public $newReferral;

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
                'actions' => array('login'),
                'users' => array('*'),// для всех
            ),
            array('allow',
                'actions' => array(
                    'view', 'create', 'update', 
                    'delete', 'index', 'logout',
                    'admin', 'upload', 'ajaxUpload',
                    'imageGetJson', 'imageUpload',
                    'clipboardUploadUrl', 'fileUpload', "connector",
                ),
                'roles' => array('admin'),// для авторизованных
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function init() {
        parent::init();

        $model = new Referrals;
        $this->newReferral = $model;
        $model = new User;
        $this->newUser = $model;
        Yii::app()->onBeginRequest = array('AdminController', 'r');

        if(!array_key_exists(Yii::app()->getLanguage(), Yii::app()->params['languages']))
        {
            Yii::app()->setLanguage('ru');
            Yii::app()->user->setState('language', 'ru');
        }
        $this->notifications_count = Notifications::model()->count("is_new = 1");
	}

}