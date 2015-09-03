<?php include('../config.php');?>
<?php include('../sqlFunctions.php');?>
<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$email = $_POST['email'];

$sql_query = "INSERT INTO users (firstname, lastname, address, email) VALUES ('$firstname', '$lastname', '$address','$email')";
if(mysql_query($sql_query)){
	header('location: ../index.php');
}
else{
	echo "ERROR ". mysql_error();
}
?>