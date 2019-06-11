<?php

use artsoft\db\TranslatedMessagesMigration;

class m190611_124618_i18n_ru_art_dbmanager extends TranslatedMessagesMigration
{

    public function getLanguage()
    {
        return 'ru';
    }

    public function getCategory()
    {
        return 'art/dbmanager';
    }

    public function getTranslations()
    {
        return [
            'DB Manager' => 'Менеджер БД',            
            'Create Dump' => 'Создать Дамп',            
            'Create time' => 'Время создания',            
            'Download' => 'Загрузить',            
            'Size' => 'Размер',            
            'Import' => 'Импорт',            
            'Delete All Dump' => 'Удалить Все Дампы',            
            'Directory is not writable.' => 'Дирректория не доступна для записи.',            
            'No database connection.' => 'Нет подключения к базе данных.',            
            'The specified path does not exist.' => 'Указанный путь не существует.',            
            'The path must be a folder.' => 'Путь должен быть папкой.',            
            'The database dump removed.' => 'Дамп БД удален.',            
            'All database entries will be deleted. Are you sure?' => 'Все записи базы данных будут удалены. Вы уверены?',            
            'All database entries will be overwritten. Are you sure?' => 'Все записи базы данных будут перезаписаны. Вы уверены?',            
            'The database dump will be deleted. Are you sure?' => 'Дамп базы данных будет удален. Вы уверены?',            
            'Dump {path} successfully imported.' => 'Дамп {path} успешно импортирован.',            
            'Export completed successfully. File {fileName} in the {path} folder.' => 'Экспорт успешно завершен. Файл {fileName} в папке {path}.',   
            'All dumps successfully removed.' => 'Все дампы успешно удалены.',
            'Error deleting dumps.' => 'Ошибка удаления дампов.',
            ];
        
    }
}