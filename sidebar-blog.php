<div class="col-md-3 sidebar">
	<div class="blogbar">
	<div class="bios">
	<br><br>
	<?php if ( ! dynamic_sidebar( 'blog' ) ): ?>
	
	<h3>Sidebar Setup</h3>
	<p>Please add widgets to the blog sidebar to have them display here.</p>	

	<?php endif; ?>
	<hr/>
	</div>

<!-- LOG IN OR REGISTER / LOG OUT -->

	<?php if ( is_user_logged_in () ) : ?>
<?php 
	$current_user = wp_get_current_user();
	echo '<p>Logged in as <a href="http://capracove.com/wp-admin/profile.php" style="color: #ffcfb9">' . $current_user->user_login . '</a>.'
	?>
	<a href="<?php echo wp_logout_url(  'http://capracove.com/blog' ); ?>" style="color: #ffcfb9">Log out?</a><br></p>

<!-- 
<a href="http://capracove.com/wp-admin/profile.php" style="color: #ffcfb9">Manage User Profile</a><br></p> -->
<?php else : ?>
	<p><a href="<?php echo wp_login_url(); ?>" style="color: #ffcfb9">Login</a> or <a href="http://capracove.com/wp-login.php?action=register" style="color: #ffcfb9">Register</a> to comment.<br></p>
<?php endif; ?>
	</div>
</div>