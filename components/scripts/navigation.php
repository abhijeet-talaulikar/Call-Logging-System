<?php
//page navigation settings
function load_page() {
	if(isset($_GET['p']) && !empty($_GET['p'])) {
		$page = $_GET['p']; //p parameter in the URL
		if(!file_exists("pages/".$page.".php")) $page="404";
	} else {
		$page= "home";
	}
	include("pages/".$page.".php");
}
function load_admin_page() {
	if(isset($_GET['p']) && !empty($_GET['p'])) {
		$page = $_GET['p']; //p parameter in the URL
		if(!file_exists("pages/admin/".$page.".php")) $page="404";
	} else {
		$page= "home";
	}
	if(!isset($_SESSION['username'])) $page="admin_login";
	include("pages/admin/".$page.".php");
}
function load_title() {
	if(isset($_GET['p']) && !empty($_GET['p'])) {
		$page = $_GET['p']; //p parameter in the URL
	} else {
		$page= "home";
	}
	echo ucwords(str_replace('_',' ',$page));
}
//end

?>