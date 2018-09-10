<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="<?=Conf::$site?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Admin : <?=$this->chk($title);?></title>
	<meta name="description" content="<?=$this->chk($metadescription);?>" />
	<meta name="keywords" content="<?=$this->chk($metakeywords);?>" />
	<link href="<?=Conf::$site;?>/css/admin.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="<?=Conf::$site;?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?=Conf::$site;?>/js/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="<?=Conf::$site;?>/js/picnet.table.filter.js"></script>
	<script type="text/javascript" src="<?=Conf::$site;?>/js/jquery.validateform.js"></script>
	<script type="text/javascript" src="<?=Conf::$site;?>/js/ajaxfileupload.js"></script>
	<script type="text/javascript" src="<?=Conf::$site;?>/js/script.js"></script>
	<script type="text/javascript">
		var siteurl = '<?=Conf::$site;?>';
		var langurl = 'lang=<?=$this->getLang();?>';
	</script>
</head>
<body>
	<div id="xmsg-div"><?=$this->chk($xmsg)?></div>
	<div id="admin-header"> 
		<?=Conf::$sitename?>
	</div>
	<div id="admin-menu">
		<?=$this->chk($menu);?>
		<a href="<?=$this->url('login', 'logout')?>" style="float: right;">Logout</a>
		<div style="clear:both;"></div>
	</div>
	<div id="admin-menu">
		<?=$this->chk($submenu);?>
		<div style="clear:both;"></div>
	</div>
	<div id="admin-content" class="admin-inner">
		<?=$body;?>
	</div>
</body>
</html>