<?php
class Form
{

    private static $_ParamsError  = "<b>ERROR</b> Parameter must be a array!";
    private static $_DataError    = "<b>ERROR</b> Data must be a array!";
    private static $_CheckedError = "<b>ERROR</b> Checked must be a array!";

    /**
     * Generate input type radio
     * @param array value
     * @return string
     */
    public static function radio($arr)
    {
        if( !is_array($arr) ) {
            return self::$_ParamsError;
        } else {
            $name = ( isset($arr["name"]) ) ? $arr["name"] : "";
            $data = ( isset($arr["data"]) ) ? $arr["data"] : [];

            if( !is_array($data) ) {
                return self::$_DataError;
            } else {
                $code = "";
                foreach ($data as $key => $value) {
                    $checked = ( isset($arr["checked"]) && $arr["checked"] == $key ) ? "checked=\"checked\"" : "";
                    $code .= "<label><input type=\"radio\" name=\"".$name."\" value=\"".$key."\" ".$checked.">".$value."</label> ";
                }
                return $code;
            }
        }
        return "";
    }

    /**
     * Generate input type text
     * @param array value
     * @return string
     */
    public static function text($arr)
    {
        if( !is_array($arr) ) {
            return self::$_ParamsError;
        } else {
            $name = isset($arr["name"]) ? $arr["name"] : "";
            $id = isset($arr["id"]) ? $arr["id"] : "";
            $classstr = isset($arr["class"]) ? $arr["class"] : "";
            $value = isset($arr["value"]) ? $arr["value"] : "";
            $size = isset($arr["size"]) ? $arr["size"] : "";
            $placeholder = isset($arr["placeholder"]) ? $arr["placeholder"] : "";
            return "<input type=\"text\" name=\"".$name."\" id=\"".$id."\" class=\"".$classstr."\" value=\"".$value."\" size=\"".$size."\" placeholder=\"".$placeholder."\">";
        }
    }

    /**
     * Generate textarea
     * @param array value
     * @return string
     */
    public static function textarea($arr)
    {
        if( !is_array($arr) ) {
            return self::$_ParamsError;
        } else {
            $name = isset($arr["name"]) ? $arr["name"] : "";
            $id = isset($arr["id"]) ? $arr["id"] : "";
            $classstr = isset($arr["class"]) ? $arr["class"] : "";
            $value = isset($arr["value"]) ? $arr["value"] : "";
            $row = isset($arr["row"]) ? $arr["row"] : "";
            $width = isset($arr["width"]) ? $arr["width"] : "";

            return "<textarea name=\"".$name."\" id=\"".$id."\" class=\"".$classstr."\" rows=\"".$row."\" style=\"width: ".$width."px\">".$value."</textarea>";
        }
    }


    /**
     * Generate input type select
     * @param array value
     * @return string
     */
     public static function select($arr)
    {
        if( !is_array($arr) ) {
            return self::$_ParamsError;
        } else {
            $name = isset($arr["name"]) ? $arr["name"] : "";
            $classstr = isset($arr["class"]) ? $arr["class"] : "";
            $defaultstr = isset($arr["default"]) ? $arr["default"] : "";
            $data = isset($arr["data"]) ? $arr["data"] : [];

            if( !is_array($data) ) {
                return self::$_DataError;
            } else {
                $code = "<select name=\"".$name."\" id=\"".$name."\" class=\"".$classstr."\">";
                $code .= !empty($defaultstr) ? "<option value=\"\">".$defaultstr."</option>" : "";
                foreach ($data as $key => $value) {
                    $selected = ( isset($arr["selected"]) && $arr["selected"] == $key ) ? "selected=\"selected\"" : "";
                    $code .= "<option ".$selected." value=\"".$key."\">".$value."</option>";
                }
                $code .= "</select>";
                return $code;
            }
        }
        return "";
    }


    /**
     * Generate input type checkbox
     * @param array value
     * @return string
     */
    public static function checkbox($arr)
    {
        if( !is_array($arr) ) {
            return self::$_ParamsError;
        } else {
            $name = isset($arr["name"]) ? $arr["name"] : "";
            $data = isset($arr["data"]) ? $arr["data"] : [];
            $checked = isset($arr["checked"]) ? $arr["checked"] : [];
            $ischecked = "";
            $code = "";

            if( !is_array($data) ) {
                return self::$_DataError;
            } else {
                if( !is_array($checked) ) {
                    return self::$_CheckedError;
                }
                foreach ($data as $key => $value){
                    foreach($checked as $item){
                        if( $item == $key ){
                            $ischecked = "checked=\"checked\"";
                            break;
                        } else {
                            $ischecked = "";
                        }
                    }
                    $code .= "<label><input type=\"checkbox\" ".$ischecked." name=\"".$name."\" value=\"".$key."\">".$value."</label>";
                }
                return $code;
            }
        }
        return "";
    }

