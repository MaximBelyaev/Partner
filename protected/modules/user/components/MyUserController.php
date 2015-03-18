<?php
class MyUserController extends Controller
{
    public $layout='/layouts/cabinet';
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
                'actions' => array('index', 'logout', 'payRequest'),
                'roles' => array('user'),// для авторизованных
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
}