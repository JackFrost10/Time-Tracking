<?php include('../config.php');?>
<?php include('header.php');?>

<?php
$noRecord = false;//declaration for the noRecord variable
if(isset($_GET['from'])){
	$from = $_GET['from'];
	$to = $_GET['to'];
}
else{
	$from = 1;
	$to = 10;
}
?>

<?php 
if(isset($_GET['ID'])){$user_ID = $_GET['ID'];}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Time Tracking Table</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                DataTables Advanced Tables
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            	
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
							<form class="navbar-form navbar-left" role="search" method="GET" action="timeTable.php" id="carform">
							  <?php if(isset($_GET['ID'])){echo '<input type="hidden" value="'.$_GET['ID'].'" name="ID">';}?>
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
					if(isset($_GET['ID'])){
						$user_ID = $_GET['ID'];
						$count_select = "SELECT*FROM tracking WHERE user_ID='$user_ID'";//query to count the rows
						$count_result = mysql_query($count_select);//result of the query
						$rowCount = mysql_num_rows($count_result);//assign value to variable
					}
					elseif (isset($_GET['year'])){
						$month = $_GET['month'];
						$day = $_GET['day'];
						$year = $_GET['year'];
						$date = $month." ".$day." ".$year;

						if(isset($_GET['ID'])){
							$user_ID = $_GET['ID'];
							$count_select = "SELECT*FROM tracking WHERE user_ID='$user_ID' AND timeIN LIKE '$date%'";
							$count_result = mysql_query($count_select);//result of the query
							$rowCount = mysql_num_rows($count_result);//assign value to variable
						}
						else{
						$count_select = "SELECT*FROM tracking WHERE timeIN LIKE '$date%'";
						$count_result = mysql_query($count_select);//result of the query
						$rowCount = mysql_num_rows($count_result);//assign value to variable
						}	
					}
					else{
						$count_select = "SELECT*FROM tracking";//query to count the rows
						$count_result = mysql_query($count_select);//result of the query
						$rowCount = mysql_num_rows($count_result);//assign value to variable
					}


					if(isset($_GET['year'])){
						$month = $_GET['month'];
						$day = $_GET['day'];
						$year = $_GET['year'];
						$date = $month." ".$day." ".$year;

						if(isset($_GET['ID'])){
							$user_ID = $_GET['ID'];
							$sql_select = "SELECT*FROM tracking WHERE user_ID='$user_ID' AND timeIN LIKE '$date%' LIMIT $from, $to";
						}
						else{
						$sql_select = "SELECT*FROM tracking WHERE timeIN LIKE '$date%' LIMIT $from, $to";
						}	
					}
					elseif(isset($_GET['ID'])){
						$sql_select = "SELECT*FROM tracking WHERE user_ID='$user_ID' LIMIT $from, $to";
					}
					else{
						$sql_select = "SELECT*FROM tracking LIMIT $from, $to";
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
					<?php 
            		if($noRecord == true){
            			echo '<div class="alert alert-danger" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
									<b>Oh snap!</b> No record is available sorry</div>';
            		}
            	?>
				</div><!-- /.dataTable_wrapper -->
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col -->
</div><!-- /.row -->
<div class="row">
	<div class="col-sm-4">
		Showing <?php echo $from;?> to <?php echo $to;?> of <?php echo $rowCount;?> entries
		<nav>
		  <ul class="pager">
		    <li class="<?php if($to <= 10){echo 'disabled';}?>">
		    	<a href="http://localhost/timeTracking/pages/timeTable.php?<?php if(isset($_GET['ID'])){echo 'ID='.$_GET['ID'].'&';}$fromprev = $from-10;$toprev = $to-10;echo 'from='.$fromprev.'&to='.$toprev;if(isset($_GET['year'])){echo '&month='.$month.'&year='.$year.'&day='.$day;}?>
		    	">Previous</a></li>
		    <li class="<?php if($to >= $rowCount){echo 'disabled';}?>"><a href="http://localhost/timeTracking/pages/timeTable.php?<?php if(isset($_GET['ID'])){echo 'ID='.$_GET['ID'].'&';}$from = $from+10;$to = $to+10;echo 'from='.$from.'&to='.$to;if(isset($_GET['year'])){echo '&month='.$month.'&year='.$year.'&day='.$day;}?>
		    	">Next</a></li>
		  </ul>
		</nav>
	</div>
	<div class="col-sm-4">
		<a href="http://localhost/timeTracking/pages/printable.php?<?php if(isset($_GET['ID'])){echo 'ID='.$_GET['ID'];}if(isset($_GET['year'])){echo '&date='.$date;}?>" target="_blank">Printable Version</a>
	</div>
</div>
<?php include('footer.php');?>