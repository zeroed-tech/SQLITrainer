<?php
include_once "include.inc.php";
generateHeader();

//Replace with post params
$username = "root";
$password = 'QfU%@EkF&bHlPQhoPsb^na*$YpO91l$*!W&HvNKSwrS^bU0QLL';

$con = new mysqli("localhost", $username, $password,"SQLITraining");

if(mysqli_connect_errno()){
	echo "<h2>Something went wrong with the database connection, please try again</h2>\n";
	return null;
}


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
}

mysqli_close($con);

?>