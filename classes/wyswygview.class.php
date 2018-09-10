<?php

class WYSWYGView extends BaseView
{
	protected function getCKEditor($name, $val = '')
	{
		require_once(Conf::$document_root.'/ckeditor/ckeditor.php');

		$CKEditor = new CKEditor();
		$CKEditor->returnOutput = true;
		$CKEditor->basePath = Conf::$site.'/ckeditor/';
		$CKEditor->config['width'] = 1000;
		$CKEditor->textareaAttributes = array("cols" => 80, "rows" => 10);
		
		return $CKEditor->editor($name, $val);
	}
	
	protected function drawFCKEditor($name, $val = '')
	{
		require_once(Conf::$document_root.'/fckeditor/fckeditor.php');
		
		$oFCKeditor = new FCKeditor($name);
		$oFCKeditor->BasePath = Conf::$site.'/fckeditor/';
		$oFCKeditor->Width = 1000;
		$oFCKeditor->Height = 300;
		$oFCKeditor->Value = $val;
		$oFCKeditor->Create();
	}
}