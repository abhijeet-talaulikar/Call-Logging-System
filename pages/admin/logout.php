<?php
unset($_SESSION['username']);
session_destroy();
?>
<form>
<h3>You have logged out.</h3>
</form>
<br />
<?php
include("pages/admin/admin_login.php");
?>
<br /><br />