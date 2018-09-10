<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" >
<head>
  <base href="<?=Conf::$site?>" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title><?=$title;?></title>
  <meta name="description" content="<?=$this->chk($metadescription);?>" />
  <meta name="keywords" content="<?=$this->chk($metakeywords);?>" />
  <meta name="google-site-verification" content="3HDPtASCV7YDRJRHHp8N6cVras71d4YpA0hb3rrJ7Zo" />
  <meta name="google-site-verification" content="yyng8DyiQ-9KgiDJywxUTB2hgO5pJj_zAujGx1S5sdQ" />
  <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Questrial|Wire One" type="text/css" />
  <link rel="stylesheet" href="/css/template/gantry.css" type="text/css" />
  <link rel="stylesheet" href="/css/template/template.css" type="text/css" />
  <link rel="stylesheet" href="/css/template/fusionmenu.css" type="text/css" />
  <link rel="stylesheet" href="/css/template/fullw.css" type="text/css" />
  <link rel="stylesheet" href="/css/template/gallery.css" type="text/css" />
  <script src="/js/template/mootools-core.js" type="text/javascript"></script>
  <script src="/js/template/core.js" type="text/javascript"></script>
  <script src="/js/template/mootools-more.js" type="text/javascript"></script>
  <script src="/js/jquery.js" type="text/javascript"></script>
  <script src="/js/template/gantry-buildspans.js" type="text/javascript"></script>
  <script src="/js/template/fusion.js" type="text/javascript"></script>
  <script src="/js/template/fullw.js" type="text/javascript"></script>
  <script src="/js/common.js" type="text/javascript"></script>
  <script src="/js/template/gallery.js" type="text/javascript"></script>
  <script type="text/javascript">
  	var base_url = '<?=Conf::$site.'/'.$this->getLang();?>';
  </script>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61777203-3', 'auto');
  ga('send', 'pageview');

  </script>
</head>
<body class="top-linkunderline-none top-linkhoverunderline-none webfonts-family-arial webfonts-size-14px headingsfont-family-questrial headingsfont-h1size-28px headingsfont-h2size-26px headingsfont-h3size-22px headingsfont-h4size-20px headingsfont-h5size-18px headingsfont-h6size-16px headingsfont-texttransform-none headingsfont-fontweight-normal headingsfont-fontstyle-normal mymenufont-family-arial mymenufont-mymenufontsize-16px mymenufont-mymenutexttransform-none mymenufont-mymenufontweight-normal mymenufont-mymenufontstyle-normal submymenufont-family-arial submymenufont-submymenufontsize-12px submymenufont-submymenutexttransform-none submymenufont-submymenufontweight-normal submymenufont-submymenufontstyle-normal menu-type-fusionmenu col12">
 
<div style="min-height:140px;" id="rt-top-container">	
	<div id="rt-header">
		<div id="rt-header-inner">
			<div class="rt-container">
				<div class="rt-grid-4 rt-alpha">
		    		<div class="rt-block">
		    	    	<a id="rt-logo" href="/">&nbsp;</a>
		    		</div>
				</div>
				<div class="rt-grid-8 rt-omega">
					<div class="rt-fusionmenu">
						<div class="nopill">
							<div class="rt-menubar">
								<?=$this->chk($topmenu);?>
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div id="rt-content-container">
	<?=$body?>
</div>
<?=$this->render('footer');?>
</body>
</html>