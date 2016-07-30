<?php
if(isset($_GET['name'])) {
	$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$offset = (empty($_GET['page']) || !isset($_GET['page'])) ? 0 : $_GET['page']-1;
	try {
		
			$stmt = $db->query("SELECT * FROM `issues` WHERE `name` LIKE '%".strtolower($_GET['name'])."%' LIMIT ".($offset*10).",10;");
		
			if($_GET['status']=="in_process")
				$stmt = $db->query("SELECT * FROM `issues` WHERE `resolved_date`='' AND `name` LIKE '%".strtolower($_GET['name'])."%' LIMIT ".($offset*10).",10;");
			elseif($_GET['status']=="resolved")
				$stmt = $db->query("SELECT * FROM `issues` WHERE `resolved_date`!='' AND `name` LIKE '%".strtolower($_GET['name'])."%' LIMIT ".($offset*10).",10;");
		
		
		echo '
		
			<h3>Keyword &nbsp; - &nbsp; \''.$_GET['name'].'\'
						<form action="admin.php" method="GET" class="pure-form" style="padding:0px;display:inline;float:right;">
							<input type="hidden" name="p" value="search_by_name" />
							<input type="text" name="name" placeholder="search for" />
							<select name="status">
								<option value="" selected="selected">All</option>
								<option value="in_process">In process</option>
								<option value="resolved">Resolved</option>
							</select>
							<input type="submit" value=" Go " class="pure-button pure-button-primary" />
						</h3>
						<br /><br />
			<table id="list" class="pure-table">
			';
		if(!$stmt->rowCount()) echo "<tr><th>No results were returned.</th></tr>";
		else {
			echo '
				<thead>
				<tr>
					<th>Ticket no.</th>
					<th>Name</th>
					<th>Registered on</th>
					<th>Department</th>
					<th>Resolved on</th>
				 </tr>
				</thead>
				<tbody>
				';
		}
		$i=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$i++;
			if($i%2 !=0 ) $attr = ' class="pure-table-odd"'; else $attr = '';
			echo '<tr'.$attr.'>';
			echo '<td>'.$row['ticket'].'</td>';
			echo '<td><a href="admin.php?p=issue&ticket='.$row['ticket'].'" title="Click to view synopsis">'.ucwords($row['name']).'</a></td>';
			echo '<td>'.$row['date'].'</td>';
			echo '<td>'.$row['department'].'</td>';
			echo '<td>';
			if(!empty($row['resolved_date'])) echo $row['resolved_date']; else echo "In process";
			echo '</td>';
			echo "</tr>";
		}
		$status = isset($_GET['status'])?$_GET['status']:'All';
		if(!isset($_GET['page']) || $_GET['page']==1) $page=1; else $page =$_GET['page'];
		echo '</tbody></table>
		<br /><br />
		<ul class="pure-paginator">
		<li><a class="pure-button" href="admin.php?p=search_by_name&name='.$_GET['name'].'&status='.$_GET['status'].'&page='.(($page-1)==0?1:$page-1).'">&#171;</a></li>'
		.paginate_search($status).
		'<li><a class="pure-button" href="admin.php?p=search_by_name&name='.$_GET['name'].'&status='.$_GET['status'].'&page='.($page+1).'">&#187;</a></li>
		</ul>
		
		';
	} catch (PDOException $e) {
		die("Error");
	}
}
?>