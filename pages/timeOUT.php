<?php include('../config.php');?>
<?php include('header.php');?>
<?php
$user_ID = $_POST['ID'];
$time=gmdate("M d Y, g:i A", time()+28800);


$sql_insert = "UPDATE tracking SET timeOUT='$time' WHERE user_ID='$user_ID' AND timeOUT=''";
if(mysql_query($sql_insert)){
	?>
	<a href="index.php"><div class="alert alert-success center" role="alert"><b>Success</b> You have logged out successfully</div></a>;

	<?php
}
else{
	echo "ERROR ". mysql_error();
	echo '<a href="index.php"><div class="alert alert-success" role="alert"><b>Oh snap!</b> Change a few things up and try submitting again.</div></a>';
}
?>