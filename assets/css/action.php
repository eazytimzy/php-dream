
<?php 
//server connection details
		$servername = "localhost";//insert the name of your server
		$username = "root"; //insert your mysql username
		$password = "Eazytimzy22553"; //insert your password
		$dbname = "dreamland-emails"; //insert your database name

		//establish new connection to mysql database
		$conn = new mysqli($servername, $username, $password, $dbname);

		$email = $error = $responseMsg = "";

		//test input to ensure it is secure and free from any form of injections
		function test($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		/*uncomment this block of code if you want to create the table where the emails will be stored, don't bother if you
		already have the table*/

	// 	$table = "CREATE TABLE mails (
	// 		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	// 		mails VARCHAR(100) NOT NULL
	// )";

	// if($conn->query($table) == true) {
	// 	echo "Table created";
	// } else {
	// 	echo "Error creating " .$conn->error;
	// }

		//when the submit button is clicked
		if(isset($_POST["submit"])) {
		//if mail field is empty	
			if(empty($_REQUEST["email"])) {
				$error = "The mail field is required";
			} else {
				$email = test($_REQUEST["email"]);

				//checks if email is a valid address
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$error = "Invalid email format";
				} else {
					//inserts validated email value to database and returns response message
					$sql = "INSERT INTO mails (mail) VALUES ('$email')";
					$conn->query($sql);
					
					//return response message
					$responseMsg ="Thank you, we promise to reach out";
				}
			}
		}

	?>