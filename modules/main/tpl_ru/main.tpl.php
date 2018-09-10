<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?=$this->render('head');?>

<body>

  
<!-- HEADER -->
<header id="t3-header" class="wrap t3-header">
  <div class="container">
  	<div class="row">
	  <div class="languages"><a href="/">En</a>&nbsp;&nbsp;<b>Ru</b></div>
      <!-- LOGO -->
      <div class="logo">
        <div class="logo-image">
          <h1>
            <a href="/ru" title="Logo">
              <span><?=Conf::$sitename?></span>
            </a>
            <small class="site-slogan hidden-phone"></small>
          </h1>
        </div>
        <h3 class="motto">Managed Forex Accounts by Professional Traders</h3>
      </div>
      <!-- //LOGO -->

            <!-- HEAD SEARCH -->
      <div class="top-header pull-right">     
			<?=$this->chk($loginheader);?>
      </div>
      <!-- //HEAD SEARCH -->
      
    </div>
  </div>
</header>
<!-- //HEADER -->

  
<!-- MAIN NAVIGATION -->
<nav id="t3-mainnav" class="wrap t3-mainnav ">
	<div class="container navbar">
    	<div class="navbar-inner">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

	  		<div class="nav-collapse collapse always-show">
				<div  class="t3-megamenu animate fading"  data-duration="400" data-responsive="true">
					<?=$this->chk($topmenu);?>
				</div>
	  		</div>
   		</div>
	</div>
</nav>
<!-- //MAIN NAVIGATION --> 
 
 <?=$body;?>
 
<!-- FOOTER -->
<footer id="t3-footer" class="wrap t3-footer">
  <!-- FOOT NAVIGATION -->
<div class="container">
	<div class="row">
    	<div class="span4 special-width">
    		<div class="t3-module module call-us " id="Mod189">
    			<div class="module-inner">
    				<div class="module-ct">
						<div class="custom call-us"  >
							<br /><br />
							<p><span class="phone-number">info@profitcenterfx.com</span></p>
							<p><a href="<?=$this->url('content','article',array('alias'=>'contacts'));?>"><button class="btn btn-primary" type="button">Напишите нам</button></a></p>
						</div>
					</div>
				</div>
      		</div>
      	</div>
      	<?=$this->chk($part);?>
	</div>
</div>
  <!-- //FOOT NAVIGATION -->

  <section class="t3-copyright">
  	<div class="container">
    	<div class="row">
     		<div class="span8">
      	  		<div class="social-footer">
					<div class="custom"  >
					</div>
		      	</div>
		   	</div>
			<div class="span4">
        		<div class="copyright">
					<div class="custom">Copyright &copy; 2015 <?=Conf::$sitename?>. All rights Reserved.</div>
	        	</div>
        	</div>      
      	</div>
      	<div id="back-to-top" class="backtotop">Вверх</div>
    </div>
  </section>
</footer>
<!-- //FOOTER -->  
</body>
</html>