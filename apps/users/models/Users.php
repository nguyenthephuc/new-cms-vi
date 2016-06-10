<?php

class Users extends ActiveRecord\Model {

    static $table_name = 'users';

    public static function mapping()
    {
        $params = Response::request();
        unset($params['_url']);
        if(isset($params['id'])) $params['id'] = Response::filter($params['id'], 'int');
        if(isset($params['username'])) $params['username'] = Response::filter($params['username'], 'string');
        if(isset($params['password'])) $params['password'] = Response::filter($params['password'], 'string');
        if(isset($params['name'])) $params['name'] = Response::filter($params['name'], 'string');
        if(isset($params['level'])) $params['level'] = Response::filter($params['level'], 'int');
        return $params;
    }
}