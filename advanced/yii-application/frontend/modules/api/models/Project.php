<?php

namespace frontend\modules\api\models;


class Project extends \common\models\Project
{


    public function fields()
    {
        return [
            'id',
            'title',
            'description_short' => function ($model) {
                return substr($model->description, 0, 50);
            },
            'active'
        ];
    }

    public function extrafields()
    {
        return [self::RELATION_TASKS];
    }


}