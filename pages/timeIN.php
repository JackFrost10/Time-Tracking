<?php include('../config.php');?>
<?php include('header.php');?>
<?php


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$middlename = $_POST['middlename'];
$user_ID = $_POST['ID'];
$middlename	= substr($middlename, 0,1);
$name = $firstname." ".$middlename.". ".$lastname;
$h = "-8";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
$hm = $h * 60; 
$ms = $hm * 60;
$time=gmdate("M d Y, g:i A", time()+28800);


$sql_insert = "INSERT INTO tracking (name, timeIN, user_ID) VALUES ('$name', '$time', '$user_ID')";
if(mysql_query($sql_insert)){
?>
	<a href="../index.php"><div class="alert alert-success center" role="alert"><b>Success</b> You have logged in successfully</div></a>
<?php
}
else{
	echo "ERROR ". mysql_error();
	echo '<a href="../index.php"><div class="alert alert-danger center" role="alert"><b>Oh snap!</b> Change a few things up and try submitting again.</div></a>';
}
?>