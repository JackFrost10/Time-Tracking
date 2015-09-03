<?php include('config.php');?>
<?php include('header.php');?>

<table align="center" class="main">
	<tr>
		<td>
			ADD
			<form action="pages/add.php" method="post">
				<input type="text" name="firstname" placeholder="Firstname" class="form-control" required>
				<input type="text" name="lastname" placeholder="Lastname" class="form-control" required>
				<input type="text" name="address" placeholder="Address" class="form-control" required>
				<input type="email" name="email" placeholder="Email" class="form-control" required>
				<input type="submit" value="Submit" class="btn btn-default">
			</form>
		</td>
		<td valign="top">
			<table align="center">
				<tr  class="border">
					<td>
						Name
					</td>
					<td colspan="2">
					</td>
				</tr>
				
					<?php
					//out put the names of all the registered users with time-in and time-out btn
						$sql_select = "SELECT*FROM users";
						$result = mysql_query($sql_select);

						if(mysql_num_rows($result) > 0){
							while ($row = mysql_fetch_assoc($result)) {
								echo "<tr><td>";
									echo "<a href=timeTable.php?ID=".$row['ID']." target='_blank'>".$row['firstname']." ".$row['lastname']."</a>";
								echo"</td>";
								echo'<td align="center">
										<form action="pages/timeIN.php" method="POST">
											<input type="hidden" name="ID" value="'.$row['ID'].'">
											<input type="hidden" name="firstname" value="'.$row['firstname'].'">
											<input type="hidden" name="lastname" value="'.$row['lastname'].'">
											<input type="submit" value="Time-In" class="btn btn-default">
										</form>
									</td>';
								echo'<td align="center">
									<form action="pages/timeOUT.php" method="POST">
											<input type="hidden" name="ID" value="'.$row['ID'].'">
											<input type="submit" value="Time-Out" class="btn btn-default">
										</form>
									</td><tr>';
							}
						}
						else{
								echo "no Records";
						}
						
					?>
				</tr>	

			</table>	
		</td>
	</tr>
</table>
