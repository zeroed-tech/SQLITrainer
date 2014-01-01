<?php
include_once "include.inc.php";
generateHeader(true, "While you need a ' to close a string you only need a space to close a number.");
?>


<div id="main">
	<p id="challenge"><b>Challenge:</b> Dump all user account information</p>
	<p id="header">
		<b>Source:</b>
	</p>


	<script type="syntaxhighlighter" class="brush: php; gutter: false;">
	<![CDATA[
	//Read POST vars into easier to use variables and
	//Escape all special characters to prevent anyone from performing SQLI
	$user = mysqli_real_escape_string($con, $_POST["username"]);
	$pass = mysqli_real_escape_string($con, md5($_POST["password"]);
	$yob = mysqli_real_escape_string($con, $_POST["yob"]);
	//Create SQL query string
	$sql = "SELECT * FROM EscapeQuery WHERE username = '$user' AND password = '$pass' AND yob = $yob;";
	]]>
	</script>
		
	</p>
	<form id="loginform" method="POST">
		<ul>
			<li><label for="username">Username:</label></li>
			<li><input id="username" name="username" type="text" /></li>
			<li><label for="password">Password:</label></li>
			<li><input id="password" name="password" type="text" /></li>
			<li><label for="yob">Birth Year:</label></li>
			<li><input id="yob" name="yob" type="text" value="0" /></li>
		</ul>
	</form>
</div>

<script type="text/javascript">
$("input").each(function(){
	$(this).keyup(function(){
		$.post("processquery.php", {
			level: 2,
			username: $("#username").val(),
			password: $("#password").val(),
			yob: $("#yob").val()
		}, handleResponse
		);
	});
});

</script>

<?php
generateFooter();
?>
