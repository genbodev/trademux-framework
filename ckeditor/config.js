/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.filebrowserBrowseUrl = 'ckeditor/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = 'ckeditor/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = 'ckeditor/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = 'ckeditor/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = 'ckeditor/kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl = 'ckeditor/kcfinder/upload.php?type=flash';

    config.enterMode = 2 ;  // br
    config.shiftEnterMode = 1 ;  // p
    config.fillEmptyBlocks = false;
    config.tabSpaces = 0;
    config.allowedContent = true;

    config.contentsCss = ['/css/template/gantry.css','/css/template/joomla.css','/css/template/template.css','/css/template/grid-12.css','/css/template/gktabs.css','/css/template/slider.css','/css/template/index.css'];
};