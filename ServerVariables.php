<?php
include_once "include.inc.php";
generateHeader();
if(isset($_COOKIE["SQLITraining"])){
	setrawcookie('SQLITraining', '');
}
?>


<div id="main">
	<p id="challenge"><b>Challenge:</b> Dump all user account information</p>
	<p id="header">
		<b>Source:</b>
	</p>


	<script type="syntaxhighlighter" class="brush: php; gutter: false;">
	<![CDATA[
		//Read post vars and server vars into local vars to make things more readable. Also escape all user provided data to prevent SQLI
		$title = mysqli_real_escape_string($con,$_POST["title"]);
		$message = mysqli_real_escape_string($con,$_POST["message"]);
		$ip = $_SERVER["REMOTE_ADDR"];
		$useragent = $_SERVER["HTTP_USER_AGENT"];
		//Build statement and run
		$sql = "INSERT INTO ServerVariables (title, message, userip, useragent, verified) VALUES ('$title', '$message', '$ip', '$useragent', false);";
		$result = mysqli_query($con, $sql);
		...
		//Read all blog posts belonging to the user or the admin but only if they are verified
		$sql = "SELECT * FROM ServerVariables WHERE verified = true AND userip = '$ip' or userip = '127.0.0.1'";
		$result = mysqli_query($con, $sql);
		...
		$queryresult = array();
		while($row = mysqli_fetch_assoc($result)){
			$queryresult[] = $row;
		}
		$return["queryRes"] = $queryresult;
		//If more than one result was returned then print all results (ie if you've successfuly injected into the database)
		if(count($queryresult) > 1){
			echo json_encode($return);
		}
	]]>

	</script>

	<h2>Hax0r Bl0g</h2>
	<p>Welcome to the Hax0r Bl0g. This is an open blog so feel free to post anything that you thing other l33t hax0rs will like.</p>
	<form id="loginform" method="POST">
		<ul>
			<li><label for="title">Title:</label></li>
			<li><input id="title" name="title" type="text" /></li>
			<li><label for="message">Message:</label></li>
			<li><textarea id="message" name="message"></textarea></li>
		</ul>
	</form>
	<button type="button" id="register" value="Submit" class="loginButton">Register</button>
	<p>
		All posts will be verified by an admin before being added to the blog<br />
		All posters useragents and IP addresses will be stored and any attempts to hack this blog will be met with severe revenge
	</p>
</div>

<script type="text/javascript">
	$("#register").click(function(){
		$.post("processquery.php", {
			level: 4,
			title: $("#title").val(),
			message: $("#message").val()
		}, handleResponse
		);
	});
</script>

<?php
generateFooter();
?>
