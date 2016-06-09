<?php

return array(
    # to see error of system, set debug => true
    # when deploy to production please set debug => false
    'debug'    => true,
    # define module 'module-name' => path to module
    'modules' => array(
        'admin' => APP_PATH.'admin',
        'users' => APP_PATH.'users',
        ),
    # database infomation
    'db' => array(
            'host'     => 'localhost',
            'dbname'   => 'dbnewcms',
            'username' => 'root',
            'password' => '',
        )
);