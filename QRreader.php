<?php include('config.php');?>
<?php include('header.php');?>
<table align="center">
<tr>
<td>
<div style="margin-top:40%;">
<form action="pages/timeIN.php" method="POST">
	<input type="hidden" name="ID" value="<?php echo $_GET['ID']; ?>">
	<input type="hidden" name="firstname" value="<?php echo $_GET['firstname']; ?>">
	<input type="hidden" name="middlename" value="<?php echo $_GET['middlename']; ?>">
	<input type="hidden" name="lastname" value="<?php echo $_GET['lastname']; ?>">
	<input type="submit" value="Time-In" class="btn btn-default">
</form>
<br />
<form action="pages/timeOUT.php" method="POST">
	<input type="hidden" name="ID" value="<?php echo $_GET['ID']; ?>">
	<input type="submit" value="Time-Out" class="btn btn-default">
</form>
</div>
</td>
</tr>
</table>