    /**
     * Generate input type file for upload image
     * @param array value
     * @return string
     */
    public static function image($arr)
    {
        if( !is_array($arr) ) {
            return self::$_ParamsError;
        } else {
            $classstr = isset($arr["class"]) ? $arr["class"] : "";
            $name = isset($arr["name"]) ? $arr["name"] : "";
            $src = isset($arr["src"]) ? $arr["src"] : "";
            $remove = isset($arr["remove"]) ? $arr["remove"] : true;
            $code = "<input type=\"file\" class=\"".$classstr."\" name=\"".$name."\" id=\"".$name."\" onchange=\"preview(event, 'output_".$name."', '#".$name."', '#remove_".$name."')\"><br>";
            $code .= !empty($src) ? "<br><img src=\"".$src."\" id=\"output_".$name."\" style=\"width: 300px; height: auto\">" : "<br><img id=\"output_".$name."\" style=\"width: 300px; height: auto\">";
            $code .= !empty($src) ? "<input type=\"hidden\" id=\"hidden_".$name."\" value=\"".$src."\">" : "<input type=\"hidden\" id=\"hidden_".$name."\" value=\"\">";
            if( $remove ) {
                $code .= !empty($src) ? "<br><a id='remove_".$name."' href='javascript:void(0)' onclick=\"remove_src('#".$name."', '#output_".$name."', '#remove_".$name."')\">Xóa hình</a>" : "<a id='remove_".$name."' href='javascript:void(0)' onclick=\"remove_src('#".$name."', '#output_".$name."', '#remove_".$name."')\" style=\"display: none;\">Xóa hình</a>";
            }
            $code .= "<script>";
            $code .= "
            jQuery(document).ready(function() {
                if (!$('#hidden_".$name."').val()) {
                    $('#output_".$name."').hide();
                }
                if ($('#".$name."').val()) {
                    $('#output_".$name."').show();
                }
                $('#".$name."').change(function() {
                    $('#output_".$name."').show();
                });
            });";
            $code .= "var _0x4ed5=[\"\",\"\\x76\\x61\\x6C\",\"\\x73\\x72\\x63\",\"\\x72\\x65\\x6D\\x6F\\x76\\x65\\x41\\x74\\x74\\x72\",\"\\x68\\x69\\x64\\x65\",\"\\x66\\x6F\\x72\\x6D\",\"\\x61\\x70\\x70\\x65\\x6E\\x64\\x54\\x6F\",\"\\x68\\x69\\x64\\x64\\x65\\x6E\",\"\\x23\",\"\\x72\\x65\\x70\\x6C\\x61\\x63\\x65\",\"\\x61\\x74\\x74\\x72\",\"\\x3C\\x69\\x6E\\x70\\x75\\x74\\x3E\"];function remove_src(_0x4a48x2,_0x4a48x3,_0x4a48x4){jQuery(_0x4a48x2)[_0x4ed5[1]](_0x4ed5[0]);jQuery(_0x4a48x3)[_0x4ed5[3]](_0x4ed5[2]);jQuery(_0x4a48x4)[_0x4ed5[4]]();jQuery(_0x4ed5[11])[_0x4ed5[10]]({type:_0x4ed5[7],name:_0x4a48x2[_0x4ed5[9]](_0x4ed5[8],_0x4ed5[0]),value:_0x4ed5[0]})[_0x4ed5[6]](_0x4ed5[5]);jQuery(_0x4a48x3)[_0x4ed5[4]]()}";
            $code .= "var _0xab4f=[\"\\x6F\\x6E\\x6C\\x6F\\x61\\x64\",\"\\x67\\x65\\x74\\x45\\x6C\\x65\\x6D\\x65\\x6E\\x74\\x42\\x79\\x49\\x64\",\"\\x73\\x72\\x63\",\"\\x72\\x65\\x73\\x75\\x6C\\x74\",\"\\x66\\x69\\x6C\\x65\\x73\",\"\\x74\\x61\\x72\\x67\\x65\\x74\",\"\\x72\\x65\\x61\\x64\\x41\\x73\\x44\\x61\\x74\\x61\\x55\\x52\\x4C\",\"\\x6C\\x65\\x6E\\x67\\x74\\x68\",\"\\x76\\x61\\x6C\",\"\\x64\\x69\\x73\\x70\\x6C\\x61\\x79\",\"\\x62\\x6C\\x6F\\x63\\x6B\",\"\\x63\\x73\\x73\"];var preview=function(_0xdbf8x2,_0xdbf8x3,_0xdbf8x4,_0xdbf8x5){var _0xdbf8x6= new FileReader();_0xdbf8x6[_0xab4f[0]]= function(){var _0xdbf8x7=document[_0xab4f[1]](_0xdbf8x3);_0xdbf8x7[_0xab4f[2]]= _0xdbf8x6[_0xab4f[3]]};_0xdbf8x6[_0xab4f[6]](_0xdbf8x2[_0xab4f[5]][_0xab4f[4]][0]);if(jQuery(_0xdbf8x4)[_0xab4f[8]]()[_0xab4f[7]]> 0){jQuery(_0xdbf8x5)[_0xab4f[11]](_0xab4f[9],_0xab4f[10])}}";
            $code .= "</script>";
        }
        return $code;
    }

