<?php include('../config.php');?>
<?php include('sqlFunctions.php');?>
<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$middlename = $_['middlename'];
$address = $_POST['address'];
$email = $_POST['email'];

$sql_query = "INSERT INTO users (firstname, lastname, address, email,middlename) VALUES ('$firstname', '$lastname', '$address','$email','$middlename')";
if(mysql_query($sql_query)){
	header('location: index.php');
}
else{
	echo "ERROR ". mysql_error();
}
?>