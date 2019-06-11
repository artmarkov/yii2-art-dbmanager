<?php

use yii\db\Migration;

class m190611_120054_add_dbmanager_menu_links extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link}}', ['id' => 'dbmanager', 'menu_id' => 'admin-menu', 'link' => '/dbmanager/default/index', 'created_by' => 1, 'order' => 1]);        
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'dbmanager', 'label' => 'Dbmanager', 'language' => 'en-US']);
        
    }

    public function down()
    {
        $this->delete('{{%menu_link}}', ['like', 'id', 'dbmanager']);
    }
}