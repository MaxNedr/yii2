<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.03.2019
 * Time: 15:03
 */

namespace common\services;


use yii\base\Component;

class EmailService extends Component
{
    /**
     * @param $to
     * @param $subject
     * @param $views
     * @param $data
     */
    function send($to, $subject, $views, $data )
    {
         \Yii::$app
            ->mailer
            ->compose($views, $data)
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
            ->setTo($to)
            ->setSubject($subject)
            ->send();
    }

}