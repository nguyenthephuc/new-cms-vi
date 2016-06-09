<?php
class Language {

    public static function line($keyword, $lang = null)
    {
        if(empty($keyword)) return false;
        $lang = ($lang) ? $lang : 'vi';
        $file = LANGUAGE.$lang.'.php';
        if(file_exists($file)){
            require_once $file;
            return (isset($message[$keyword]) && $message[$keyword]) ? $message[$keyword] : '';
        }
        return false;
    }
}