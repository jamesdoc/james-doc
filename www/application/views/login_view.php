<section class="full">
	<div class="inner">


		<form action="<?php base_url(); ?>login/validate" method="post" accept-charset="utf-8" class="styled-form" id="login-form">
			
			<?php if($message!=null) :?>
			
			<div class='error'><?php echo $message; ?></div>
			
			<?php endif; ?>
			
			<fieldset>
				<p>
					<label for="username">Username</label>
					<input type="text" name="username" placeholder="Username" autofocus="autofocus" />
				</p>
				
				<p>
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="Password" />
				</p>
			</fieldset>
			
			<fieldset>
				<p><input type="submit" name="submit" value="Login" /></p>
			</fieldset>
			
		</form> 

	</div>
</section>