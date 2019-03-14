<?php

namespace common\models\query;

use common\models\User;


/**
 * Class UserQuery
 * @package common\models\query
 */
class UserQuery extends \yii\db\ActiveQuery
{
    public function onlyActive(){

            return $this->andWhere(['status' => User::STATUS_ACTIVE]);
        }
        /**
         * {@inheritdoc}
         * @return \common\models\User[]|array
         */
        public function all($db = null) {
            return parent::all($db);
        }
        /**
         * {@inheritdoc}
         * @return \common\models\User|array|null
         */
        public function one($db = null) {
            return parent::one($db);
        }

}
