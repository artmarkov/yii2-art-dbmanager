<?php

use artsoft\db\PermissionsMigration;

class m190611_121414_add_dbmanager_permissions extends PermissionsMigration
{

    public function beforeUp()
    {
        $this->addPermissionsGroup('dbManagement', 'Db Management');
    }

    public function afterDown()
    {
        $this->deletePermissionsGroup('dbManagement');
    }

    public function getPermissions()
    {
        return [
            'dbManagement' => [
                'links' => [
                    '/admin/dbmanager/*',
                    '/admin/dbmanager/default/*',
                ],
                'viewDb' => [
                    'title' => 'View Db',
                    'links' => [
                        '/admin/dbmanager/default/index',
                        '/admin/dbmanager/default/grid-page-size',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                ],
                'downloadDb' => [
                    'title' => 'Download Db',
                    'links' => [
                        '/admin/dbmanager/default/download',  
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewDb',
                    ],
                ],
                'exportDb' => [
                    'title' => 'Export Db',
                    'links' => [
                        '/admin/dbmanager/default/export',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewDb',
                    ],
                ],
                'importDb' => [
                    'title' => 'Import Db',
                    'links' => [
                        '/admin/dbmanager/default/import',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewDb',
                    ],
                ],
                'deleteDb' => [
                    'title' => 'Delete Db',
                    'links' => [
                        '/admin/dbmanager/default/delete',
                        '/admin/dbmanager/default/delete-all',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewDb',
                    ],
                ],                          
            ],
        ];
    }

}
