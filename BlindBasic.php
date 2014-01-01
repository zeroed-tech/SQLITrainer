<?php
include_once "include.inc.php";
generateHeader();
?>


<div id="main">
	<p id="challenge"><b>Challenge:</b> Find the username of the current database user.</p>
	<p id="header"><b>Source:<br /></b></p>
	<script type="syntaxhighlighter" class="brush: php; gutter: false;">
	<![CDATA[
	//It's called Blind injection for a reason
	]]>
	</script>

	
	<form id="form" method="POST">
		<ul>
			<li><label for="name">Enter your friends name to add them to your contacts:</label></li>
			<li><input id="name" name="name" type="text" /></li>
		</ul>
	</form>
	<button type="button" id="add" value="Add" class="loginButton">Add</button>
	<h2>Query timer: <span id="timer"></span></h2>
</div>

<script type="text/javascript">
	function updateTime(){
		var now = Date.now();
		var delta = now - offset;
		offset = now;
		clock += delta;
		$("#timer").html(clock/1000);
	}
	$("#add").click(function(){
		offset = Date.now();
		clock = 0;
		interval = setInterval(updateTime, 1);
		$.post("processquery.php", {
			level: 5,
			name: $("#name").val(),
		}, handleResponse
		);
	});
</script>

<?php
generateFooter(false);
?>
