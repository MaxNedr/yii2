<?php
namespace console\controllers;


use yii\console\ExitCode;
use yii\console\Controller;

/**
 * Class TestController
 * @package console\controllers
 */
class TestController extends Controller
{

    public function actionIndex()
    {
        $this->stdout("Hello, world!".PHP_EOL);
        return ExitCode::OK;
    }


}
