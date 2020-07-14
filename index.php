  <!DOCTYPE html>
<html>
<head>
  <title>Dreamland-Landing page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet'>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
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




          <div class="container-fluid p-0" id="mainbody">
            <a href="#" class="navbar-brand pl-5"><h1 class=""><img src="./assets/images/frame 3.svg" alt="logo.svg"></h1></a>
                <div class="form-sect">
                  <h2>Enter email address: </h2>
	                	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
		                  	<input type="text" name="email" placeholder="Enter email" value="<?php echo $email ?>"><br>
		                      	<span class="error"><?php echo $error ?></span><!-- show errors if any --><br>
		                        	<button type="submit" name="submit">YES! KEEP ME UPDATED</button>
		                          	<br>
			                              <span><?php echo $responseMsg ?></span><!-- returns response message -->
                 </form>		
            </div>

     </div>








    
    <script src="./assets/javascript/main.js"></script>
</body>
</html>