<?php
	$msg = "";
$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

function encryptthis($data, $key) {
    $encryption_key = base64_decode($key);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

function decryptthis($data, $key) {
    $encryption_key = base64_decode($key);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

}
function validatePhoneNo($phone) {
    if(preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $phone))
        return true;
    else
        return false;
}
/*
$ccv = new CCValidator('JOHN JOHNSON', CCV_AMERICAN_EXPRESS, '378282246310005', 3, 2007);
if ($validCard = $ccv->validate()) {
    if ($validCard & CCV_RES_ERR_HOLDER) {
        echo 'Card holder\'s name is missing or incorrect.<br />';
    }
    if ($validCard & CCV_RES_ERR_TYPE) {
        echo 'Incorrect credit card type.<br />';
    }
    if ($validCard & CCV_RES_ERR_DATE) {
        echo 'Incorrect expiration date.<br />';
    }
    if ($validCard & CCV_RES_ERR_FORMAT) {
        echo 'Incorrect credit card number format.<br />';
    }
    if ($validCard & CCV_RES_ERR_NUMBER) {
        echo 'Invalid credit card number.<br />';
    }
} else {
    echo 'Credit card information is valid.<br />';
}*/
	if (isset($_POST['submit'])) {
		$con = new mysqli('localhost', 'root', '', 'java');

		$name = $con->real_escape_string($_POST['name']);
		$email = $con->real_escape_string($_POST['email']);
        $email = $con->real_escape_string($_POST['website']);
        $email = $con->real_escape_string($_POST['comment']);
        $email = $con->real_escape_string($_POST['phone']);
        $email = $con->real_escape_string($_POST['credit']);

        $password = $con->real_escape_string($_POST['password']);
		$cPassword = $con->real_escape_string($_POST['cPassword']);

        /*$name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password =trim($_POST['password']);
        $cPassword = trim($_POST['cPassword']);
        $name =htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $cPassword =htmlspecialchars($_POST['cPassword']);
        $name = stripslashes($_POST['name']);
        $email =stripslashes($_POST['email']);
        $password = stripslashes($_POST['password']);
        $cPassword =stripslashes($_POST['cPassword']);
// define variables and set to empty values
        $name = $email = $password = $cPassword =  "";
*/
/*
        if ($_SERVER["REQUEST_METHOD"] == "submit") {
            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $password = test_input($_POST['password']);
            $cPassword = test_input($_POST['password']);
        }
*/
        $nameErr = $emailErr = $genderErr = $websiteErr  =$phoneErr=$creditErr= "";
        $name = $email = $gender = $comment = $website = $phone=$credit="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["website"])) {
        $website = "";
    } else {
        $website = test_input($_POST["website"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
            $websiteErr = "Invalid URL";
        }
    }
    if (empty($_POST["phone"])) {
        $phone = "";
    } else {
        $phone = test_input($_POST["phone"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
        if (preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i",$phone)) {
            $phoneErr = "Invalid phone";
        }
    }
    if (empty($_POST["credit"])) {
        $credit = "";
    } else {
        $credit = test_input($_POST["credit"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
        if (preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i",$credit)) {
            $creditErrErr = "Invalid phone";
        }
    }
    if (empty($_POST["password"])) {
        $password = "";
    } else {
        $password = test_input($_POST["password"]);
        $cpassword = test_input($_POST["cpassword"]);
        if (strlen($_POST["password"]) <= '8') {//if(preg_match('~(?=.*[0-9])(?=.*[a-z])^[a-z0-9]{5,15}$~', $input))
            $passwordErr = "Your Password Must Contain At Least 8 Characters!";
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Number!";
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        } else {
            $cpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
        }

        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      //  if (preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i",$password)) {
            $passwordErr = "Invalid password";
        }
    }
    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
    }
if (empty($_POST["credit"])) {
    $credit = "";
} else {
    $credit = test_input($_POST["credit"]);
    if (strlen($_POST["password"]) <= '8') {//if(preg_match('~(?=.*[0-9])(?=.*[a-z])^[a-z0-9]{5,15}$~', $input))
        $creditErrErr = "Your card Must Contain At Least 8 num!";
    }
    elseif(strlen($_POST["password"]) >= '20') {
        $creditErr = "Your card Must Contain less than 20 Number!";
    }





}


        $options = [
            'cost' => 11
        ];
		if ($password != $cPassword)
			$msg = "Please Check Your Passwords!";
		else {
			$hash = password_hash($password, PASSWORD_BCRYPT, $options);
		//$con->query("INSERT INTO users (name,email,password) VALUES ('".encryptthis($name,$key)."', '".encryptthis($email,$key)."', '$hash')");
		//	$msg = "You have been registered!";

            $stmt = $con->prepare("INSERT INTO users (name, email, password) VALUES ( ?, ?, ?)");
            $stmt->bind_param("sss", encryptthis($name,$key), encryptthis($email,$key), $hash);
            $stmt->execute();
            $msg = "You have been registered!";
		}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Password Hashing - Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<img src=""><br><br>

				<?php if ($msg != "") echo $msg . "<br><br>"; ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <p><span class="error">* required field</span></p>

					<input class="form-control" minlength="3" name="name" placeholder="Name..."><br>
                    <span class="error">* <?php echo $nameErr;?></span>
                    <br><br>
					<input class="form-control" name="email" type="email" placeholder="email..."><br>
                    <span class="error">* <?php echo $emailErr;?></span>
                    <br><br>
                    <input class="form-control" name="website" type="email" placeholder="web..."><br>
                    <span class="error"><?php echo $websiteErr;?></span>
                    <br><br>
                    <input class="form-control" name="comment" type="textarea"  placeholder="comment..." >

                    <input class="form-control" name="phone" type="phone" placeholder="Phone number..."><br>
                    <span class="error">* <?php echo $phoneErr;?></span>

                    <input class="form-control" name="credit" type="creidt" placeholder="credit..."><br>
                    <span class="error">* <?php echo $creditErr;?></span>

                    <input class="form-control" minlength="5" maxlength="50" name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}" placeholder="Password..."><br>
					<input class="form-control" minlength="5" maxlength="50" name="cPassword" type="password" placeholder="Confirm Password..."><br>
					<input class="btn btn-primary" name="submit" type="submit" value="Register..."><br>
				</form>

			</div>
		</div>
	</div>
</body>
</html>