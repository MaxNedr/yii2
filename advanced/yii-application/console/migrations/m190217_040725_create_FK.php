<?php

use yii\db\Migration;

/**
 * Class m190217_040725_create_FK
 */
class m190217_040725_create_FK extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addForeignKey('fx_task_user_1', 'task', ['executor_id'], 'user', ['id']);
        $this->addForeignKey('fx_task_user_2', 'task', ['creator_id'], 'user', ['id']);
        $this->addForeignKey('fx_task_user_3', 'task', ['updater_id'], 'user', ['id']);
        $this->addForeignKey('fx_project_user_1', 'project', ['creator_id'], 'user', ['id']);
        $this->addForeignKey('fx_project_user_2', 'project', ['updater_id'], 'user', ['id']);
        $this->addForeignKey('fx_project-user_user', 'project_user', ['user_id'], 'user', ['id']);
        $this->addForeignKey('fx_project-user_project', 'project_user', ['project_id'], 'project', ['id']);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fx_task_user_1', 'task');
        $this->dropForeignKey('fx_task_user_2', 'task');
        $this->dropForeignKey('fx_task_user_3', 'task');
        $this->dropForeignKey('fx_project_user_1', 'project');
        $this->dropForeignKey('fx_project_user_2', 'project');
        $this->dropForeignKey('fx_project-user_user', 'project_user');
        $this->dropForeignKey('fx_project-user_project', 'project_user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190217_040725_create_FK cannot be reverted.\n";

        return false;
    }
    */
}
