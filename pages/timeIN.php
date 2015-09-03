<?php include('../config.php');?>
<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$user_ID = $_POST['ID'];
$name = $firstname." ".$lastname;
$time=date("M d Y, g:i A");


$sql_insert = "INSERT INTO tracking (name, timeIN, user_ID) VALUES ('$name', '$time', '$user_ID')";
if(mysql_query($sql_insert)){
	header('location: ../index.php');
}
else{
	echo "ERROR ". mysql_error();
}
?>