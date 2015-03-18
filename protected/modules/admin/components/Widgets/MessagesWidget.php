<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 08.11.14
 * Time: 19:15
 */
class MessagesWidget extends CWidget
{
    public function init(){}
    public function run()
    {
        $this->render('messages');
    }
}