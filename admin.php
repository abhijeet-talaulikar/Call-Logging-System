<?php
session_start();
require_once("config.php");
require_once("components/scripts/navigation.php");
require_once("components/scripts/get_number_of_new_issues.php");
require_once("components/scripts/get_number_of_issues.php");
require_once("components/scripts/paginate.php");
require_once("components/scripts/mail/send_mail.php");
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A layout example that shows off a blog page with a list of posts.">
		<title><?php echo load_title();?> &ndash; Siemens</title>
		<link rel="stylesheet" href="components/css/pure.css">
		<link rel="stylesheet" href="components/css/layout.css">
	<!--[if lte IE 8]>
        <link rel="stylesheet" href="components/css/main-grid-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="components/css/main-grid.css">
    <!--<![endif]-->
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="components/css/layouts/blog-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="components/css/layouts/blog.css">
    <!--<![endif]-->
	<script type="text/javascript" src="components/js/jquery.js"></script>
	<script type="text/javascript" src="components/js/mark_as_resolved.js"></script>
	</head>
	<body>
<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-med-1-4">
        <div class="header">
            <hgroup>
                <h1 class="brand-title">CALL LOGGING SYSTEM</h1>
            </hgroup>
			<br />
            <nav class="nav">
                <ul class="nav-list">
				<?php
				if(isset($_SESSION['username'])) {
                    echo '<a class="pure-button" href="admin.php?p=logout">Logout</a>';
				}
				?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="content pure-u-1 pure-u-med-3-4">
        <div class="post">
			<div class="pure-menu pure-menu-open pure-menu-horizontal">
			<a class="pure-menu-heading">Control Panel</a>
			<ul>
				<li
				<?php
				if(!isset($_GET['p']) || empty($_GET['p']) || $_GET['p']=="home"){
				echo 'class="pure-menu-selected"';
				}
				?>
				><a href="admin.php?p=home">Home</a></li>
				<li
				<?php
				if(isset($_GET['p']) && $_GET['p']=="new_issues"){
				echo 'class="pure-menu-selected"';
				}
				?>
				><a href="admin.php?p=new_issues">New Issues
				<span style="color:red;">
				<?php
				if(isset($_SESSION['username'])) echo "(".get_number_of_new_issues().")";
				?>
				</span>
				</a></li>
				<li
				<?php
				if(isset($_GET['p']) && $_GET['p']=="resolved_issues"){
				echo 'class="pure-menu-selected"';
				}
				?>
				><a href="admin.php?p=resolved_issues">Resolved Issues</a></li>
				<li
				<?php
				if(isset($_GET['p']) && $_GET['p']=="search"){
				echo 'class="pure-menu-selected"';
				}
				?>
				><a href="admin.php?p=search">Search</a></li>
				<li
				<?php
				if(isset($_GET['p']) && $_GET['p']=="statistics"){
				echo 'class="pure-menu-selected"';
				}
				?>
				><a href="admin.php?p=statistics">Statistics</a></li>
			</ul>
		</div>
			<?php load_admin_page(); ?>           
        </div>
    </div>
</div>
</body>
</html>
