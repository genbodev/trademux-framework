<div class="t3-module module ">
	<div class="module-inner">
		<div class="module-ct">
			<div class="k2LoginBlock" id="k2ModuleBox156">
				<form id="form-login" name="login" method="post" action="<?=$uri;?>">
					<input type="hidden" value="2" name="step">
					<fieldset class="input">
					    <p id="form-login-username">
					      <label for="modlgn_username">Email</label>
					      <input type="text" size="18" class="inputbox" name="login" id="modlgn_username">
					    </p>
					    <p id="form-login-password">
					      <label for="modlgn_passwd">Password</label>
					      <input type="password" size="18" class="inputbox" name="pass" id="modlgn_passwd">
					    </p>
				    	<input type="submit" value="Login" class="btn btn-primary" name="Submit">
				  	</fieldset>
		  			<ul>
		    			<li><a href="<?=$this->url('registration','forgotpass')?>">Forgot your password?</a></li>
		    			<li><a href="<?=$this->url('registration')?>">Create an account</a></li>
		    	  	</ul>
		  		</form>
			</div>
		</div>
	</div>
</div>