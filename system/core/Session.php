<?php
class Session {

    public static function set($key, $value)
    {
        if(empty($key) || empty($value)) return false;
        $key = sha1($key);
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if(empty($key)) return false;
        $key = sha1($key);
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : '';
    }

    public static function has($key)
    {
        if(empty($key)) return false;
        $key = sha1($key);
        if(isset($_SESSION[$key])){
            return true;
        }
        return false;
    }

    public static function remove($key)
    {
        if(empty($key)) return false;
        $key = sha1($key);
        unset($_SESSION[$key]);
    }

    public static function removeAll()
    {
        @session_destroy();
    }
}