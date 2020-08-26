<?php
/**
 * Created by PhpStorm.
 * User: Mohammad Aabed
 * Date: 23/12/2019
 * Time: 14:30
 */
session_start();

echo $_SESSION['username'];
//print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty(test_input($_POST['username']))) {
        echo 'Welcome ' . test_input($_POST['username']);
        echo '<br>';
        echo 'Password : ' . test_input($_POST['password']);
    } else {
        echo 'No Data';
    }

} else {
    echo 'Error Methods';
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}