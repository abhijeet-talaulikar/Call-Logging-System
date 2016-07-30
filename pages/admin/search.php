<?php
require_once("components/scripts/get_issue_detail.php");
if(isset($_GET['ticket']) && issue_exists($_GET['ticket'])) {
		require_once("components/scripts/show_status.php");
		require_once("components/scripts/get_issue_detail.php");
		$status = show_status($_GET['ticket']) == 1 ? "Resolved " : "In process ";
		echo '<br /><br /><h1 class="content-subhead">Status: ';
		echo '<span id="status">';
		echo $status;
		if(show_status($_GET['ticket'])) echo "(on ".get_issue_detail($_GET['ticket'],'resolved_date').")";
		echo "</span>";
		echo "</h1>";
		include("pages/admin/issue.php");
	
} else {
	if(isset($_GET['ticket'])) {echo "<h3>Issue does not exist</h3>";}
?>
	<br /><br />
		<form action="admin.php" method="GET" class="pure-form">
					<h1 class="content-subhead">Ticket number: </h1>
					<input type="hidden" name="p" value="search" />
					<input type="number" name="ticket" />
					<br /><br />
					<input type="submit" value=" Go " class="pure-button pure-button-primary" />
				</form>
				<br /><br />
				<form action="admin.php" method="GET" class="pure-form">
					<h1 class="content-subhead">Name: (of applicant) </h1>
					<input type="hidden" name="p" value="search_by_name" />
					<input type="text" name="name" autocomplete="off" />
					<select name="status">
						<option>All</option>
						<option value="in_process">In process</option>
						<option value="resolved">Resolved</option>
					</select>
					<br /><br />
					<input type="submit" value=" Go " class="pure-button pure-button-primary" />
		</form>
	<br /><br />
<?php
}
?>