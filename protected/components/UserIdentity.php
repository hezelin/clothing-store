<?php


class UserIdentity extends CUserIdentity
{

    private $id;
	public function authenticate()
	{
        $record=TblUser::model()->findByAttributes(array('name'=>$this->username));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==md5($record->salt.$this->password.$record->salt))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->id=$record->uid;
            $this->setState('roles', $record->roles);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
	}

    public function getId(){
        return $this->id;
    }
}