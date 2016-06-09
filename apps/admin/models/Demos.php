<?php

class Demos extends ActiveRecord\Model{

    public static function mapping()
    {
        $params = Response::request();
        unset($params['_url']);
        if(isset($params['id'])) $params['id'] = Response::filter($params['id'], 'int');
        if(isset($params['title'])) $params['title'] = Response::filter($params['title'], 'string');
        if(isset($params['content'])) $params['content'] = Response::filter($params['content']);
        if(isset($params['public'])) $params['public'] = Response::filter($params['public'], 'string');
        return $params;
    }

    public static function updated($id, $params)
    {
        if(!$id || !$params) return false;
        $user = self::find($id);
        $user->update_attributes($params);
    }

    public static function trash($id)
    {
        if(!$id) return false;
        $user = self::find($id);
        $user->delete();
    }
}