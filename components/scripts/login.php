<?php
//main login function
function login($username) {
	$_SESSION['username'] = $username;
	$_SESSION['name'] = get_user_detail($username,'firstname');
}
?>