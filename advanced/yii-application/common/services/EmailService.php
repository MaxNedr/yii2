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
     * @param $viewHTML
     * @param $viewText
     * @param $data
     */
    function send($to, $subject, $viewHTML, $viewText, $data)
    {
        \Yii::$app
            ->mailer
            ->compose(['html' => $viewHTML, 'text' => $viewText], $data)
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
            ->setTo($to)
            ->setSubject($subject)
            ->send();
    }

}