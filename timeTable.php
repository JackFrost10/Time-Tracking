<?php include('config.php');?>
<?php include('header.php');?>
<?php 
$user_ID = $_GET['ID'];
?>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<table align="center" class="table table-hover">
			<thead>
			<tr class="border">
				<th><b>#</b></th>
				<th><b>Name</b></th>
				<th><b>Time-in</b></th>
				<th><b>Time-out</b></th>
				<th><b>User ID</b></th>
			</tr>
			</thead>
			<tbody>
				<?php

				 $sql_select = "SELECT*FROM tracking WHERE user_ID='$user_ID'";
				 $result = mysql_query($sql_select);
				 if(mysql_num_rows($result) > 0){
									while ($row = mysql_fetch_assoc($result)) {
										echo "<tr><td>";
											echo $row['ID']."</td>";
										echo "<td>";
											echo $row['name']."</td>";
										echo "<td>";
											echo $row['timeIN']."</td>";
										echo "<td>";
											echo $row['timeOUT']."</td>";
										echo "<td align='center'>";
											echo $row['user_ID']."</td></tr>";
										}
									}
				else{
					echo "no record found";
				}
				?>
			</tbody>
		</table>
	</div>
</div>