<?php

namespace frontend\modules\api\models;


class Task extends \common\models\Task
{
    public function fields()
    {
        return [
            'id',
            'title',
            'description_short' => function ($model) {
                return substr($model->description, 0, 50);
            },
        ];
    }

    public function extrafields()
    {
        return [self::RELATION_PROJECT];
    }


}