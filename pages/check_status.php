<?php
require_once("components/scripts/get_issue_detail.php");
if(isset($_POST['submit']) && issue_exists($_POST['ticket'])) {
		require_once("components/scripts/show_status.php");
		require_once("components/scripts/get_issue_detail.php");
		$status = show_status($_POST['ticket']) == 1 ? "Resolved " : "In process ";
		echo '<h1 class="content-subhead">Status: '.$status;
		if(show_status($_POST['ticket'])) echo "(on ".get_issue_detail($_POST['ticket'],'resolved_date').")";
		echo "</h1><br />";
		include("pages/admin/issue.php");
	
} else {
	if(isset($_POST['submit'])) echo "<form><h3>Issue does not exist</h3></form>";
?>
<form action="?p=check_status" method="POST" class="pure-form">
	<h1 class="content-subhead">Status</h1>
	<br /><br />
	<h4>Ticket number: (of your application) </h4>
	<input type="number" name="ticket" />
	<br /><br />
	<input type="submit" name="submit" value="Check" class="pure-button pure-button-primary" />
	<br /><br />
	<a href="?p=retrieve_ticket">Forgot your number?</a>
</form>
<br /><br />
<?php
}
?>