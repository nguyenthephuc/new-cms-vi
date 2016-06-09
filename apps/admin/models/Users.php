<?php

class Users extends ActiveRecord\Model{

    public static function mapping()
    {
        $params = Response::request();
        unset($params['_url']);
        if(isset($params['id'])) $params['id'] = Response::filter($params['id'], 'int');
        if(isset($params['name'])) $params['name'] = Response::filter($params['name'], 'string');
        if(isset($params['username'])) $params['username'] = Response::filter($params['username'], 'string');
        if(isset($params['password'])) $params['password'] = Response::filter($params['password'], 'string');
        return $params;
    }

    public static function authenLogin($username, $password)
    {
        if(empty($username) || empty($password)){
            return false;
        }else{
            $user = self::find('first', array('username' => $username));
            if(!$user){
                return false;
            }else{
                $pass_on_db = $user->password;
                if(!Password::validate_password($password, $pass_on_db)){
                    return false;
                }else{
                    return $user;
                }
            }
        }
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

    public static function insertCheckExistUser($username)
    {
        if(empty($username)) return false;
        $user = self::find('first', array('username' => $username));
        return (!empty($user)) ? true : false;
    }

    public static function updateCheckExistUser($username, $id)
    {
        if(empty($username) || empty($id)) return false;
        $flag = self::exists( array( 'conditions' => array( 'username = ? AND id <> ?', $username, $id ) ) );
        return $flag;
    }
}