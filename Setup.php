<?php
include_once "include.inc.php";
generateHeader(true, "Enter the username and password of an account that has permission to create users, databased and tables on your MySQL server (usually root).");

if(isset($_POST["username"]) && isset($_POST["password"])){
	$username = $_POST["username"];
	$password = $_POST["password"];
	$address = "localhost";
	if(isset($_POST["address"]) && strlen($_POST["address"]) > 3){
		$address = $_POST["address"];
	}
	echo "<p>";
	$con = new mysqli($address, $username, $password,"SQLITraining");
	if(mysqli_connect_errno()){
		echo "Something went wrong with the database connection, please try again\n";
		return null;
	}
	echo "</p>";

	$handle = fopen("setup.sql", "r");
	if($handle){
		while(($line = fgets($handle)) !== false){
			$result = mysqli_query($con, $line);
			if(!$result){
				$error = mysqli_error($con);
				if($error == "Query was empty"){
					continue;
				}
				echo "<p>".$line."</p>";
				echo "<h2>".mysqli_error($con)."</h2>";
			}
		}
		fclose($handle);
		echo "<h2>Done</h2>";
		echo "<br />";
		echo '<a href="index.php">Home</a>';
	}

	mysqli_close($con);
} else {
	?>
	
	<div id="main">
	<h2>Setup</h2>
	<p>Enter credentials for your MySql database. You can optionaly enter the ip/hos tname of your server (default is localhost)</p>
	<form action="Setup.php" method="POST">
		<ul>
			<li><label for="username">Username:</label></li>
			<li><input id="username" name="username" type="text" /></li>
			<li><label for="password">Password:</label></li>
			<li><input id="password" name="password" type="text" /></li>
			<li><label for="address">Address:</label></li>
			<li><input id="address" name="address" type="text" /></li>
		</ul>
		<input id="setupSubmit" type="submit" value="Setup" />
	</form>
</div>
	<?php
}
?>