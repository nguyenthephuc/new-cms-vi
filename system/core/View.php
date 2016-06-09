<?php
class View {
    public static $_layout;
    public static $_OtherView;
    public static $_data = array();
    public static $_disableView = false;

    /** khong tai view */
    public static function disable()
    {
        self::$_disableView = true;
    }

    public static function set($key, $data=null)
    {
        if(empty($key)) return false;
        self::$_data[$key] = $data;
    }

    public static function get($key, $data=null)
    {
        if(empty($key)) return false;
        return isset(self::$_data[$key]) ? self::$_data[$key] : '';
    }

    /** thiet lap layout */
    public static function setLayout($layout)
    {
        self::$_layout = $layout;
    }

    /** thiet lap view khac view mac dinh */
    public static function setOtherView($layout)
    {
        self::$_OtherView = $layout;
    }

    /** tai partial */
    public static function loadPartial($partial)
    {
        $file = TEMPLATE_PARTIAL.$partial.'.phtml';
        if(file_exists($file)){
            require_once $file;
        }else{
            App::show404("Not found partial '$partial'");
        }
    }

    /** load widget */
    public static function loadWidget($widget, $data = null)
    {
        if(empty($widget)) return false;
        $WG = ucwords(strtolower($widget));
        $file = WIDGET.$WG.'.php';
        if(!file_exists($file)){
            View::show404("Widget '$widget' not found");
        }
        require $file;
        if(class_exists($WG)){
            if(method_exists($WG, 'active')){
                $WG::active($data);
            }else{
                View::show404("Widget '$widget' not found method active");
            }
        }else{
            View::show404("Widget '$widget' not yet define");
        }
    }

    /** load static page */
    public static function html($page)
    {
        if(!$page) return false;
        $file = STATIC_PATH.$page;
        if(file_exists($file)){
            require $file;
        }else{
            self::show404("Not found '$file'");
        }
    }

    public static function show404($message = null)
    {
        header("HTTP/1.1 404 Not Found", true);
        die("<html>
                <head>
                    <title>Error 404 - Page Not Found</title>
                </head>
                <body>
                    <center style='margin-top: 5%; padding: 10px;'>
                        <h1 style='color: teal'>Error 404 - Page Not Found</h1>
                        <p style='color: #7f8c8d'>$message</p>
                        <img src='/public/admin/images/404.jpg' alt='Error 404 - Page Not Found'>
                    </center>
                </body>
            </html>");
    }

    public static function loadLayout()
    {
        require_once self::get('subLayout');
    }
}