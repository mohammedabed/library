<?php
/**
 * Created by PhpStorm.
 * User: Mohammad Aabed
 * Date: 28/11/2019
 * Time: 20:32
 */

$conn = new mysqli('localhost', 'root', '', 'java');

$sql = "SELECT * FROM users ORDER BY Id DESC ";
$result = mysqli_query($conn, $sql);

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
    /*if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['name'].'</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '<td>'.$row['avg'].'</td>';
            echo '</tr>';
        }}*/
    ?>






    <?php
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {?>
         <tr>
         <td><?php echo $row['Id'];?></td>
         <td><?php echo $row['name'];?></td>
         <td><?php echo $row['email'];?></td>
          <td><?php echo "<a href='delete.php?id='".$row['Id'].">Delete</a>";?></td>

         </tr>
    <?php
    }}

    ?>

</table>

</body>
</html>