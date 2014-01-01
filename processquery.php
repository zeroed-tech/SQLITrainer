<?php
include_once "include.inc.php";

$con = db_connect();
switch($_POST["level"]){
	//Level 1 - No Protection
	case '1':{
		if(isset($_POST["username"])){
			$user = $_POST["username"];
			$pass = md5($_POST["password"]);
			$sql = "SELECT * FROM NoProtection WHERE username = '$user' AND password = '$pass';";
			$result = mysqli_query($con, $sql);
			if(!$result){
				$return = array("state" => 1,
					"sqlQuery" => $sql,
					"message" => mysqli_error($con));
				echo json_encode($return);
				return;
			}

			$return = array();
			$return["state"] = 0;
			$return["sqlQuery"] = $sql;

			$queryresult = array();

			while($row = mysqli_fetch_assoc($result)){
				$queryresult[] = $row;
			}

			$return["queryRes"] = $queryresult;

			echo json_encode($return);
		}
		break;
	}
	case '2':{//EscapeQuery
		if(isset($_POST["username"])){
			//Read POST vars into easier to use variables and
			//Escape all special characters to prevent anyone from performing SQLI
			$user = mysqli_real_escape_string($con, $_POST["username"]);
			$pass = mysqli_real_escape_string($con, md5($_POST["password"]));
			$yob = mysqli_real_escape_string($con, $_POST["yob"]);
			//Create SQL query string
			$sql = "SELECT * FROM EscapeQuery WHERE username = '$user' AND password = '$pass' AND yob = $yob;";
			

			$result = mysqli_query($con, $sql);
			if(!$result){
				$return = array("state" => 1,
					"sqlQuery" => $sql,
					"message" => mysqli_error($con));
				echo json_encode($return);
				return;
			}

			$return = array();
			$return["state"] = 0;
			$return["sqlQuery"] = $sql;

			$queryresult = array();

			while($row = mysqli_fetch_assoc($result)){
				$queryresult[] = $row;
			}

			$return["queryRes"] = $queryresult;

			echo json_encode($return);
		}
		break;
	}
	case '3':{//Cookies
		if(!isset($_COOKIE["SQLITraining"])){
			$cookieVal = base64_encode("username=bob&password=".md5("I like apples"));
			setrawcookie('SQLITraining', $cookieVal);
			$return = array("state" => 1,
				"sqlQuery" => "None",
				"message" => "No cookie was received, cookie has now been set");
			echo json_encode($return);
			return;
		}
		$cookie = explode("&",base64_decode($_COOKIE["SQLITraining"]));
		$user = explode("=", $cookie[0])[1];
		$pass = explode("=", $cookie[1])[1];
		$sql = "SELECT * FROM Cookies WHERE username = '$user' AND password = '$pass';";
		$result = mysqli_query($con, $sql);
		if(!$result){
			$return = array("state" => 1,
				"sqlQuery" => $sql,
				"message" => mysqli_error($con));
			echo json_encode($return);
			return;
		}

		$return = array();
		$return["state"] = 0;
		$return["sqlQuery"] = $sql;

		$queryresult = array();
		$newCookie = "";
		while($row = mysqli_fetch_assoc($result)){
			$queryresult[] = $row;
			$newCookie .= "username=".$row["Username"]."&password=".$row["Password"];
		}

		setrawcookie('SQLITraining', base64_encode($newCookie));

		$return["queryRes"] = $queryresult;

		echo json_encode($return);
		break;
	}
	case '4':{//ServerVariables
		if(isset($_SERVER["HTTP_USER_AGENT"])){
			
			$title = mysqli_real_escape_string($con,$_POST["title"]);
			$message = mysqli_real_escape_string($con,$_POST["message"]);
			$useragent = $_SERVER["HTTP_USER_AGENT"];
			$ip = $_SERVER["REMOTE_ADDR"];

			$sql = "INSERT INTO ServerVariables (title, message, userip, useragent, verified) VALUES ('$title', '$message', '$ip', '$useragent', false);";

			$result = mysqli_query($con, $sql);
			if(!$result){
				$return = array("state" => 1,
					"sqlQuery" => $sql,
					"message" => mysqli_error($con));
				echo json_encode($return);
				return;
			}

			$return = array();
			$return["state"] = 0;
			$return["sqlQuery"] = $sql;

			//$return["queryRes"] = "Executed Successfully";

			$sql = "SELECT * FROM ServerVariables WHERE verified = true AND userip = '$ip' or userip = '127.0.0.1'";
			$result = mysqli_query($con, $sql);
			if(!$result){
				$return = array("state" => 1,
					"sqlQuery" => $sql,
					"message" => mysqli_error($con));
				echo json_encode($return);
				return;
			}

			$queryresult = array();
		
			while($row = mysqli_fetch_assoc($result)){
				$queryresult[] = $row;
			}

			$return["queryRes"] = $queryresult;

			if(count($queryresult) > 1){
				echo json_encode($return);
			}
		}
		break;
	}
	case '5':{
		if(isset($_POST["name"])){

			$sql = "SELECT * FROM BlindBasic WHERE name = '".$_POST["name"]."';";
			mysqli_query($con, $sql);
			$return = array("state" => 1,
				"sqlQuery" => "Not telling",
				"message" => "Received query @ ". date('H:i:s'));
			echo json_encode($return);
			return;
		}
		break;
	}
}

mysqli_close($con);


?>
