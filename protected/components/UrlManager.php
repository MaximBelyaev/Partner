<?php
class UrlManager extends CUrlManager
{
    /*
    public function createUrl($route,$params=array(),$ampersand='&')
    {
        if (!isset($params['language'])) {
            if (Yii::app()->user->hasState('language')){
                $l = Yii::app()->user->getState('language');
                if (array_key_exists($l, Yii::app()->params['languages'])) {
                    Yii::app()->language = $l;
                } else {
                    Yii::app()->language = 'ru';
                }
            }
            else if(isset(Yii::app()->request->cookies['language'])) {
                $l = Yii::app()->request->cookies['language']->value;
                if (array_key_exists($l, Yii::app()->params['languages'])) {
                    Yii::app()->language = $l;
                } else {
                    Yii::app()->language = 'ru';
                }
            }
            $params['language']=Yii::app()->language;
        }
        return parent::createUrl($route, $params, $ampersand);
    }
    */
}