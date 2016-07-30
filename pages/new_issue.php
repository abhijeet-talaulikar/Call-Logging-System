<?php
require_once("components/scripts/submit_new_issue.php");
require_once("components/scripts/format_date.php");
require_once("components/scripts/validate_form.php");
if(isset($_POST['submit'])) {
	if(validate_form($_POST)) {
		submit_new_issue($_POST);
		echo '
		<h1 class="content-subhead">Success</h1>
		<h3>Thank you, '.ucwords(strtolower($_POST['name'])).'</h3>
		<h3>The concerned authorities will be notified.</h3>
		<br />
		';
	} else {
?>
<form action="?p=new_issue" method="POST" id="new" class="pure-form">
	<h4>Please fill in all the fields.</h4>
	<h4>See that the code is entered correctly.</h4>
	<h1 class="content-subhead">Register new issue</h1>
	<input type="hidden" name="ticket" value="<?php echo set_ticket(); ?>" />
	<table id="new_issue">
		<tr>
			<td><b>Ticket no:</b></td>
			<td><?php echo set_ticket(); ?></td>
		</tr>
		<tr>
			<td>Network Login:</td>
			<td>in002 \ &nbsp; <input type="text" autocomplete="off" name="network_login" onchange="populate(this.value);" maxlength="8" id="network_login" /></</td>
		</tr>
		<tr>
			<td>Name:</td>
			<td><input type="text" id="name" disabled="disabled" /><input type="hidden" name="name" /></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="email" id="email" disabled="disabled" /><input type="hidden" name="email" /></td>
		</tr>
		<tr>
			<td>Telephone:</td>
			<td><input type="text" id="telephone" disabled="disabled" /><input type="hidden" name="telephone" /></td>
		</tr>
		<tr>
			<td>Department:</td>
			<td>
				<input type="text" id="department" disabled="disabled" /><br /><br />
				<input type="text" id="department_text" disabled="disabled" />
				<input type="hidden" name="department" /><input type="hidden" name="department_text" />
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Fill in some details about the incident<br />below</td>
		</tr>
		<tr>
			<td>Date: </td>
			<td><input type="text" name="date" value="<?php echo format_date(date("Y-m-d")); ?>"  disabled="disabled" /></td>
		</tr>
		<tr>
			<td>Time: </td>
			<td><input type="text" name="time" value="<?php echo date("h:i");?>"  disabled="disabled" /></td>
		</tr>
		<tr>
			<td>Issue related to: </td>
			<td>
				<select name="related_to">
					<option></option>
					<option value="ehs">EHS</option>
					<option value="infrastructure">Infrastructure</option>
					<option value="facility management">Facility Management</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Location:</td>
			<td><input type="text" name="location" autocomplete="off" /></td>
		</tr>
		<tr>
			<td>Description:</td>
			<td><textarea name="description" form="new" rows="15" cols="70" placeholder="type your description here.."></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><img src="components/scripts/captcha.php" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="number" name="captcha" placeholder="Enter the code you see" /></td>
		</tr>
		<tr></tr>
		<tr>
		<td></td>
		<td>
			<input type="submit" name="submit" value="Submit" class="pure-button pure-button-primary" /> &nbsp;&nbsp;
			<input type="reset" value="Clear" class="pure-button pure-button-primary" />
		</td>
		</tr>
	</table>
	<br />
</form>
<?php
	}
} else {
?>
<form action="?p=new_issue" method="POST" id="new" class="pure-form">
	<h1 class="content-subhead">Register new issue</h1>
	<input type="hidden" name="ticket" value="<?php echo set_ticket(); ?>" />
	<table id="new_issue">
		<tr>
			<td><b>Ticket no:</b></td>
			<td><?php echo set_ticket(); ?></td>
		</tr>
		<tr>
			<td>Network Login:</td>
			<td>in002 \ &nbsp; <input type="text" autocomplete="off" name="network_login" onchange="populate(this.value);" maxlength="8" id="network_login" /></</td>
		</tr>
		<tr>
			<td>Name:</td>
			<td><input type="text" id="name" disabled="disabled" /><input type="hidden" name="name" /></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="email" id="email" disabled="disabled" /><input type="hidden" name="email" /></td>
		</tr>
		<tr>
			<td>Telephone:</td>
			<td><input type="text" id="telephone" disabled="disabled" /><input type="hidden" name="telephone" /></td>
		</tr>
		<tr>
			<td>Department:</td>
			<td>
				<input type="text" id="department" disabled="disabled" /><br /><br />
				<input type="text" id="department_text" disabled="disabled" />
				<input type="hidden" name="department" /><input type="hidden" name="department_text" />
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Fill in some details about the incident<br />below</td>
		</tr>
		<tr>
			<td>Date: </td>
			<td><input type="text" name="date" value="<?php echo format_date(date("Y-m-d")); ?>"  disabled="disabled" /></td>
		</tr>
		<tr>
			<td>Time: </td>
			<td><input type="text" name="time" value="<?php echo date("h:i");?>"  disabled="disabled" /></td>
		</tr>
		<tr>
			<td>Issue related to: </td>
			<td>
				<select name="related_to">
					<option></option>
					<option value="ehs">EHS</option>
					<option value="infrastructure">Infrastructure</option>
					<option value="facility management">Facility Management</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Location:</td>
			<td><input type="text" name="location" autocomplete="off" /></td>
		</tr>
		<tr>
			<td>Description:</td>
			<td><textarea name="description" form="new" rows="15" cols="70" placeholder="type your description here.."></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><img src="components/scripts/captcha.php" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="number" name="captcha" placeholder="Enter the code you see" /></td>
		</tr>
		<tr></tr>
		<tr>
		<td></td>
		<td>
			<input type="submit" name="submit" value="Submit" class="pure-button pure-button-primary" /> &nbsp;&nbsp;
			<input type="reset" value="Clear" class="pure-button pure-button-primary" />
		</td>
		</tr>
	</table>
	<br />
</form>
<?php
}
?>