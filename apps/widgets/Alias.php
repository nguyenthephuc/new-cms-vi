<?php
/**
 * @author  The Phuc
 * @since   17/04/2016
 * @package ALIAS
 */
class Alias {

    public static function active($data)
    {
        #start function
        if(!$data) return false; ?>
        <script>
            jQuery(document).ready(function(){
                jQuery('input[name=<?php echo $data['input'] ?>]').blur(function(){
                    var alias = to_slug(jQuery('input[name=<?php echo $data['input'] ?>]').val());
                    jQuery('input[name=<?php echo $data['alias'] ?>]').val(alias);
                });
            });
        </script>
<?php } #end function
}