<?php
include_once "include.inc.php";
generateHeader();
?>


<div id="main">
	<p id="challenge"><b>Challenge:</b> Dump all user account information</p>
	<p id="header"><b>Source:<br /></b></p>
	<script type="syntaxhighlighter" class="brush: php; gutter: false;">
	<![CDATA[
	$user = $_POST["username"];
	$pass = md5($_POST["password"]);
	$sql = "SELECT * FROM NoProtection WHERE username = '$user' AND password = '$pass';";
	]]>
	</script>

	
	<form id="loginform" action="auth.php" method="POST">
		<ul>
			<li><label for="username">Username:</label></li>
			<li><input id="username" name="username" type="text" /></li>
			<li><label for="password">Password:</label></li>
			<li><input id="password" name="password" type="text" /></li>
		</ul>
	</form>
</div>

<script type="text/javascript">
$("input").each(function(){
	$(this).keyup(function(){
		$.post("processquery.php", {
			level: 1,
			username: $("#username").val(),
			password: $("#password").val()
		}, handleResponse
		);
	});
});

</script>

<?php
generateFooter();
?>
