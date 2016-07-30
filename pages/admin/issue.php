<?php
require_once("components/scripts/get_issue_detail.php");
$ticket = $_REQUEST['ticket'];
require_once("components/scripts/show_status.php");
?>

	<h3>Ticket no: <?php echo $ticket; ?></h3>
	<?php
	if($_GET['p']=="issue") {
		echo '<h1 class="content-subhead">Status: ';
		$status = show_status($_GET['ticket']) == 1 ? "Resolved " : "In process ";
		echo '<span id="status">';
		echo $status;
		if(show_status($_GET['ticket'])) echo "(on ".get_issue_detail($_GET['ticket'],'resolved_date').")";
		echo "</span>";
		echo "</h1>";
	}
	?>
	</h3>
	<table id="new_issue">
		<tr>
		<th>Name: </th>
		<td><?php echo ucwords(get_issue_detail($ticket,'name')); ?></td>
		</tr>
		<tr>
		<th>Email: </th>
		<td>
		<a href="mailto:<?php echo get_issue_detail($ticket,'email'); ?>"><?php echo get_issue_detail($ticket,'email'); ?></a>
		</td>
		</tr>
		<tr>
		<th>Date & Time: </th>
		<td><?php echo get_issue_detail($ticket,'date'); ?> , <?php echo get_issue_detail($ticket,'time'); ?></td>
		</tr>
		<tr>
		<th>Department: </th>
		<td><?php echo ucwords(get_issue_detail($ticket,'department')).'<br /><br />'.ucwords(get_issue_detail($ticket,'department_text')); ?></td>
		</tr>
		<tr>
		<th>Issue related to: </th>
		<td><?php echo ucwords(get_issue_detail($ticket,'related_to')); ?></td>
		</tr>
		<tr>
		<th>Location: </th>
		<td><?php echo get_issue_detail($ticket,'location'); ?></td>
		</tr>
		<tr>
		<th>Description: </th>
		<td><?php echo get_issue_detail($ticket,'description'); ?></td>
		</tr>
	</table>
	<br /><br />
	<?php
	if(!show_status($ticket)) {
		$fname = explode(" ",get_issue_detail($ticket,'name'));
		if(isset($_SESSION['username']) && ($_GET['p']=="search" || $_GET['p']=="issue")) {
			echo '
			<h1 class="content-subhead">Resolve it</h1>
			<p>Leave a message for '.ucwords($fname[0]).'</p>
			<textarea rows="10" cols="70" placeholder="type your message here.." id="msg"></textarea>
			<br /><br />
			';
			echo '<input type="button" class="pure-button pure-button-primary" value="Mark as Resolved" onclick="mark_as_resolved('.$ticket.');" id="mar" />';
		}
	}
	?>
	<br /><br />