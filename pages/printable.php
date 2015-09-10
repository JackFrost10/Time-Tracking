<?php include('header.php');?>
<?php include('../config.php');?>
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
					if(isset($_GET['date'])){
						$date = $_GET['date'];

						if(isset($_GET['ID'])){
							$user_ID = $_GET['ID'];
							$sql_select = "SELECT*FROM tracking WHERE user_ID='$user_ID' AND timeIN LIKE '$date%'";
						}
						else{
						$sql_select = "SELECT*FROM tracking WHERE timeIN LIKE '$date%'";
						}	
					}
					elseif(isset($_GET['ID'])){
						$user_ID=$_GET['ID'];
						$sql_select = "SELECT*FROM tracking WHERE user_ID='$user_ID'";
					}
					else{
						$sql_select = "SELECT*FROM tracking";
					}
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
						$noRecord = true;
					}
					?>
					</tbody>
				</table>

<?php include('footer.php');?>