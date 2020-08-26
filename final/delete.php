<?php
/**
 * Created by PhpStorm.
 * User: Mohammad Aabed
 * Date: 28/11/2019
 * Time: 21:48
 */



$conn = new mysqli('localhost', 'root', '', 'java');


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_GET['Id']))
{
    $sql = "delete from users where Id =".$_GET['Id'];

    $result = mysqli_query($conn, $sql);

    if(!$result)
        echo "Delete Error";
    else
        header("Location:backdoor.php");
}
