<?php
if(isset($_SESSION['username'])) {
	require_once("components/scripts/display_issues.php");
	echo '
		<br /><br />
		<h1 class="content-subhead">New Issues <span style="float:right">
				
		';
		if(!isset($_GET['d']) || empty($_GET['d'])) $d = ''; else $d = '&d='.$_GET['d'];
		
		if(!isset($_GET['order']) || empty($_GET['order'])) {
			echo '<a href="admin.php?p=new_issues'.$d.'&order=asc">(ASC)</a>';
			$order = 'desc';
		} else {
			if($_GET['order']=='asc') {
				echo '<a href="admin.php?p=new_issues'.$d.'&order=desc">(DESC)</a>';
				$order = 'asc';
			} elseif($_GET['order']=='desc') {
				echo '<a href="admin.php?p=new_issues'.$d.'&order=asc">(ASC)</a>';
				$order = 'desc';
			}
		}
		echo '
				<select name="department" 
				onchange="
				location = this.options[this.selectedIndex].value;
				">
					<option selected="selected">
		';
	if(!isset($_GET['d']) || empty($_GET['d'])) echo "Sort by department";
	else echo str_replace('_',' ',str_replace('and','&',$_GET['d']));
		
	echo '			</option>
					<option></option>
					<option value="admin.php?p=new_issues&d=nofilter">All</option>
					<option value="admin.php?p=new_issues&d=Business_Administration">Business Administration</option>
					<option value="admin.php?p=new_issues&d=Customer_Service">Customer Service</option>
					<option value="admin.php?p=new_issues&d=Indirect_Taxation">Indirect Taxation</option>
					<option value="admin.php?p=new_issues&d=Infrastructure">Infrastructure</option>
					<option value="admin.php?p=new_issues&d=Location_Management_Unit_Gujrath,_Goa">Location Management Unit Gujrath, Goa</option>
					<option value="admin.php?p=new_issues&d=Manufacturing">Manufacturing</option>
					<option value="admin.php?p=new_issues&d=Manufacturing_Units,_Healthcare_Goa">Manufacturing Units, Healthcare Goa</option>
					<option value="admin.php?p=new_issues&d=Operational_Product_Management_Mobile_Units">Operational Product Management Mobile Units</option>
					<option value="admin.php?p=new_issues&d=Operational Product_Management_Tables_and_Generators">Operational Product Management Tables & Generators</option>
					<option value="admin.php?p=new_issues&d=Product_Life_Cycle_Management_Imaging">Product Life Cycle Management Imaging</option>
					<option value="admin.php?p=new_issues&d=Product_Life_Cycle_Management_Realize">Product Life Cycle Management Realize</option>
					<option value="admin.php?p=new_issues&d=Quality_Management">Quality Management</option>
					<option value="admin.php?p=new_issues&d=Strategic_Procurement">Strategic Procurement</option>
					<option value="admin.php?p=new_issues&d=Supply_Chain_Management_Enable">Supply Chain Management Enable</option>
					<option value="admin.php?p=new_issues&d=Supply_Chain_Management_Deliver">Supply Chain Management Deliver</option>
					<option value="admin.php?p=new_issues&d=Supply_Chain_Management_Make">Supply Chain Management Make</option>
					<option value="admin.php?p=new_issues&d=Supply_Chain_Management_Plan">Supply Chain Management Plan</option>
					<option value="admin.php?p=new_issues&d=Supply_Chain_Management_RS">Supply Chain Management RS</option>
					<option value="admin.php?p=new_issues&d=Supply_Chain_Management_Source">Supply Chain Management Source</option>
					<option value="admin.php?p=new_issues&d=Uptime_Service">Uptime Service</option>
				</select></span></h1>
	<br /><br />
	<table class="pure-table" id="list">
		<thead>
		<tr>
			<th>Ticket no.</th>
			<th>Name</th>
			<th>Registered on</th>
			<th>Department</b></th>
		</tr>
		</thead>
		<tbody>
	';
	if(!isset($_GET['page']) || $_GET['page']==1) {$page=0;} else {$page=$_GET['page']-1;}
	if(isset($_GET['d']) && !empty($_GET['d'])) display_new_issues($_GET['d'],$order,$page);
	else display_new_issues("nofilter",$order,$page);
	echo '
	</tbody>
	</table>
	<br /><br />
	<ul class="pure-paginator">
	<li><a class="pure-button prev" href="admin.php?p='.$_GET['p'].$d.'&order='.$order.'&page='.($page==0||$page==1?1:$page-1).'">&#171;</a></li> '
	.paginate('new_issues',$d, $order).
	' <li><a class="pure-button next" href="admin.php?p='.$_GET['p'].$d.'&order='.$order.'&page='.($page==0?2:$page+1).'">&#187;</a></li>
	</ul>
	<br />
	';
} else {
	echo "<br /><br />";
	include("pages/admin/admin_login.php");
}

?>