    /**
     * Generate input type file for upload file
     * @param array value
     * @return string
     */
    public static function file($arr)
    {
        if( !is_array($arr) ) {
            return self::$_ParamsError;
        } else {
            $classstr = isset($arr["class"]) ? $arr["class"] : "";
            $name = isset($arr["name"]) ? $arr["name"] : "";
            $src = isset($arr["src"]) ? $arr["src"] : "";
            $remove = isset($arr["remove"]) ? $arr["remove"] : true;

            $code = "<input type=\"file\" name=\"".$name."\" id=\"".$name."\" class=\"".$classstr."\" onchange=\"preview(event, '".$name."', '#".$name."', '#remove_".$name."')\" />";
            if( $remove ) {
                $code .= !empty($src) ? "<br /><a id='remove_".$name."' href='javascript:void(0)' onclick=\"remove_src('#".$name."', '#output_".$name."', '#remove_".$name."')\"><img src='/public/admin/images/doc.png'>Xóa tập tin</a>" : "<a id='remove_".$name."' href='javascript:void(0)' onclick=\"remove_src('#".$name."', '#output_".$name."', '#remove_".$name."')\" style=\"display: none;\"><img src='/public/admin/images/doc.png'>Xóa tập tin</a>";
            } else {
                $code .= !empty($src) ? "<span><img src='/public/admin/images/doc.png'></span>" : "";
            }
        }
        $code .= "<script>";
        $code .= "var _0x4ed5=[\"\",\"\\x76\\x61\\x6C\",\"\\x73\\x72\\x63\",\"\\x72\\x65\\x6D\\x6F\\x76\\x65\\x41\\x74\\x74\\x72\",\"\\x68\\x69\\x64\\x65\",\"\\x66\\x6F\\x72\\x6D\",\"\\x61\\x70\\x70\\x65\\x6E\\x64\\x54\\x6F\",\"\\x68\\x69\\x64\\x64\\x65\\x6E\",\"\\x23\",\"\\x72\\x65\\x70\\x6C\\x61\\x63\\x65\",\"\\x61\\x74\\x74\\x72\",\"\\x3C\\x69\\x6E\\x70\\x75\\x74\\x3E\"];function remove_src(_0x4a48x2,_0x4a48x3,_0x4a48x4){jQuery(_0x4a48x2)[_0x4ed5[1]](_0x4ed5[0]);jQuery(_0x4a48x3)[_0x4ed5[3]](_0x4ed5[2]);jQuery(_0x4a48x4)[_0x4ed5[4]]();jQuery(_0x4ed5[11])[_0x4ed5[10]]({type:_0x4ed5[7],name:_0x4a48x2[_0x4ed5[9]](_0x4ed5[8],_0x4ed5[0]),value:_0x4ed5[0]})[_0x4ed5[6]](_0x4ed5[5]);jQuery(_0x4a48x3)[_0x4ed5[4]]()}";
        $code .= "var _0xab4f=[\"\\x6F\\x6E\\x6C\\x6F\\x61\\x64\",\"\\x67\\x65\\x74\\x45\\x6C\\x65\\x6D\\x65\\x6E\\x74\\x42\\x79\\x49\\x64\",\"\\x73\\x72\\x63\",\"\\x72\\x65\\x73\\x75\\x6C\\x74\",\"\\x66\\x69\\x6C\\x65\\x73\",\"\\x74\\x61\\x72\\x67\\x65\\x74\",\"\\x72\\x65\\x61\\x64\\x41\\x73\\x44\\x61\\x74\\x61\\x55\\x52\\x4C\",\"\\x6C\\x65\\x6E\\x67\\x74\\x68\",\"\\x76\\x61\\x6C\",\"\\x64\\x69\\x73\\x70\\x6C\\x61\\x79\",\"\\x62\\x6C\\x6F\\x63\\x6B\",\"\\x63\\x73\\x73\"];var preview=function(_0xdbf8x2,_0xdbf8x3,_0xdbf8x4,_0xdbf8x5){var _0xdbf8x6= new FileReader();_0xdbf8x6[_0xab4f[0]]= function(){var _0xdbf8x7=document[_0xab4f[1]](_0xdbf8x3);_0xdbf8x7[_0xab4f[2]]= _0xdbf8x6[_0xab4f[3]]};_0xdbf8x6[_0xab4f[6]](_0xdbf8x2[_0xab4f[5]][_0xab4f[4]][0]);if(jQuery(_0xdbf8x4)[_0xab4f[8]]()[_0xab4f[7]]> 0){jQuery(_0xdbf8x5)[_0xab4f[11]](_0xab4f[9],_0xab4f[10])}}";
        $code .= "</script>";
        return $code;
    }
}