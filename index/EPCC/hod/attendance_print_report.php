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
			//Viendo si todos los valores se postearon adecuadamente
			if($sem=="" || $from=="" || $to=""){
				//Alerta si algún campo da error
				$msg = "<div align='center'><font color='red'>Seleccione todas las opciones apropiadamente
</font></div>";
			}
		  else{
			
			//Todo bien, con lo que se continua la tarea
				if($sem =="I-I"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='I-I' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Section</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						//Mostrando materias
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
							//Mostrando ids y seccion
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'I-I' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							//Contando el numero total de días basado en los id registrados en todas las materias
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a1` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//Recuperando el numero de días de ausencia 
									$totalall2 = $rows["LOSS"];
							}

				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a1` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
				
								$totalall1 = $rows["LOSS"];
							}
						
					
							 $totalall = $totalall1+$totalall2;
							
							//Contando el numero de dias de asistencia basados en el curso
	$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a1` WHERE (`id`='$ids' and `fac` = '$sub' and atten = '1' and day between '$from' and '$final') ");
							while($rows = mysqli_fetch_array($sql2)){
						
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

			//Todo bien, así que se sigue con la tarea
				else if($sem =="I-II"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='I-II' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Section</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						//Mostrando cursos
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
							
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'I-II' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
						
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a2` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
							
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a2` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
					
							 $totalall = $totalall1+$totalall2;
				
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
			
				else if($sem =="II-I"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='II-I' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Section</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
						
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
							
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'II-I' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a3` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
						
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a3` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								
								$totalall1 = $rows["LOSS"];
							}
						
						
							 $totalall = $totalall1+$totalall2;
							
						
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
	
			    }
				
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
					
					echo "<th class='danger'><b>Clase total</b></th>";
					echo "<th class='danger'><b>Porcentaje&nbsp;<b></th>";
					echo "<tr>";
					$sql1 = mysqli_query($connect, "SELECT distinct(id) as id,sec FROM a4 order by id asc ");
					while($row = mysqli_fetch_array($sql1)){
							$ids=$row["id"];
							$sec = $row["sec"];
						
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'II-II' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a4` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
						
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a4` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
						
								$totalall1 = $rows["LOSS"];
							}
						
							 $totalall = $totalall1+$totalall2;
						
	$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a4` WHERE (`id`='$ids' and `fac` = '$sub' and atten = '1' and day between '$from' and '$final') ");
							while($rows = mysqli_fetch_array($sql2)){
						
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
			
				else if($sem =="III-I"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='III-I' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Seccion</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
					
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
							
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'III-I' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
							
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a5` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
							
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a5` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
							 $totalall = $totalall1+$totalall2;
							
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
			
				else if($sem =="III-II"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='III-II' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Sección</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
					
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
						
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a6` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
								
					
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a6` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
							
								$totalall1 = $rows["LOSS"];
							}
						
						
							 $totalall = $totalall1+$totalall2;
					
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
			
				else if($sem =="IV-I"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='IV-I' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Sección</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
					
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
							
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'IV-I' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
							
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a7` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
							 
									$totalall2 = $rows["LOSS"];
							}
						
								
							
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a7` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
				
							 $totalall = $totalall1+$totalall2;
							
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
		
				else if($sem =="IV-II"){
					$sql = mysqli_query($connect, "SELECT name FROM faculty WHERE yr='IV-II' ");
					echo "<table border='1' class='table table-hover table-bordered' width='100%' align='center'>
					<caption><b>CSE $sem YEAR ATTENDANCE FROM $from TO $final </b></caption>
					<th class='danger'><b>Registered_ID</th><th class='danger'>Seccion</font></th><b>";
					while($row = mysqli_fetch_array($sql)){
						$sub=$row["name"];
					
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
							
							echo "<td class='active'>$ids</td><td class='active'>$sec</td>";
							$sql11 = mysqli_query($connect, "SELECT  name  FROM faculty WHERE yr= 'IV-II' ");
							while($row = mysqli_fetch_array($sql11) ){
						
							$sub = $row["name"];
						
					$sql31 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a8` WHERE  atten='0' and `id`='$ids' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql31)){
								//retriving number of absent days 
									$totalall2 = $rows["LOSS"];
							}
						
							
				$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a8` WHERE `id`='$ids' and atten = '1' and day between '$from' and '$final' ");
							if($rows = mysqli_fetch_array($sql3)){
								//retriving number of absent days 
								$totalall1 = $rows["LOSS"];
							}
						
					
							 $totalall = $totalall1+$totalall2;
						
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
	
		
						
		 }
		}
	?>
<?php
	echo $msg;
?>
		</div>
	</body>
</html>
