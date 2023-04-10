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
            'clients'       => 'c,r,u,d',
            'captains'      => 'c,r,u,d',
            'categories'    => 'c,r,u,d',
            'services'      => 'c,r,u,d',
            'car_types'     => 'c,r,u,d',
            'car_models'    => 'c,r,u,d',
            'products'      => 'c,r,u,d',
            'address_types' => 'c,r,u,d',
            'coupons'       => 'c,r,u,d',
            'orders'        => 'r',
            'questions'     => 'c,r,u,d',
            'wash_requests' => 'r',
            'settings'      => 'r,u',
            'reports'       => 'r'
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
    ]


];
