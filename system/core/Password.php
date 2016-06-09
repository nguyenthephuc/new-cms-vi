<?php
class Password {

    public static function create_hash($password)
    {
        if(empty($password)) return false;
        $salt = base64_encode(mcrypt_create_iv(24, MCRYPT_DEV_URANDOM));
        return 'sha256' . ":" . '1000' . ":" .  $salt . ":" .
            base64_encode(self::pbkdf2(
                'sha256',
                $password,
                $salt,
                1000,
                24,
                true
            ));
    }

    public static function validate_password($password, $correct_hash)
    {
        if(empty($password) || empty($correct_hash)) return false;
        $params = explode(":", $correct_hash);
        if(count($params) < 4)
           return false;
        $pbkdf2 = base64_decode($params[3]);
        return self::slow_equals(
            $pbkdf2,
            self::pbkdf2(
                $params[0],
                $password,
                $params[2],
                (int)$params[1],
                strlen($pbkdf2),
                true
            )
        );
    }

    public static function slow_equals($a, $b)
    {
        $diff = strlen($a) ^ strlen($b);
        for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
        {
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $diff === 0;
    }

    public static function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
    {
        $algorithm = strtolower($algorithm);
        if(!in_array($algorithm, hash_algos(), true))
            die('PBKDF2 ERROR: Invalid hash algorithm.');
        if($count <= 0 || $key_length <= 0)
            die('PBKDF2 ERROR: Invalid parameters.');

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for($i = 1; $i <= $block_count; $i++) {
            $last = $salt . pack("N", $i);
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if($raw_output)
            return substr($output, 0, $key_length);
        else
            return bin2hex(substr($output, 0, $key_length));
    }
}