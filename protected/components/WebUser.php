<?php
class WebUser extends CWebUser {
    private $_model = null;

    function getRole() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->role;
        }
        else
            return false;
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }

    public function getIsAdmin()
    {
        if(User::model()->findByPk($this->id, array('select' => 'role'))->role == 'admin')
            return true;
        else
            return false;
    }
}