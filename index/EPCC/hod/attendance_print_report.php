<?php
session_start();
include ("../include/connect.php");
     if(!isset($_SESSION["did"])){
       header("location:../index.php");
     }
	 else{
	
	   $check_did = $_SESSION["did"];
		if($check_did !=2){
			 header("location:../index.php");
		}
	}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.esm.min.js" integrity="sha512-yPOQ2pPoQ9JtP0/jDKpXiKyWNCJWT5OI+6r1EqZmTg+afKQOBpy08VYboeq+Tt9kl9/FOCueEhH6cmHN3nAdJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/helpers.esm.min.js" integrity="sha512-vxCPccgWacJoW2HlxhlKKtczdzvcg0r1UuB9LfNGt6vsDbgLfSFxKlolUS2mqKNXrOK5b93S45309T+V5BhueA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<title>
			
		</title>
	</head>
	<body>
		<div class="container" align="center">
			<div class="head pull-left">
				<h2 class="pull-left">EPCC<small>&nbsp;&nbsp;Universidad Nacional de San Agustin</small></h2>
			</div>
			<hr class="horline" width="100%" /> 
			<div class="hidden-print"><?php include("../include/hodmenu.txt");?></div>
			<div align="center" class="promote hidden-print">
			<form method="post" action="attendance_print_report.php">			
			<table class="table table-bordered table-hover">
				<caption>Ver Asistencia Estudiantil</caption>
				<tbody>
					<th class="danger" colspan="2">Asistencia del estudiante</th>
					<tr>
						<td class="active">
								ASISTENCIA DESDE:<input type ="date" name="dateFrom" class="form-control"/>
						</td>
													<td class="active">
							ASISTENCIA A:<input type="date" name="dateTo" class="form-control"/>
							
						</td>

					
					</tr>
					<tr>
						<td class="active" colspan="2"><br/>
								<select name="sem" class="form-control">
			<option value="">Semestre</option>
			<option value="I-I">I-I</option>
			<option value="I-II">I-II</option>
			<option value="II-I">II-I</option>
			<option value="II-II">II-II</option>
			<option value="III-I">III-I</option>
			<option value="III-II">III-II</option>
			<option value="IV-I">IV-I</option>
			<option value="IV-II">IV-II</option>
					
		 </select>
						</td>

					</tr>
					<tr>
	
					<td class="active" colspan="2">
						<input type="submit" name="submit" class="btn btn-success" value="Get Attendance"/>
					</td>
					</tr>
				</tbody>
			</table>
			</form>
			
			</div>
	<?php
	$msg="";
	$id="";
	$sec="";
	$sub="";
		if((isset($_POST["sem"])) && (isset($_POST["dateFrom"])) && (isset($_POST["dateTo"])) ){
			$sem = $_POST["sem"];
			$from = $_POST["dateFrom"];
			 $to = $_POST["dateTo"];
			 $final = $_POST["dateTo"];
			//checking whether all values are posted properly or not
			if($sem=="" || $from=="" || $to=""){
				//alert if there is null value i.e some field is not selected properly
				$msg = "<div align='center'><font color='red'>Seleccione todas las opciones apropiadamente
</font></div>";
			}
		  else{
			
			//indicates everything is posted properly so begin the task
				if($sem =="I-I"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='I-I' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Section</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						//subject showing
						echo "<th class='danger'><b>$sub&nbsp;<b></th>";
				    }
					//echo "$from : $final";
					echo "<th class='danger'><b>Clase total</b></th>";
					echo "<th class='danger'><b>Porcentaje&nbsp;<b></th>";
					echo "<tr>";
					$sql1 = mysqli_query($connect, "SELECT distinct(id) as id,sec FROM a1 order by id asc ");
					while($row = mysqli_fetch_array($sql1)){
							$ids=$row["id"];
							$sec = $row["sec"];
							//displaying ids and section 
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'I-I' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							//counting total number of days based on registered id i.e total of all subjects
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a1` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
							//counting total number of days based on registered id i.e total of all subjects
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a1` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
							//counting toal days for particular registered id
							 $totalall = $totalall1+$totalall2;
							
							//counting the total number of present days subject wise
	$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a1` WHERE (`id`='$ids' and `fac` = '$sub' and atten = '1' and day between '$from' and '$final') ");
							while($rows = mysqli_fetch_array($sql2)){
								//retriving number of present days 
								 $total1 = $rows["ATTEN"];
								echo "<td class='active'>$total1</td>";
							}
							if($totalall!=0){
								$per = round((($totalall1/$totalall)*100),2);
							}
							else{
								$per = 0;
							}
						
							

						}
						echo "<td class='active'>$totalall</td><td class='active'>$per</td></tr>";
					}
					echo "<form><input type='button' class='hidden-print btn btn-success' onClick='javascript:print()' value='Impresión'/></form>";
	
			    }
				// end of IF
			//indicates everything is posted properly so begin the task
				else if($sem =="I-II"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='I-II' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Section</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						//subject showing
						echo "<th class='danger'><b>$sub&nbsp;<b></th>";
				    }
					//echo "$from : $final";
					echo "<th class='danger'><b>Clase total</b></th>";
					echo "<th class='danger'><b>Porcentaje&nbsp;<b></th>";
					echo "<tr>";
					$sql1 = mysqli_query($connect, "SELECT distinct(id) as id,sec FROM a2 order by id asc ");
					while($row = mysqli_fetch_array($sql1)){
							$ids=$row["id"];
							$sec = $row["sec"];
							//displaying ids and section 
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'I-II' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							//counting total number of days based on registered id i.e total of all subjects
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a2` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
							//counting total number of days based on registered id i.e total of all subjects
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a2` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
							//counting toal days for particular registered id
							 $totalall = $totalall1+$totalall2;
							
							//counting the total number of present days subject wise
	$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a2` WHERE (`id`='$ids' and `fac` = '$sub' and atten = '1' and day between '$from' and '$final') ");
							while($rows = mysqli_fetch_array($sql2)){
								//retriving number of present days 
								 $total1 = $rows["ATTEN"];
								echo "<td class='active'>$total1</td>";
							}
							if($totalall!=0){
								$per = round((($totalall1/$totalall)*100),2);
							}
							else{
								$per = 0;
							}
						
							

						}
						echo "<td class='active'>$totalall</td><td class='active'>$per</td></tr>";
					}
					echo "<form><input type='button' class='hidden-print btn btn-success' onClick='javascript:print()' value='Impresión'/></form>";
	
			    }
				// end of IF
			//indicates everything is posted properly so begin the task
				else if($sem =="II-I"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='II-I' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Section</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						//subject showing
						echo "<th class='danger'><b>$sub&nbsp;<b></th>";
				    }
					//echo "$from : $final";
					echo "<th class='danger'><b>Clase total</b></th>";
					echo "<th class='danger'><b>Porcentaje&nbsp;<b></th>";
					echo "<tr>";
					$sql1 = mysqli_query($connect, "SELECT distinct(id) as id,sec FROM a3 order by id asc ");
					while($row = mysqli_fetch_array($sql1)){
							$ids=$row["id"];
							$sec = $row["sec"];
							//displaying ids and section 
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'II-I' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							//counting total number of days based on registered id i.e total of all subjects
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a3` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
							//counting total number of days based on registered id i.e total of all subjects
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a3` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
							//counting toal days for particular registered id
							 $totalall = $totalall1+$totalall2;
							
							//counting the total number of present days subject wise
	$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a3` WHERE (`id`='$ids' and `fac` = '$sub' and atten = '1' and day between '$from' and '$final') ");
							while($rows = mysqli_fetch_array($sql2)){
								//retriving number of present days 
								 $total1 = $rows["ATTEN"];
								echo "<td class='active'>$total1</td>";
							}
							if($totalall!=0){
								$per = round((($totalall1/$totalall)*100),2);
							}
							else{
								$per = 0;
							}
						
							
						}
						echo "<td class='active'>$totalall</td><td class='active'>$per</td></tr>";
                        
					}
					echo "<form><input type='button' class='hidden-print btn btn-success' onClick='javascript:print()' value='Impresión'/></form>"; 
            
            //Muestra la grafica con la yuda de Chart.js
            ?>
                    
	           <div style="width: 500px; height: 500px; text-align: center;" > <canvas id="myChart" width="400" height="400"></canvas>
                    <script>
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                                <?php
                                $sql = "SELECT * FROM s3";
                                $result = mysqli_query($connect,$sql);
                                while($registros = mysqli_fetch_array($result)){
                                ?>
                                 '<?php echo $registros["sname"] ?>',
                                <?php
                                }
                                ?>
                            ],
                            datasets: [{
                                label: '# of Votes',
                                data: [
                                100, 50, 100, 100, 80, 50, 50, 50
                                ],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    </script>
                 </div>
            <?php
			    }
				// end of IF
			//indicates everything is posted properly so begin the task
				else if($sem =="II-II"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='II-II' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Sección</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						//subject showing
						echo "<th class='danger'><b>$sub&nbsp;<b></th>";
				    }
					//echo "$from : $final";
					echo "<th class='danger'><b>Clase total</b></th>";
					echo "<th class='danger'><b>Porcentaje&nbsp;<b></th>";
					echo "<tr>";
					$sql1 = mysqli_query($connect, "SELECT distinct(id) as id,sec FROM a4 order by id asc ");
					while($row = mysqli_fetch_array($sql1)){
							$ids=$row["id"];
							$sec = $row["sec"];
							//displaying ids and section 
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'II-II' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							//counting total number of days based on registered id i.e total of all subjects
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a4` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
							//counting total number of days based on registered id i.e total of all subjects
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a4` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
							//counting toal days for particular registered id
							 $totalall = $totalall1+$totalall2;
							
							//counting the total number of present days subject wise
	$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a4` WHERE (`id`='$ids' and `fac` = '$sub' and atten = '1' and day between '$from' and '$final') ");
							while($rows = mysqli_fetch_array($sql2)){
								//retriving number of present days 
								 $total1 = $rows["ATTEN"];
								echo "<td class='active'>$total1</td>";
							}
							if($totalall!=0){
								$per = round((($totalall1/$totalall)*100),2);
							}
							else{
								$per = 0;
							}
						
							

						}
						echo "<td class='active'>$totalall</td><td class='active'>$per</td></tr>";
					}
					echo "<form><input type='button' class='hidden-print btn btn-success' onClick='javascript:print()' value='Impresión'/></form>";
	
			    }
				// end of IF AND STARTING OF III-I
			//indicates everything is posted properly so begin the task
				else if($sem =="III-I"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='III-I' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Seccion</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						//subject showing
						echo "<th class='danger'><b>$sub&nbsp;<b></th>";
				    }
					//echo "$from : $final";
					echo "<th class='danger'><b>Clase total</b></th>";
					echo "<th class='danger'><b>Porcentaje&nbsp;<b></th>";
					echo "<tr>";
					$sql1 = mysqli_query($connect, "SELECT distinct(id) as id,sec FROM a5 order by id asc ");
					while($row = mysqli_fetch_array($sql1)){
							$ids=$row["id"];
							$sec = $row["sec"];
							//displaying ids and section 
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'III-I' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							//counting total number of days based on registered id i.e total of all subjects
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a5` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
							//counting total number of days based on registered id i.e total of all subjects
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a5` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
							//counting toal days for particular registered id
							 $totalall = $totalall1+$totalall2;
							
							//counting the total number of present days subject wise
	$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a5` WHERE (`id`='$ids' and `fac` = '$sub' and atten = '1' and day between '$from' and '$final') ");
							while($rows = mysqli_fetch_array($sql2)){
								//retriving number of present days 
								 $total1 = $rows["ATTEN"];
								echo "<td class='active'>$total1</td>";
							}
							if($totalall!=0){
								$per = round((($totalall1/$totalall)*100),2);
							}
							else{
								$per = 0;
							}
						
							

						}
						echo "<td class='active'>$totalall</td><td class='active'>$per</td></tr>";
					}
					echo "<form><input type='button' class='hidden-print btn btn-success' onClick='javascript:print()' value='Impresión'/></form>";
	
			    }
				// end of IF STARTING III-II
			//indicates everything is posted properly so begin the task
				else if($sem =="III-II"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='III-II' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Sección</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						//subject showing
						echo "<th class='danger'><b>$sub&nbsp;<b></th>";
				    }
					//echo "$from : $final";
					echo "<th class='danger'><b>Clase total</b></th>";
					echo "<th class='danger'><b>Percentage&nbsp;<b></th>";
					echo "<tr>";
					$sql1 = mysqli_query($connect, "SELECT distinct(id) as id,sec FROM a6 order by id asc ");
					while($row = mysqli_fetch_array($sql1)){
							$ids=$row["id"];
							$sec = $row["sec"];
							//displaying ids and section 
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'III-II' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							//counting total number of days based on registered id i.e total of all subjects
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a6` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
							//counting total number of days based on registered id i.e total of all subjects
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a6` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
							//counting toal days for particular registered id
							 $totalall = $totalall1+$totalall2;
							
							//counting the total number of present days subject wise
	$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a6` WHERE (`id`='$ids' and `fac` = '$sub' and atten = '1' and day between '$from' and '$final') ");
							while($rows = mysqli_fetch_array($sql2)){
								//retriving number of present days 
								 $total1 = $rows["ATTEN"];
								echo "<td class='active'>$total1</td>";
							}
							if($totalall!=0){
								$per = round((($totalall1/$totalall)*100),2);
							}
							else{
								$per = 0;
							}
						
							

						}
						echo "<td class='active'>$totalall</td><td class='active'>$per</td></tr>";
					}
					echo "<form><input type='button' class='hidden-print btn btn-success' onClick='javascript:print()' value='Impresión'/></form>";
	
			    }
				// end of IF STARTING 4-1
			//indicates everything is posted properly so begin the task
				else if($sem =="IV-I"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='IV-I' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Sección</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						//subject showing
						echo "<th class='danger'><b>$sub&nbsp;<b></th>";
				    }
					//echo "$from : $final";
					echo "<th class='danger'><b>Clase total</b></th>";
					echo "<th class='danger'><b>Porcentaje&nbsp;<b></th>";
					echo "<tr>";
					$sql1 = mysqli_query($connect, "SELECT distinct(id) as id,sec FROM a7 order by id asc ");
					while($row = mysqli_fetch_array($sql1)){
							$ids=$row["id"];
							$sec = $row["sec"];
							//displaying ids and section 
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'IV-I' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							//counting total number of days based on registered id i.e total of all subjects
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a7` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
							//counting total number of days based on registered id i.e total of all subjects
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a7` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
							//counting toal days for particular registered id
							 $totalall = $totalall1+$totalall2;
							
							//counting the total number of present days subject wise
	$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a7` WHERE (`id`='$ids' and `fac` = '$sub' and atten = '1' and day between '$from' and '$final') ");
							while($rows = mysqli_fetch_array($sql2)){
								//retriving number of present days 
								 $total1 = $rows["ATTEN"];
								echo "<td class='active'>$total1</td>";
							}
							if($totalall!=0){
								$per = round((($totalall1/$totalall)*100),2);
							}
							else{
								$per = 0;
							}
						
							

						}
						echo "<td class='active'>$totalall</td><td class='active'>$per</td></tr>";
					}
					echo "<form><input type='button' class='hidden-print btn btn-success' onClick='javascript:print()' value='Impresión'/></form>";
	
			    }
				// end of IF STARTING 4-2
			//indicates everything is posted properly so begin the task
				else if($sem =="IV-II"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='IV-II' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Seccion</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						//subject showing
						echo "<th class='danger'><b>$sub&nbsp;<b></th>";
				    }
					//echo "$from : $final";
					echo "<th class='danger'><b>Clase total</b></th>";
					echo "<th class='danger'><b>Porcentaje&nbsp;<b></th>";
					echo "<tr>";
					$sql1 = mysqli_query($connect, "SELECT distinct(id) as id,sec FROM a8 order by id asc ");
					while($row = mysqli_fetch_array($sql1)){
							$ids=$row["id"];
							$sec = $row["sec"];
							//displaying ids and section 
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'IV-II' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							//counting total number of days based on registered id i.e total of all subjects
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a8` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
							//counting total number of days based on registered id i.e total of all subjects
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a8` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
							//counting toal days for particular registered id
							 $totalall = $totalall1+$totalall2;
							
							//counting the total number of present days subject wise
	$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a8` WHERE (`id`='$ids' and `fac` = '$sub' and atten = '1' and day between '$from' and '$final') ");
							while($rows = mysqli_fetch_array($sql2)){
								//retriving number of present days 
								 $total1 = $rows["ATTEN"];
								echo "<td class='active'>$total1</td>";
							}
							if($totalall!=0){
								$per = round((($totalall1/$totalall)*100),2);
							}
							else{
								$per = 0;
							}
						
							

						}
						echo "<td class='active'>$totalall</td><td class='active'>$per</td></tr>";
					}
					echo "<form><input type='button' class='hidden-print btn btn-success' onClick='javascript:print()' value='Impresión'/></form>";
	
			    }
				//END OF IF AND ATTENDANCE CALCULATING 
		
						
		 }
		}
            
	?>
<?php
	echo $msg;
            
?>
		</div>
      
	</body>

</html>
