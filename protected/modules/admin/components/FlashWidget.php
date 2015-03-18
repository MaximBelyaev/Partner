<?php
class FlashWidget extends CWidget
{

    public $params = array(
        'model' => null,
        'form' => null,
    );

    public function init(){}
    public function run()
    {
        $this->render('flash',array(
            'model'=>$this->params['model'],
            'form'=>$this->params['form'],
        ));
    }
}