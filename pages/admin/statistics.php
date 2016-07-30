<br />
<h1 class="content-subhead">Statistics</h1>
<br />
<form class="pure-form" method="POST" action="admin.php?p=statistics">
	<h4>Select an interval</h4>
	<br />
	From &nbsp;&nbsp;<input type="date" name="from" id="from" />&nbsp;&nbsp;
	to &nbsp;&nbsp;<input type="date" name="to" id="to" />
	&nbsp;&nbsp; <input type="submit" name="submit" value="Generate" class="pure-button pure-button-primary" />
</form>
<br /><br />
<span id="num">
<?php
if(isset($_POST['submit']) && isset($_POST['from']) && isset($_POST['to']) && !(empty($_POST['from']) || empty($_POST['to']))) {
	echo 'Total issues: '.get_number_of_issues($_POST['from'],$_POST['to']).
	' &nbsp;&nbsp;&nbsp;(from '.format_date($_POST['from']).' to '.format_date($_POST['to']).')';
}
?>
</span>
<br />
<span id="month">
<?php
if(isset($_POST['submit']) && isset($_POST['from']) && isset($_POST['to']) && !(empty($_POST['from']) || empty($_POST['to']))) {
	$_SESSION['from']=$_POST['from'];
	$_SESSION['to']=$_POST['to'];
	if(get_number_of_issues($_POST['from'],$_POST['to'])) {
		echo '
			<p>Monthly stats:</p>
			<img src="components/scripts/graphs/get_monthly_stats.php" alt="No data available" />';
	}
}
?>
</span>
<br /><br />
<span id="department">
<?php
if(isset($_POST['submit']) && isset($_POST['from']) && isset($_POST['to']) && !(empty($_POST['from']) || empty($_POST['to']))) {
	if(get_number_of_issues($_POST['from'],$_POST['to'])) {
		echo '
			<p>Departmental stats:</p>
			<img src="components/scripts/graphs/get_departments_stats.php" alt="No data available" />';
	}
}
?>
</span>
<br /><br />