<?php
session_start();
require_once("config.php");
require_once("components/scripts/navigation.php");
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
	<script type="text/javascript" src="components/js/populate.js"></script>
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
                    <li class="nav-item">
                        <a class="pure-button" href="?p=new_issue">New Issue</a>
                    </li><br />
                    <li class="nav-item">
                        <a class="pure-button" href="?p=check_status">Check Status</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="content pure-u-1 pure-u-med-3-4">
        <div class="post">
             <?php load_page(); ?>           
        </div>
    </div>
</div>
</body>
</html>
