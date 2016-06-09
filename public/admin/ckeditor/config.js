/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    // config.extraPlugins = 'imageuploader';
    config.filebrowserBrowseUrl = '/public/admin/ckeditor/kcfinder-2.51/browse.php?type=files';
    config.filebrowserImageBrowseUrl = '/public/admin/ckeditor/kcfinder-2.51/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = '/public/admin/ckeditor/kcfinder-2.51/browse.php?type=flash';
    config.filebrowserUploadUrl = '/public/admin/ckeditor/kcfinder-2.51/upload.php?type=files';
    config.filebrowserImageUploadUrl = '/public/admin/ckeditor/kcfinder-2.51/upload.php?type=images';
    config.filebrowserFlashUploadUrl = '/public/admin/ckeditor/kcfinder-2.51/upload.php?type=flash';
    config.extraPlugins = 'codesnippet';
    config.extraPlugins = 'widget';
    config.extraPlugins = 'lineutils';
    config.extraPlugins = 'image2';
    // config.codeSnippet_theme = 'school_book';
};