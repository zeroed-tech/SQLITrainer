<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
date_default_timezone_set('Australia/Melbourne');

function generateHeader($menubar = false, $hint = ""){
	error_reporting(E_ALL);
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>SQLi Training Tool</title>
			<link rel="stylesheet" type="text/css" href=<?php echo "css".DIRECTORY_SEPARATOR."style.css" ?> />

			<link type="text/css" rel="Stylesheet" href=<?php echo "css".DIRECTORY_SEPARATOR."shThemeMidnight.css" ?> />
			<link type="text/css" rel="Stylesheet" href=<?php echo "css".DIRECTORY_SEPARATOR."shCoreMidnight.css" ?> />

			<script src=<?php echo "scripts".DIRECTORY_SEPARATOR."jquery-2.0.3.min.js" ?> ></script>
			<script src=<?php echo "scripts".DIRECTORY_SEPARATOR."script.js" ?> ></script>
			<script src=<?php echo "scripts".DIRECTORY_SEPARATOR."shCore.js" ?> ></script>
			<script src=<?php echo "scripts".DIRECTORY_SEPARATOR."shBrushPhp.js" ?> ></script>
		</head>
		<body>
	<?php
	if($menubar){
		?>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="Setup.php">Setup</a></li>
				<li><a href="ScoreCard.php">Score Card</a></li>
				<li><a href="#">Levels</a>
					<ul>
						
						<li><a href="NoProtection.php">No Proction</a></li>
						<li><a href="EscapeQuery.php">Escaped Query</a></li>
						<li><a href="Cookies.php">Cookies</a></li>
						<li><a href="ServerVariables.php">Server Variables</a></li>
						<li><a href="BlindBasic.php">Blind Basic</a></li>
					</ul>
				</li>
				<li><a href="#" id="hintbutton">Hint</a></li>
			</ul>
		</nav>

		<div id="hintdiv">
			<div id="hintbody">
				<h2>Hint:</h2>
				<p><?php echo $hint; ?></p>
			</div>
		</div>

		<script type="text/javascript">
			$("#hintdiv").hide();
			$("#hintbutton").click(function(){
				$("#hintdiv").show();
			});
			$("#hintdiv").click(function(){
				$("#hintdiv").hide();
			});
		</script>
		<?php
	}
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
			$username = "sudo";
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
?>