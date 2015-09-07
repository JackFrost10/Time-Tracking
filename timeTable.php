<?php include('config.php');?>
<?php include('header.php');?>
<?php 
if(isset($_GET['ID'])){$user_ID = $_GET['ID'];}
?>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<table align="center" class="table table-hover">
			<thead>
			<tr>
				<td colspan="5">
					<div class="row">
						<div class="col-md-2">
							<br>
							<select name="month" form="carform" class="form-control">
							  <option value="Jan">Jan</option>
							  <option value="Feb">Feb</option>
							  <option value="Mar">Mar</option>
							  <option value="Apr">Apr</option>
							  <option value="May">May</option>
							  <option value="Jun">Jun</option>
							  <option value="Jul">Jul</option>
							  <option value="Aug">Aug</option>
							  <option value="Sep">Sep</option>
							  <option value="Oct">Oct</option>
							  <option value="Nov">Nov</option>
							  <option value="Dec">Dec</option>
							</select>
						</div>
						<div class="col-md-2">
							<br>
							<select name="day" form="carform" class="form-control">
								<?php
									for ($i=1; $i < 32; $i++) { 
										if($i < 10){
											echo '<option value="0'.$i.'">0'.$i.'</option>';
										}
										else{
											echo '<option value="'.$i.'">'.$i.'</option>';
										}
									}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<br>
							<select name="year" form="carform" class="form-control">
								<?php
									for ($x=2015; $x < 2020; $x++) { 
										echo '<option value="'.$x.'">'.$x.'</option>';
									}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<form class="navbar-form navbar-left" role="search" method="POST" action="timeTable.php<?php if(isset($_GET['ID'])){echo '?ID='.$user_ID;}?>" id="carform">
							  <input type="submit" class="btn btn-default" value="Filter" name="search">
							</form>
						</div>
				</div>
				</tr>
			</thead>
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
			if(isset($_POST['year'])){
				$month = $_POST['month'];
				$day = $_POST['day'];
				$year = $_POST['year'];
				$date = $month." ".$day." ".$year;
				if(isset($_GET['ID'])){
					$user_ID = $_GET['ID'];
					$sql_select = "SELECT*FROM tracking WHERE user_ID='$user_ID' AND timeIN LIKE '$date%'";
				}
				else{
					$sql_select = "SELECT*FROM tracking WHERE timeIN LIKE '$date%'";
				}	
			}
			elseif(isset($_GET['ID'])){
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
					echo "no record found";
				}
				?>
			</tbody>
		</table>
	</div>
</div>