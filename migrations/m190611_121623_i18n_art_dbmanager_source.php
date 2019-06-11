<?php

use artsoft\db\SourceMessagesMigration;

class m190611_121623_i18n_art_dbmanager_source extends SourceMessagesMigration
{

    public function getCategory()
    {
        return 'art/dbmanager';
    }

    public function getMessages()
    {
        return [
            'DB Manager' => 1,            
            'Create Dump' => 1,            
            'Create time' => 1,            
            'Download' => 1,            
            'Size' => 1,            
            'Import' => 1,            
            'Delete All Dump' => 1,            
            'Directory is not writable.' => 1,            
            'No database connection.' => 1,            
            'The specified path does not exist.' => 1,            
            'The path must be a folder.' => 1,            
            'The database dump removed.' => 1,            
            'All database entries will be deleted. Are you sure?' => 1,            
            'All database entries will be overwritten. Are you sure?' => 1,            
            'The database dump will be deleted. Are you sure?' => 1,            
            'Dump {path} successfully imported.' => 1,            
            'File {fileName} in the {path} folder.' => 1,   
            'All dumps successfully removed.' => 1,
            'Error deleting dumps.' => 1,
        ];
    }
}