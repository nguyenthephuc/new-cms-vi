<?php
/**
 * @author  The Phuc
 * @since   17/04/2016
 * @package EDITOR
 */
class Editor {

    public static function active($name)
    {
        #start function
        if(!$name) return false; ?>
        <script>
        var stylesSet = [
            { name: 'Clean', type: 'widget', widget: 'image', attributes: { 'class': 'clean' } },
            { name: 'Polarized', type: 'widget', widget: 'image', attributes: { 'class': 'polarized' } },
            { name: 'Narrow Code', type: 'widget', widget: 'codeSnippet', attributes: { 'class': 'narrow' } },
            { name: 'Fancy JavaScript', type: 'widget', widget: 'codeSnippet', attributes: { 'class': 'fancy' } }
        ];
        CKEDITOR.replace( '<?php echo $name ?>',
        {
            extraPlugins: 'image2,codesnippet',
            contentsCss: [
                CKEDITOR.getUrl( 'contents.css' ),
                '/admin/ckeditor/assets/widgetStyles.css'
            ],
            stylesSet: stylesSet,
            image2_alignClasses: [ 'image-left', 'image-center', 'image-right' ],
            image2_captionedClass: 'image-captioned',
            codeSnippet_theme: 'monokai_sublime',
            toolbarGroups: [
                { groups: [ 'mode' ] },
                { groups: [ 'undo' ] },
                { groups: [ 'basicstyles', 'links' ] },
                { groups: [ 'styles' ] },
                { groups: [ 'insert' ] },
            ],
            removeButtons: 'Table,HorizontalRule,SpecialChar',
            toolbar:[
                ['Cut','Copy','Paste','Undo','Redo','Source', 'Link', 'Unlink'],
                ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                ['TextColor','BGColor','Image', 'Smiley', 'Maximize'],
                ['Styles','Format','Font','FontSize', 'Blockquote', 'Preview', 'CodeSnippet']
            ],
        });
        </script>
<?php } #end function
}