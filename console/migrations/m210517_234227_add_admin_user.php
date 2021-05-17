<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m210517_234227_add_admin_user
 */
class m210517_234227_add_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->username = "admin";
        $user->email = "admin@sforzando-fund.com";
        $user->setPassword("password4s4zando");
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = User::STATUS_ACTIVE;
        return $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210517_234227_add_admin_user cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210517_234227_add_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
