<?php
include_once "include.inc.php";

function fail(){
	header('WWW-Authenticate: Basic realm="SQLI Trainer"');
    header('HTTP/1.0 401 Unauthorized');
    generateHeader(true, "Basic authentication isn't only for htaccess.");
    ?>
    <div id="main">
		<p id="challenge"><b>Challenge:</b> Login</p>
		<p id="header"><b>Source:<br /></b></p>
		<script type="syntaxhighlighter" class="brush: php; gutter: false;">
		<![CDATA[
		//Another blind one
		]]>
		</script>
		<p>Error logging in. Please refresh the page and try again</p>
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
    generateFooter(false);
}

if(isset($_POST['reset']) && $_POST['reset'] == true){
	unset($_POST['reset']);
	fail();
	return;
}

if(!isset($_SERVER['PHP_AUTH_USER']) || strlen($_SERVER['PHP_AUTH_USER']) < 1){
	fail();
} else {
	
	$user = $_SERVER['PHP_AUTH_USER'];
	$pass = md5($_SERVER['PHP_AUTH_PW']);
	$con = db_connect(6);
	$sql = "SELECT * FROM BasicAuth WHERE username = '$user' AND password = '$pass';";
	$result = mysqli_query($con, $sql);
	if(!$result){
		fail();
		return;
	}

	$queryresult = array();
	
	while($row = mysqli_fetch_assoc($result)){
		$queryresult[] = $row;
	}

	if(count($queryresult) > 0){
		generateHeader(true, "Basic authentication isn't only for htaccess.");
		?>
		<div id="main">
			<p>flag{Who is lazy enough to use this?}</p>
			<p><a href="#" id="reset">Reset</a> This will refresh the page and tell your browser that it has the wrong credentials in its cache so that the authentication dialog will pop up again.</p>
		</div>
		<script type="text/javascript">
			$("#reset").click(function(){
				$.post("BasicAuth.php", {
					reset: true,
				}, null
				);
			});
		</script>
		<?php
		return;
	}

	fail();
}
?>
