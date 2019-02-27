<?php

namespace common\modules\chat\controllers;

use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use yii\console\Controller;
use Ratchet\Server\IoServer;
use common\modules\chat\components\Chat;

/**
 * Default controller for the `chat` module
 */
class DefaultController extends Controller
{


    public function actionIndex()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            8080
        );
        echo 'server start';
       /* $server->loop->addPeriodicTimer(60, function () {
            echo date('H:i:s' . PHP_EOL);
        });*/

        $server->run();
        echo 'server stop';
    }
}
