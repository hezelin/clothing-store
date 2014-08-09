<?php

class ReturnController extends Controller
{
	public function actionAdmin()
	{

        $model=new ViewItemReturn('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['ViewItemReturn']))
            $model->attributes=$_GET['ViewItemReturn'];

        $this->render('admin',array(
            'model'=>$model,
        ));
	}

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['TblFactory']))
        {
            $model->attributes=$_POST['TblFactory'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    public function actionDelete($id)
    {
        TblProductReturn::model()->findByPk($id)->delete();
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function loadModel($id)
    {
        $model=ViewItemReturn::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}