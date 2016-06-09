<?php
class Response {

    /** kiem tra su kien submit */
    public static function isPost()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){ return true; }
        return false;
    }

    public static function errorback( $arr = null, $path = null )
    {
        if (!$arr) return false;
        $err = implode("", $arr);
        $back = ($path) ? "location.href = '$path';" : 'history.back();';
        $html = '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';
        $html .= "<script language='JavaScript'> alert('".$err."'); ".$back."</script>";
        echo $html; exit;
    }

    public static function closeform()
    {
        $html = "<script language='JavaScript'>window.opener.location.reload(true);window.parent.close();</script>";
        echo $html;
    }

    /** tra du lieu dang json */
    public static function sendAjax($data)
    {
        header('Content-type: application/json');
        echo json_encode($data);
        unset($data); die;
    }

    /** kiem tra phai request ajax */
    public static function isAjax()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            return true;
        }
        return false;
    }

    public static function unMagicQuotes( $p_arr = null )
    {
        if ( !$p_arr ) return false;
        foreach ( $p_arr as $k => $v ){
            if ( is_array($v) ) {
                $p_arr[$k] = self::unMagicQuotes($v);
            } else {
                $p_arr[$k] = stripslashes($v);
            }
        }
        return $p_arr;
    }

    /** lay du lieu truyen len sv */
    public static function request($name = null, $filter = null)
    {
        $request = array_merge_recursive($_GET, $_POST);
        $request = self::unMagicQuotes($request);

        if(!$name) return $request;
        if(!$filter) return $request[$name];
        switch ($filter) {
            case 'string':
                $request[$name] = (isset($request[$name])) ? self::filter($request[$name], 'string') : '';
                break;
            case 'int':
                $request[$name] = (isset($request[$name])) ? self::filter($request[$name], 'int') : '';
                break;
            case 'float':
                $request[$name] = (isset($request[$name])) ? self::filter($request[$name], 'float') : '';
                break;
            case 'email':
                $request[$name] = (isset($request[$name])) ? self::filter($request[$name], 'email') : '';
                break;
            case 'url':
                $request[$name] = (isset($request[$name])) ? self::filter($request[$name], 'url') : '';
                break;
            default:
                $request[$name] = (isset($request[$name])) ? $request[$name] : '';
                break;
        }
        return $request[$name];
    }

    /** thiet bi loc du lieu */
    public static function filter($value=null, $filter=null)
    {
        switch ($filter) {
            case 'string':
                $value = filter_var($value, FILTER_SANITIZE_STRING);
                $value = filter_var($value, FILTER_SANITIZE_STRIPPED);
                $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                break;
            case 'int':
                $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                break;
            case 'float':
                $value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT);
                break;
            case 'email':
                $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                break;
            case 'url':
                $value = filter_var($value, FILTER_SANITIZE_URL);
                break;
            default:
                $value = $value;
                break;
        }
        return htmlentities($value);
    }

    /** lay bien truyen qua url */
    public static function getParam($index, $filter=null)
    {
        $url = self::request('_url') ? ltrim(filter_var(self::request('_url'), FILTER_SANITIZE_URL), '/') : '';

        if(!is_numeric($index) || is_null($index)) die('Please input id for param');
        $data = explode('/', $url);
        $result = (isset($data[$index])) ? $data[$index] : '';
        if($result){
            switch ($filter) {
                case 'string':
                    $result = self::filter($result, 'string');
                    break;
                case 'int':
                    $result = self::filter($result, 'int');
                    break;
                case 'float':
                    $result = self::filter($result, 'float');
                    break;
                case 'email':
                    $result = self::filter($result, 'email');
                    break;
                case 'url':
                    $result = self::filter($result, 'url');
                    break;
                default:
                    $result = $result;
                    break;
            }
        }
        return $result;
    }

    /** dieu huong */
    public static function redirect($url, $num = 200)
    {
        static $http = array (
            100 => "HTTP/1.1 100 Continue",
            101 => "HTTP/1.1 101 Switching Protocols",
            200 => "HTTP/1.1 200 OK",
            201 => "HTTP/1.1 201 Created",
            202 => "HTTP/1.1 202 Accepted",
            203 => "HTTP/1.1 203 Non-Authoritative Information",
            204 => "HTTP/1.1 204 No Content",
            205 => "HTTP/1.1 205 Reset Content",
            206 => "HTTP/1.1 206 Partial Content",
            300 => "HTTP/1.1 300 Multiple Choices",
            301 => "HTTP/1.1 301 Moved Permanently",
            302 => "HTTP/1.1 302 Found",
            303 => "HTTP/1.1 303 See Other",
            304 => "HTTP/1.1 304 Not Modified",
            305 => "HTTP/1.1 305 Use Proxy",
            307 => "HTTP/1.1 307 Temporary Redirect",
            400 => "HTTP/1.1 400 Bad Request",
            401 => "HTTP/1.1 401 Unauthorized",
            402 => "HTTP/1.1 402 Payment Required",
            403 => "HTTP/1.1 403 Forbidden",
            404 => "HTTP/1.1 404 Not Found",
            405 => "HTTP/1.1 405 Method Not Allowed",
            406 => "HTTP/1.1 406 Not Acceptable",
            407 => "HTTP/1.1 407 Proxy Authentication Required",
            408 => "HTTP/1.1 408 Request Time-out",
            409 => "HTTP/1.1 409 Conflict",
            410 => "HTTP/1.1 410 Gone",
            411 => "HTTP/1.1 411 Length Required",
            412 => "HTTP/1.1 412 Precondition Failed",
            413 => "HTTP/1.1 413 Request Entity Too Large",
            414 => "HTTP/1.1 414 Request-URI Too Large",
            415 => "HTTP/1.1 415 Unsupported Media Type",
            416 => "HTTP/1.1 416 Requested range not satisfiable",
            417 => "HTTP/1.1 417 Expectation Failed",
            500 => "HTTP/1.1 500 Internal Server Error",
            501 => "HTTP/1.1 501 Not Implemented",
            502 => "HTTP/1.1 502 Bad Gateway",
            503 => "HTTP/1.1 503 Service Unavailable",
            504 => "HTTP/1.1 504 Gateway Time-out"
        );
        $code = (isset($http[$num])) ? $http[$num] : $http[200];
        header($code); header ("Location: $url"); unset($code); die();
    }
}