//AJAX function to mark an issue as resolved
function mark_as_resolved(ticket) {
	document.getElementById("mar").value = 'Wait..';
	document.getElementById("mar").disabled = true;
	var msg = document.getElementById("msg").value;
	$.post("components/scripts/mark_as_resolved.php", {ticket: ticket, message: msg}, function(data) {
		document.getElementById("mar").value = 'Resolved';
		document.getElementById('status').innerHTML="Resolved (on "+Date()+")";
	});
}