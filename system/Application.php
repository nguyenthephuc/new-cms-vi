<?php
/**
* @author The Phuc
* @since  2016-03-11
*/

class App {

    private static $_url;
    private static $_module;
    private static $_removeExtraSlashes = false;
    private static $_checkRoute = true;

    public static function Route($route, $func = null)
    {
        @session_start();
        /** load core view */
        self::uses('view');
        /** get url */
        self::$_url = (isset($_GET['_url'])) ? ltrim(filter_var($_GET['_url'], FILTER_SANITIZE_URL), '/') : '';
        self::$_url = self::rmes(self::$_url, self::$_removeExtraSlashes);
        /** create patern to check route */
        $route = (!self::$_url) ? '' : $route;
        $patern = "/^".str_replace('/', '\/', $route)."$/";
        /** check exist route */
        if(preg_match($patern, self::$_url)){
            global $config;
            if($func && $func instanceof Closure){
                if(!self::$_url){
                    $indexFile = STATIC_PATH.'index.html';
                    if(file_exists($indexFile)){
                        require $indexFile; die;
                    }
                }
                $data = (!self::$_url) ? array('users', 'index', 'index') : $func();
                if(is_array($data)){
                    /** check data return valid*/
                    if(!isset($data[0]) || !isset($data[1]) || !isset($data[2])){
                        if($config['debug']){
                            View::show404("Please return valid values <br /> Syntax: <span style='color: #c25; font-size: .90rem;'>return ['module', 'controller', 'action'];</span>");
                        }else{
                            View::show404();
                        }
                    }/** check data */
                    /** check module is define */
                    if(!isset($config['modules'][$data[0]])) View::show404("Module '{$data[0]}' not yet define!");
                    $path = $config['modules'][$data[0]]."/controllers/".ucwords($data[1])."Controller.php";
                    /** check exist controller */
                    if(file_exists($path)){
                        /** Load Base Controller */
                        $ControllerBase = $config['modules'][$data[0]]."/controllers/ControllerBase.php";
                        self::$_module = $config['modules'][$data[0]];
                        if(!file_exists($ControllerBase)){
                            View::show404("ControllerBase in module '{$data[0]}' not found");
                        }
                        require $ControllerBase;
                        /** Load File Controller */
                        require $path;
                        $controllers = ucwords($data[1]).'Controller';
                        $action = $data[2].'Action';
                        /** check exist Controller */
                        if(class_exists($controllers)){
                            /** Create new Controller */
                            $controller = new $controllers;
                            /** check action exist in controller */
                            if (method_exists($controller, $action)){
                                /** Run action */
                                $controller->{$action}();
                                /** Get master layout */
                                $master_layout = View::$_layout;
                                /** Get other view */
                                $otherView = View::$_OtherView;
                                /** other new -> default view */
                                $view = ($otherView) ? $config['modules'][$data[0]].'/views/'.$data[1].'/'.$otherView.'.phtml' :
                                                       $config['modules'][$data[0]].'/views/'.$data[1].'/'.$data[2].'.phtml';
                                /** Check has disable view */
                                if(!View::$_disableView){
                                    /** Check exist file view */
                                    if(file_exists($view)){
                                        if(!$master_layout){
                                            require $view;
                                        }else{
                                            /** set subLayout to view */
                                            View::set('subLayout', $view);
                                            $fileMasterLayout = TEMPLATE_LAYOUT.$master_layout.'.phtml';
                                            /** check exist file master layout */
                                            if(file_exists($fileMasterLayout)){
                                                require $fileMasterLayout;
                                            }else{
                                                if($config['debug']){
                                                    View::show404("Layout '$master_layout' not found!");
                                                }else{
                                                    View::show404();
                                                }
                                            }/** check exist file master layout */
                                        }
                                    }else{
                                        if($config['debug']){
                                            View::show404("Not found view for action '$action' in controller '$controllers'");
                                        }else{
                                            View::show404();
                                        }
                                    }/** Check exist file view */
                                }/** Check has disable view */
                            }else{
                                if($config['debug']){
                                    View::show404("'$action' not found in controller '$controllers'");
                                }else{
                                    View::show404();
                                }
                            }/** check action exist in controller */
                        }else{
                            if($config['debug']){
                                View::show404("Controller '$controllers' not found");
                            }else{
                                View::show404();
                            }
                        }/** check exist Controller */
                    }else{
                        if($config['debug']){
                            View::show404("'$path' not found");
                        }else{
                            View::show404();
                        }
                    }/** check exist controller */
                }
            }
            exit;
        }else{
            self::$_checkRoute = false;
        }/** check exist route */
    }

    public static function existPage()
    {
        global $config;
        if(!self::$_checkRoute){
            if($config['debug']){
                return View::show404("Route '".self::$_url."' not found");
            }else{
                return View::show404();
            }
        }
    }

    public static function vendor($flag = false)
    {
        if($flag){
            $file = VENDOR."autoload.php";
            if(file_exists($file)){
                require_once $file;
            }
        }
    }

    public static function uses()
    {
        $arg_list = func_get_args();
        foreach ($arg_list as $core) {
            $file = CORE.ucwords(strtolower($core)).'.php';
            if(!file_exists($file)){
                View::show404("Class '$core' not found");
            }
            require_once $file;
        }
    }

    /** load model */
    public static function model()
    {
        $arg_list = func_get_args();
        $module = self::$_module;
        foreach ($arg_list as $model) {
            $file = $module.'/models/'.ucwords(strtolower($model)).'.php';
            if(!file_exists($file)){
                View::show404("Model '$model' not found in '$module'");
            }
            require_once $file;
        }
    }

    /** khong can quan tam den nhung func ben duoi => khong dung` */
    private static function rmes($url, $status)
    {
        $flag = substr($url, -1);
        if($status){
            if($url && $flag === '/'){
                $url = rtrim($url, '/');
            }
        }else{
            if($url && $flag !== '/'){
                $url = $url.'/';
            }
        }
        return $url;
    }

    public static function removeExtraSlashes($status = false)
    {
        self::$_removeExtraSlashes = $status;
    }
}