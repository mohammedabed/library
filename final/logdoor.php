<?php
$msg = "";
// backdoor login

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
        echo 'Error Login';
    }
}
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
