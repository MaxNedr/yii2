<?php
namespace backend\controllers;



use yii\web\Controller;

/**
 * Test controller
 */
class TestController extends Controller
{


    public function actionIndex()
    {
        return $this->renderContent('Hello, world');
    }


}
