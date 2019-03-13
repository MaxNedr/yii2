<?php

namespace common\models\query;

use common\models\Project;
use common\models\ProjectUser;

/**
 * This is the ActiveQuery class for [[\common\models\Project]].
 *
 * @see \common\models\Project
 */
class ProjectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Project[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Project|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $userId
     * @return ProjectQuery
     */
    public function byUser($userId)
    {
        $query = ProjectUser::find()->select('project_id')->byUser($userId);
        return $this->andWhere(['id' => $query]);
    }

}
