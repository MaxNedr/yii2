<?php

namespace frontend\modules\api\controllers;


use frontend\modules\api\models\Task;
use yii\rest\Controller;
use yii\data\ActiveDataProvider;


/**
 * Default controller for the `api` module
 */
class TaskController extends Controller
{

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Task::find(),
        ]);
    }
    public function actionView($id)
    {
        return Task::findOne($id);
    }

}
