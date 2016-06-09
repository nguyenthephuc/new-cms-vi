<?php
/**
* @author The Phuc
* @since  2016-03-11
*/
ini_set('display_errors', 1);
error_reporting(E_ALL);
try{
    defined('APP_PATH')         || define('APP_PATH',         dirname( __DIR__)."/apps/");
    defined('TEMPLATE_LAYOUT')  || define('TEMPLATE_LAYOUT',  APP_PATH."common/layout/");
    defined('TEMPLATE_PARTIAL') || define('TEMPLATE_PARTIAL', APP_PATH."common/partial/");
    defined('LIBRARY')          || define('LIBRARY',          APP_PATH."librarys/");
    defined('WIDGET')           || define('WIDGET',           APP_PATH."widgets/");
    defined('LANGUAGE')         || define('LANGUAGE',         APP_PATH."language/");
    defined('PUBLIC_PATH')      || define('PUBLIC_PATH',      dirname( __DIR__)."/public/");
    defined('STATIC_PATH')      || define('STATIC_PATH',      dirname( __DIR__)."/static/");
    defined('CORE')             || define('CORE',             dirname( __DIR__)."/system/core/");
    defined('VENDOR')           || define('VENDOR',           dirname( __DIR__)."/vendor/");
    /** Config */
    $config = require APP_PATH."configs/config.php";
    /** load ActiveRecord */
    require dirname( __DIR__)."/system/orm/".'ActiveRecord.php';
    ActiveRecord\Config::initialize(function($cfg)
    {
        global $config;
        $cfg->set_connections(array(
            'development' => 'mysql://'.$config['db']['username'].':'.$config['db']['password'].'@'.$config['db']['host'].'/'.$config['db']['dbname'].';charset=utf8'
        ));
    });
    /** Core */
    require dirname( __DIR__)."/system/".'Application.php';
    /** Minify html */
    function sanitize_output($buffer){
        $search = array(
            '/\>[^\S ]+/s',
            '/[^\S ]+\</s',
            '/(\s)+/s'
            );
        $replace = array(
            '>',
            '<',
            '\\1'
            );
      $buffer = preg_replace($search, $replace, $buffer);
        return $buffer;
    }
    ob_start("sanitize_output");
    /** run application */
    App::vendor(true);
    App::removeExtraSlashes(true);
    require APP_PATH."configs/route.php";
    App::existPage();
}
catch (Exception $e){
    echo 'Message: ' .$e->getMessage();
}catch (PDOException $e){
    echo 'Message: ' .$e->getMessage();
}