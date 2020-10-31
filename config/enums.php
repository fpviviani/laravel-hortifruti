<?php

return [
    'roles' =>
    [
        'SUPER_ADMIN'     => ['id' => 1, 'name' => 'super_admin',     'display_name' =>  'Super Administrador',     'guard_name' => 'web'],
        'ADMIN'           => ['id' => 2, 'name' => 'admin',           'display_name' =>  'Administrador',           'guard_name' => 'web'],
    ],

    'status_users' =>
    [
        'ACTIVE'     => ['id' => 1,    'name' => 'Ativo',     'description' => 'Usuários com acesso normal ao sistema.'],
        'INACTIVE'   => ['id' => 2,    'name' => 'Inativo',   'description' => 'Usuários impedidos de realizar qualquer ação no sistema.'],
    ],
];
