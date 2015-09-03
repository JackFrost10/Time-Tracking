<?php include('../config.php');?>
<?php
$user_ID = $_POST['ID'];
$time=date("M d Y, g:i A");


$sql_insert = "UPDATE tracking SET timeOUT='$time' WHERE user_ID='$user_ID' AND timeOUT=''";
if(mysql_query($sql_insert)){
	header('location: ../index.php');
}
else{
	echo "ERROR ". mysql_error();
}
?>