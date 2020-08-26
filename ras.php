<?php
/**
 * Created by PhpStorm.
 * User: Mohammad Aabed
 * Date: 12/11/2019
 * Time: 23:45
 */
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

if(isset($_POST['submit'])){
    $data=$_POST['foo'];
    $encrypted=encryptthis($data, $key);
    $decrypted=decryptthis($encrypted, $key);
    echo '<h2>Original Data</h2>';
    echo '<p>'.$data.'</p>';
    echo '<h2>Encrypted Data</h2>';
    echo '<pre>'.$encrypted.'</pre>';
    echo '<h2>Decrypted Data</h2>';
    echo '<p>'.$decrypted.'</p>';
}

echo '<form method="post">
<input type="text" name="foo">
<input type="submit" name="submit" value="submit">
</form>';


function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
$plain_txt = "This is my plain text";
echo "Plain Text =" .$plain_txt. "\n";
$encrypted_txt = encrypt_decrypt('encrypt', $plain_txt);
echo "Encrypted Text = " .$encrypted_txt. "\n";
$decrypted_txt = encrypt_decrypt('decrypt', $encrypted_txt);
echo "Decrypted Text =" .$decrypted_txt. "\n";
if ( $plain_txt === $decrypted_txt ) echo "SUCCESS";
else echo "FAILED";
echo "\n";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border='1' align='center' width='300px'>


    <?php

    $conn = new mysqli('localhost', 'root', '', 'java');

    $sql = "SELECT * FROM users ORDER BY Id DESC ";
    $result = mysqli_query($conn, $sql);



    ?>






    <?php
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>'.$row['Id'].'</td>';
            echo '<td>'.decryptthis($row['name'],$key).'</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '</tr>';
        }}
/*
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {?>
            <tr>
                <td><?php echo $row['Id'];?></td>
                <td><?php echo decryptthis($row['name'],$key);?></td>
                <td><?php echo decryptthis($row['email'],$key);?></td>
                <td><?php echo "<a href='delete.php?id='".$row['Id'].">Delete</a>";?></td>

            </tr>
            <?php
        }}
*/
    ?>

</table>

</body>
</html>
