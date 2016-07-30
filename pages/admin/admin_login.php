<?php
if(isset($_POST['submit'])) {
	require_once("components/scripts/user.php");
	if(user_exists($_POST['username'],md5($_POST['password']))) {
		require_once("components/scripts/login.php");
		login($_POST['username']);
		echo '
			<br />
			<h1 class="content-subhead">Success</h1>
				<h3>Welcome, '.ucwords(get_user_detail_by_username($_POST['username'],'firstname')).'</h3>
			';
	} else {
		echo '
			<br />
			<h1 class="content-subhead">Invalid username</h1>
			<br /><br />
				<form action="admin.php?p=admin_login" method="post" id="login" class="pure-form">
					<label for="username">Username: </label>
					<br />
					<input type="text" name="username" maxlength="14" placeholder="in002\" />
					<br /><br />
					<label for="password">Password: </label>
					<br />
					<input type="password" name="password" />
					<br /><br />
					<input type="submit" name="submit" value="Login" class="pure-button pure-button-primary" />
				</form>
					<br /><br />
		';
	}
	
} else {
	if(!isset($_SESSION['username'])) {
?>
<br />
<form action="admin.php?p=admin_login" method="post" id="login" class="pure-form">
	<h1 class="content-subhead">Administrator Login</h1>
	<br /><br />
	<label for="username">Username: </label>
	<br />
	<input type="text" name="username" maxlength="14" placeholder="in002\" />
	<br /><br />
	<label for="password">Password: </label>
	<br />
	<input type="password" name="password" />
	<br /><br />
	<input type="submit" name="submit" value="Login" class="pure-button pure-button-primary" />
</form>
<br /><br />
<?php
	} else {
		include("home.php");
	}
}
?>