<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadmin' => [
            'roles'         => 'c,r,u,d',
            'cities'        => 'c,r,u,d',
            'admins'        => 'c,r,u,d',
            'clients'       => 'c,r,u,d'
        ],
        'admin' => [],
        'client' => [],
        'captain' => []
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ],

    //translate

    'models_arabic' => [
        'roles'   => 'الصلاحيات',
        'cities'  => 'المحافظات',
        'admins'  => 'المشرفين',
        'clients' => 'العملاء'
    ],

    'permissions_map_arabic' => [
        'c' => 'إنشاء',
        'r' => 'قراءة',
        'u' => 'تحديث',
        'd' => 'حذف'
    ],


];
