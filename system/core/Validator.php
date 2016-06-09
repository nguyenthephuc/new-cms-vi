<?php
class Validator {

    public static function validate($data)
    {
        $err = array();
        if(!is_array($data)) return false;
        foreach ($data as $field) {
            $mycheck = self::check($field);
            $err = array_merge($err, $mycheck);
        }
        return $err;
    }

    public static function isEmail($string)
    {
        $pattern = '/\A[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*\z/i' . 'u';
        return preg_match($pattern, $string);
    }

    public static function isPhone($phone)
    {
        $pattern = "/^[0-9]{3}-[0-9]{4}-[0-9]{3,4}|[0-9]{10,11}|[0-9]{2}-[0-9]{4}-[0-9]{3,4}|[0-9]{2}-[0-9]{4}-[0-9]{4,5}|[0-9]{3}-[0-9]{3}-[0-9]{4,5}$/";
        return preg_match($pattern, $phone);
    }

    public static function isHankaku($string)
    {
        return preg_match('/\A[!-~]*\z/' . 'u', $string);
    }

    public static function isHankakuEisu($string)
    {
        return preg_match('/\A[a-zA-Z0-9]*\z/' . 'u', $string);
    }

    public static function isHankakuEiji($string)
    {
        return preg_match('/\A[a-zA-Z]*\z/' . 'u', $string);
    }

    public static function isNum($string)
    {
        return preg_match('/\A[0-9]*\z/' . 'u', $string);
    }

    public static function isNumHyphen($string)
    {
        return preg_match('/\A[0-9-]*\z/' . 'u', $string);
    }

    public static function isHiragana($string)
    {
        return preg_match('/\A[ぁ-ゞ]*\z/' . 'u', $string);
    }

    public static function isZenkakuKatakana($string)
    {
        return preg_match('/\A[ァ-ヶー]*\z/' . 'u', $string);
    }

    public static function isZenkaku($string)
    {
        return preg_match('/[^ -~｡-ﾟ]/' . 'u', $string);
    }

    public static function isZenkakuAll($string)
    {
        return preg_match('/\A[^\x01-\x7E]*\z/' . 'u', $string);
    }

    #get error message in file config error
    private static function getError($key)
    {
        $file = APP_PATH."configs/message.php";
        if(file_exists($file)){
            $errMessage = require $file;
            return (isset($errMessage[$key])) ? $errMessage[$key] : 'NaN\n';
        }else{
            View::show404("File not found: '$file'");
        }
    }

    private static function check($data)
    {
        $mycheck = array();
        if(!is_array($data)) return false;
        switch ($data[2]) {
            case 'require':
                if(empty($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('require');
                break;
            case 'email':
                if(!self::isEmail($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('email');
                break;
            case 'phone':
                if(!self::isPhone($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('phone');
                break;
            case 'hankaku':
                if(!self::isHankaku($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('hankaku');
                break;
            case 'hankakuEisu':
                if(!self::isHankakuEisu($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('hankakuEisu');
                break;
            case 'hankakuEiji':
                if(!self::isHankakuEiji($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('hankakuEiji');
                break;
            case 'hankakuEiji':
                if(!self::isHankakuEiji($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('hankakuEiji');
                break;
            case 'number':
                if(!self::isNum($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('number');
                break;
            case 'numHyphen':
                if(!self::isNumHyphen($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('numHyphen');
                break;
            case 'hiragana':
                if(!self::isHiragana($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('hiragana');
                break;
            case 'zenkakuKatakana':
                if(!self::isZenkakuKatakana($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('zenkakuKatakana');
                break;
            case 'zenkaku':
                if(!self::isZenkaku($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('zenkaku');
                break;
            case 'zenkakuAll':
                if(!self::isZenkakuAll($data[1]))
                    $mycheck[$data[0]] = $data[0].self::getError('zenkakuAll');
                break;
            default:
                return false;
                break;
        }
        return $mycheck;
    }
}