<?php

use yii\db\Migration;

class m190611_124815_i18n_ru_menu_dbmanager extends Migration
{

    public function up()
    {
        
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'dbmanager', 'label' => 'База данных', 'language' => 'ru']);

    }

}