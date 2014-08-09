<?php

class ItemController extends Controller
{

    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

	public function actionAdmin()
	{
        $model=new ViewProductItem('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['ViewProductItem']))
            $model->attributes=$_GET['ViewProductItem'];

        $this->render('admin',array(
            'model'=>$model,
        ));
	}

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ViewProductItem']))
        {
            $model->attributes=$_POST['ViewProductItem'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->item_id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function loadModel($id)
    {
        $model=ViewProductItem::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}