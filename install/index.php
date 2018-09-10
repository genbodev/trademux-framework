<html version="XHTML 1.0">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Installation</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link href="../css/admin.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="../js/jquery.corner.js"></script>
<script type="text/javascript" src="../js/script.js"></script>

</head>
<body>
<div id="admin-content">
<?php
include_once('./installer.php');
$t = !empty($_GET['t']) ? $_GET['t'] : 'index';

$installer = new Installer();
$installer->$t();
?>
</div>
</body>
</html>