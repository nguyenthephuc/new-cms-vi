<?php
class Form {

    public static function radio($name, $data, $checked = null)
    {
        if(!$name || !$data || !is_array($data)) return false;
        $return = '';
        foreach ($data as $key => $value) {
            $ischeck = ($checked && $checked == $key) ? "checked=\"checked\"" : '';
            $return .= "<label><input type=\"radio\" name=\"$name\" value=\"$key\" $ischeck>$value</label> ";
        }
        return $return;
    }

    public static function text($name, $data = null, $datepicker = false, $placeholder = null, $class = null, $size = 30)
    {
        if(!$name) return false;
        return (!$datepicker) ? "<input type=\"text\" name=\"$name\" id=\"$name\" class=\"$class\" size=\"$size\" value=\"$data\" placeholder=\"$placeholder\">" : "<input type=\"text\" name=\"$name\" id=\"$name\" class=\"$class renderdatepicker\" size=\"$size\" value=\"$data\" placeholder=\"$placeholder\">";
    }

    public static function textarea($name, $data = null, $class = null, $row = 3, $width = 248)
    {
        if(!$name) return false;
        return "<textarea name=\"$name\" id=\"$name\" class=\"$class\" rows=\"$row\" style=\"width: {$width}px\">$data</textarea>";
    }

    public static function select($name, $data, $selected = null, $default = null, $class = null)
    {
        if(!$name || !$data || !is_array($data)) return false;
        $return = "<select name=\"$name\" id=\"$name\" class=\"$class\">";
        $return .= ($default) ? "<option value=\"\">$default</option>" : '';
        foreach ($data as $key => $value) {
            $isselected = ($selected && $selected == $key) ? "selected=\"selected\"" : '';
            $return .= "<option $isselected value=\"$key\">$value</option>";
        }
        $return .= "</select>";
        return $return;
    }

    public static function checkbox($name, $data, $checked = null)
    {
        if(!$name || !$data || !is_array($data)) return false;
        if($checked && !is_array($checked)) return false;
        $return = '';
        foreach ($data as $key => $value) {
            $ischecked = ( in_array($key, $checked) ) ? "checked='checked'" : '';
            $return .= "<label><input type=\"checkbox\" $ischecked name=\"$name\" value=\"$key\">$value</label>";
        }
        return $return;
    }

    public static function image($name, $src = null, $remove = true, $class = null)
    {
        if(!$name) return false;
        $return = "<input type=\"file\" class=\"$class\" name=\"$name\" id=\"$name\" onchange=\"preview(event, 'output_$name', '#$name', '#remove_$name')\"><br>";
        $return .= ($src) ? "<br><img src=\"$src\" id=\"output_$name\" style=\"width: 300px; height: auto\">" : "<br><img id=\"output_$name\" style=\"width: 300px; height: auto\">";
        $return .= ($src) ? "<input type=\"hidden\" id=\"hidden_$name\" value=\"$src\">" : "<input type=\"hidden\" id=\"hidden_$name\" value=\"\">";
        if($remove) $return .= ($src) ? "<br><a id='remove_$name' href='javascript:void(0)' onclick=\"remove_src('#$name', '#output_$name', '#remove_$name')\">Xóa hình</a>" : "<a id='remove_$name' href='javascript:void(0)' onclick=\"remove_src('#$name', '#output_$name', '#remove_$name')\" style=\"display: none;\">Xóa hình</a>";
        $return .= "<script>";
        $return .= "    jQuery(document).ready(function(){";
        $return .= '        if(!$(\'#hidden_'.$name.'\').val()){';
        $return .= '            $(\'#output_'.$name.'\').hide();';
        $return .= "        }";
        $return .= '        if($(\'#'.$name.'\').val()){';
        $return .= '            $(\'#output_'.$name.'\').show();';
        $return .= "        }";
        $return .= '        $(\'#'.$name.'\').change(function(){';
        $return .= '            $(\'#output_'.$name.'\').show();';
        $return .= "        });";
        $return .= "    });";
        $return .= "</script>";
        return $return;
    }

    public static function file($name, $source = null, $remove = true, $class = null)
    {
        if(!$name) return false;
        $return = "<input type=\"file\" name=\"$name\" id=\"$name\" class=\"ime_act\" onchange=\"preview(event, '$name', '#$name', '#remove_$name')\" />";
        if($remove) $return .= ($source) ? "<br /><a id='remove_$name' href='javascript:void(0)' onclick=\"remove_src('#$name', '#output_$name', '#remove_$name')\"><img src='/public/admin/images/doc.png'>Xóa tập tin</a>" : "<a id='remove_$name' href='javascript:void(0)' onclick=\"remove_src('#$name', '#output_$name', '#remove_$name')\" style=\"display: none;\"><img src='/public/admin/images/doc.png'>Xóa tập tin</a>";
        if(!$remove) $return .= ($source) ? "<span><img src='/public/admin/images/doc.png'></span>" : '';
        return $return;
    }
}