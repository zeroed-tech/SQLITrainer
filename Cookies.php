<?php
include_once "include.inc.php";
generateHeader(true, "People store some interesting things in cookies.");

if(!isset($_COOKIE["SQLITraining"])){
	$cookieVal = base64_encode("username=bob&password=".md5("I like apples"));
	setrawcookie('SQLITraining', $cookieVal);
}
?>


<div id="main">
	<p id="challenge"><b>Challenge:</b> Dump all user account information</p>
	<p id="header">
		<b>Source:</b>
	</p>


	<script type="syntaxhighlighter" class="brush: php; gutter: false;">
	<![CDATA[
		//Convert the cookie back to ascii then split into individual values
		$cookie = explode("&",base64_decode($_COOKIE["SQLITraining"]));
		//Extract username and password
		$user = explode("=", $cookie[0])[1];
		$pass = explode("=", $cookie[1])[1];
		//Prepair query
		$sql = "SELECT * FROM Cookies WHERE username = '$user' AND password = '$pass';";
		...
		$newCookie = "";
		//Loop through result set and build cookie
		while($row = mysqli_fetch_assoc($result)){
			$queryresult[] = $row;
			$newCookie .= "username=".$row["Username"]."&password=".$row["Password"];
		}
		//Set cookie
		setrawcookie('SQLITraining', base64_encode($newCookie));
	]]>
	</script>
	<button type="button" id="register" value="Submit" class="loginButton">Register</button>	
</div>

<script type="text/javascript">
	$("#register").click(function(){
		$.post("processquery.php", {
			level: 3,
		}, handleResponse
		);
	});
</script>

<?php
generateFooter();
?>
