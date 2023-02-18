<?php

use yii\db\Migration;

/**
 * Class m230215_112935_user_car
 */
class m230215_112935_user_car extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('usercar', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'car_id' => $this->integer()->notNull(),

        ]);

        $this->addForeignKey('fk_usercar_user', 'usercar', 'user_id', 'user', 'id');
        $this->addForeignKey('fk_usercar_car', 'usercar', 'car_id', 'car', 'id');



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('usercar');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230215_112935_user_car cannot be reverted.\n";

        return false;
    }
    */
}
