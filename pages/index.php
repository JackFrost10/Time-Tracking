<?php include('../config.php');?>
<?php include('header.php');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				Register
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<form action="add.php" method="post">
					<input type="text" name="firstname" placeholder="Firstname" class="form-control" required>
					<input type="text" name="middlename" placeholder="Middlename" class="form-control" required>
					<input type="text" name="lastname" placeholder="Lastname" class="form-control" required>
					<input type="text" name="address" placeholder="Address" class="form-control" required>
					<input type="email" name="email" placeholder="Email" class="form-control" required>
					<br>
					<input type="submit" value="Submit" class="btn btn-default">
				</form>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col -->			

    <div class="col-lg-8"><!-- names table -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Users Data
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
				<table align="center" class="main">
					<tr>
						<td valign="top">
							<table align="center">
								<tr class="border">
									<td>
										Name
									</td>
									<td colspan="2">
										<form class="navbar-form navbar-left" role="search" method="POST" action="index.php">
										  <div class="form-group">
										    <input type="text" class="form-control" placeholder="Search" name="searchQuery">
										  </div>
										  <input type="submit" class="btn btn-default" value="Submit" name="search">
										</form>
									</td>
								</tr>
									<?php
									//out put the names of all the registered users with time-in and time-out btn
									if(isset($_POST['searchQuery']))
									{
										$searchQuery = $_POST['searchQuery'];
										$sql_select = "SELECT*FROM users WHERE firstname LIKE '$searchQuery%' OR lastname LIKE '%$searchQuery'";
									}
									else{
										$sql_select = "SELECT*FROM users";
									}
										$result = mysql_query($sql_select);

										if(mysql_num_rows($result) > 0){
											while ($row = mysql_fetch_assoc($result)) {
												echo "<tr><td>";
													echo "<a href=timeTable.php?ID=".$row['ID'].">".$row['firstname']." ".$row['lastname']."</a>";
												echo"</td>";
												//time in button
												echo'<td align="center">
														<form action="timeIN.php" method="POST">
															<input type="hidden" name="ID" value="'.$row['ID'].'">
															<input type="hidden" name="firstname" value="'.$row['firstname'].'">
															<input type="hidden" name="middlename" value="'.$row['middlename'].'">
															<input type="hidden" name="lastname" value="'.$row['lastname'].'">
															<input type="submit" value="Time-In" class="btn btn-default">
														</form>
													</td>';
													//time out button
												echo'<td align="center">
													<form action="timeOUT.php" method="POST">
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
			</div>
		</div>
	</div>
</div>
<?php include('footer.php');?>
