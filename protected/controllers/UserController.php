<?php

class UserController extends Controller
{
    public $layout = '/layouts/main';
	public function actionCheck()
	{
		$this->render('check');
	}

	public function actionAdd()
	{
//        add 场景，用户名唯一性验证
        $model = new TblUser('add');
        if(isset($_POST['TblUser']))
        {
            $model->salt = $this->getSalt();
            $model->attributes=$_POST['TblUser'];
            $model->password = md5($model->salt.$_POST['TblUser']['password'].$model->salt);

            if($model->save()){
                $this->userLog(Yii::app()->user->id,'创建用户 '.$model->name);
                $this->redirect( Yii::app()->createUrl('user/addSuccess',array('id'=>$model->uid,'pswd'=>$_POST['TblUser']['password'])) );

            }
        }
		$this->render('add',array('model'=>$model));
	}

    public function actionAddSuccess()
    {
        $model = TblUser::model()->findByPk($_GET['id']);
        $model->password = $_GET['pswd'];
        $this->render('addSuccess',array('model'=>$model));
    }

    public function actionUpdateSuccess()
    {
        $model = TblUser::model()->findByPk($_GET['id']);
        $model->password = $_GET['pswd'];
        $this->render('updateSuccess',array('model'=>$model));
    }

	public function actionIndex()
	{
        $this->userLog(Yii::app()->user->id,'写入测试日志');
        Yii::app()->end();
		$this->render('index');
	}

    public function actionUpdate($id)
    {
        $model = TblUser::model()->findByPk($id);

        if(isset($_POST['TblUser']))
        {
            $model->attributes=$_POST['TblUser'];
            if( strlen( $_POST['TblUser']['password'] ) != 32 && $_POST['TblUser']['password']){
                $model->password = md5($model->salt.$_POST['TblUser']['password'].$model->salt);
            }
            if($model->save()){
                $this->userLog(Yii::app()->user->id,'修改用户 '.$model->name.' 资料');
                $this->redirect( Yii::app()->createUrl('user/updateSuccess',array('id'=>$model->uid,'pswd'=>$_POST['TblUser']['password'])) );
            }
        }

        $this->render('update',array('model'=>$model));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('list'));
    }

    public function actionList()
    {
        $model=new TblUser('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['TblUser']))
            $model->attributes=$_GET['TblUser'];
        $this->render('list',array('model'=>$model));
    }

    public function actionLogin()
    {
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function loadModel($id)
    {
        $model=TblUser::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }


    public function actionLog()
    {
        $dataProvider=new CActiveDataProvider('ViewUserLog');
        $this->render('log',array('dataProvider'=>$dataProvider));

        /*$model=new ViewUserLog('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['ViewUserLog']))
            $model->attributes=$_GET['ViewUserLog'];
        $this->render('log',array('model'=>$model));*/
    }

    public function userLog($uid,$msg)
    {
        $model = new TblUserLog;
        $model->uid = $uid;
        $model->log = $msg;
        $model->save();
    }

    private function getSalt($len=8){
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $salt = '';
        for($i=0;$i<$len;$i++){
            $salt .= $str[mt_rand(0,61)];
        }
        return $salt;
    }
}