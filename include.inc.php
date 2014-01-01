<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
date_default_timezone_set('Australia/Melbourne');

function generateHeader(){
	error_reporting(E_ALL);
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>SQLi Training Tool</title>
			<link rel="stylesheet" type="text/css" href="/SQLITraining/css/style.css">

			<link type="text/css" rel="Stylesheet" href="/SQLITraining/css/shThemeMidnight.css"/>
			<link type="text/css" rel="Stylesheet" href="/SQLITraining/css/shCoreMidnight.css"/>

			<script src="/SQLITraining/scripts/jquery-2.0.3.min.js"></script>
			<script src="/SQLITraining/scripts/script.js"></script>
			<script src="/SQLITraining/scripts/shCore.js"></script>
			<script src="/SQLITraining/scripts/shBrushPhp.js"></script>
		</head>
		<body>
	<?php
}

function generateFooter($showQuery = true){
	?>

			<!-- Everything below this line is not a target and is here purely for informational purposes -->
			<hr />

			<div id="resultPane">
				<?php
				if($showQuery){
					?>
					<p><b>Query run on database: </b></p>
					<span id="sqlQuery"></span>
				<?php
				}
				?>
				<p><b>Result: </b></p>
				<span id="queryResult"></span>
				
			</div>
			<script type="text/javascript">
		    	SyntaxHighlighter.all()
			</script>
				
		</body>

	</html>

	<?php
}

function db_connect($level = 1){
	$username = "";
	switch ($level) {
		case 1:{
			$username = "NoProtection";
			$password = "WllIFvA9YImLIb1L9XZYTEeuBfNuE8KxhS1aXdf6AEFzUCVy5HRP9PurkmSxEXk";
			break;
		}
		case 2:{
			$username = "EscapeQuery";
			$password = "7dBAg4sORWnLqN1QzxhTDin37UM8fEDfGw5ArMCQHLGeUeqm4yZ09sTK82iQKbb";
			break;
		}
		case 3:{
			$username = "Cookies";
			$password = "sNg2XGgenMPH97sXlENkozd17wzutwo8MzVENrK9famH6d8yxKYgmvtTpb041ir";
			break;
		}
		case 4:{
			$username = "ServerVariables";
			$password = "lbdfHjmPNPmwy20ZJ6w0a5jvUBLRBIGqesKbUVQzeUUHIbRTJ2hFFvVpG4EBLvB";
			break;
		}
		case 5:{
			$username = "BasicBlind";
			$password = "QCmy9hSSIk68o0u83JN1DKqZA9aMehgiIexcB4ihnj32J7Q6QPziUKMeyvzP41K";
			break;
		}
		default:
			$username = "error";
			$password = "error";
			break;
	}

	$con = new mysqli("localhost", $username, $password,"SQLITraining");

	if(mysqli_connect_errno()){
		echo "<h2>Something went wrong with the database connection, please try again</h2>\n";
		return null;
	}
	return $con;
}

//Verifys username in doesnt exist in current database
//Returns True if username is available
function usernameAvailable($username, $con){
	$stmt = $con->prepare('SELECT * FROM users WHERE username = ?');
	if(!$stmt){
		echo "<p class=error>Something went wrong with the database while verifying your username was available</p>\n";
		return;
	}
	$stmt->bind_param('s', $username);
	$stmt->execute();
	$stmt->store_result();

	return (mysqli_stmt_num_rows($stmt) == 0) ? True : False;
}

?>