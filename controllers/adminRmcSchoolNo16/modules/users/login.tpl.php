<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">R+</h1>

        </div>
        <h3><?php echo __("Welcome to Righter's Group")?></h3>
        <form class="m-t" role="form" method="POST" action="<?php echo getConfig('siteUrl').'/users/login' ?>">
        <span class="error-msg fadeInDown " STYLE="COLOR:WHITE;">
				<?php
					if ($oSession->hasError('success_message')) 
					{
						echo "<label class='success-msg'>" . $oSession->getError('success_message') . "</label><br>";
					}
					if ($oSession->hasError('wrong_credentials')) 
					{
						echo "<label class='error-msg '>" . $oSession->getError('wrong_credentials') . "</label><br>";
					}
				?>
			</span>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" required="" name="username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required="" name="password">
            </div>
            <button type="submit" name="submit" id="loginBtn" class="btn btn-primary block full-width m-b"><?php echo __("Login")?></button>
        </form>
        <p class="m-t"> <small><?php echo __("Righter's Group")?> &copy; <?php echo __("2014")?></small> </p>
    </div>
</div>