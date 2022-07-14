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
	Asistencia Mensual
		</title>
	</head>
	<body>
		<div class="container" align="center">
			<div class="head pull-left">
				<h2 class="pull-left">EPCC<small>&nbsp;&nbsp;Universidad Nacional de San Agustin</small></h2>
			</div>
			<hr class="horline" width="100%" /> 
			<div><?php include("../include/hodmenu.txt");?></div>
			<div align="center" class="promote">
			<form method="post" action="view_monthly.php">			
			<table class="table table-bordered table-hover">
				<caption>Ver Asistencia Estudiantil</caption>
				<tbody>
					<th class="danger" colspan="2">Asistencia del estudiante</th>
					<tr>
						<td class="active">
									ASISTENCIA DESDE:<input type ="date" name="date" class="form-control"/>
						</td>
						<td class="active"><br/>
								<select name="sem" class="form-control">
			<option>Semestre</option>
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
							<td class="active">
							ASISTENCIA A:<input type="date" name="subject" class="form-control"/>
							
						</td>
						<td class="active"><br/>
								<select name="section" class="form-control">
			<option >Section</option>
			<option value="A">A</option>
			<option value="B">B</option>
			<option value="C">C</option>

					
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
				$i = 1;
				$stat="";
				$total="";
	 if( (isset($_POST["date"])) && (isset($_POST["sem"])) && (isset($_POST["subject"])) && (isset($_POST["section"])) ){
					$dates = $_POST["date"];
					$sem = $_POST["sem"];
					$subject = $_POST["subject"];
					$section = $_POST["section"];
					
			// RECUPERANDO EL RESULTADO DE I-I	
			if($sem == "I-I"){
				$sql1 = mysqli_query($connect, "SELECT distinct(id),sec FROM a1 WHERE day BETWEEN ('$dates' AND '$subject') and sec = '$section' ");
				$count = mysqli_num_rows($sql1);
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>REG ID</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>FECHA</th><th class='danger'>CLASE TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>PORCENTAJE</th>";
				if($count){
				while($row = mysqli_fetch_array($sql1) ){
						$id = $row["id"];
						$sec = $row["sec"];
					$sql11 = mysqli_query($connect, "SELECT DISTINCT(fac) as fac FROM a1 WHERE id = '$id' ");
					while($row = mysqli_fetch_array($sql11) ){
						
						$sub = $row["fac"];
						//$date = $row["day"];
						//$atten = $row["atten"];
						//contando el número total de días presentes
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a1` WHERE `id`='$id' and `fac` = '$sub' and atten = '1'");
						while($rows = mysqli_fetch_array($sql2)){
							//recuperando el número de días presentes
							$total1 = $rows["ATTEN"];
						}
						//contando el número total de días ausentes
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a1` WHERE `id`='$id' and `fac` = '$sub' and atten = '0'");
						while($rows = mysqli_fetch_array($sql3)){
							//recuperando el número de días ausentes
							$total2 = $rows["LOSS"];
						}
						// a significa el número de días presentes
						$a = $total1;
						// b significa el número de días ausentes
						$b = $total2 ;
						//CALCULANDO el número total de días
						$total = $a+$b;
						//calculando el porcentaje de asistencia
						$percent = round((($a/$total)*100),2);
						echo "
							<tr>
								<td class='info'>$id</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$dates TO $subject</td><td class='info'>$total</td><td class='info'>$total1</td><td class='info'>$percent</td>
							</tr>
						";
					 
					}
				}
				}
				
				else{
					echo "<div align='center'><b><font color='red'>Selection Parameter do not Match</font></b></div>";
				}
			}
			//RECUPERANDO EL RESULTADO DE I-II 
			else if($sem == "I-II"){
				$sql1 = mysqli_query($connect, "SELECT distinct(id),sec FROM a2 WHERE day BETWEEN ('$dates' AND '$subject') and sec = '$section' ");
				$count = mysqli_num_rows($sql1);
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>REG ID</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>FECHA</th><th class='danger'>CLASE TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>PORCENTAJE</th>";
				if($count){
				while($row = mysqli_fetch_array($sql1) ){
						$id = $row["id"];
						$sec = $row["sec"];
					$sql11 = mysqli_query($connect, "SELECT DISTINCT(fac) as fac FROM a2 WHERE id = '$id' ");
					while($row = mysqli_fetch_array($sql11) ){
						
						$sub = $row["fac"];
						//$date = $row["day"];
						//$atten = $row["atten"];
						//contando el número total de días presentes
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a2` WHERE `id`='$id' and `fac` = '$sub' and atten = '1'");
						while($rows = mysqli_fetch_array($sql2)){
							//recuperando el número de días presentes 
							$total1 = $rows["ATTEN"];
						}
						//contando el número total de días ausentes
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a2` WHERE `id`='$id' and `fac` = '$sub' and atten = '0'");
						while($rows = mysqli_fetch_array($sql3)){
							//recuperando el número de días ausentes
							$total2 = $rows["LOSS"];
						}
						// a significa el número de días presentes
						$a = $total1;
						// b significa el número de días ausentes
						$b = $total2 ;
						//CALCULANDO el número total de días
						$total = $a+$b;
						//calculando el porcentaje de asistencia
						$percent = round((($a/$total)*100),2);
						
						echo "
							<tr>
								<td class='info'>$id</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$dates TO $subject</td><td class='info'>$total</td><td class='info'>$total1</td><td class='info'>$percent</td>
							</tr>
						";
					 
					}
				}
				}
				
				else{
					echo "<div align='center'><b><font color='red'>Selection Parameter do not Match</font></b></div>";
				}
			}
			//RECUPERANDO EL RESULTADO DE II-I 
			else if($sem == "II-I"){
				$sql1 = mysqli_query($connect, "SELECT distinct(id),sec FROM a3 WHERE day BETWEEN ('$dates' AND '$subject') and sec = '$section' ");
				$count = mysqli_num_rows($sql1);
					echo "<table class='table table-bordered table-hover'>
				<th class='danger'>REG ID</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>FECHA</th><th class='danger'>CLASE TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>PORCENTAJE</th>";
				if($count){
				while($row = mysqli_fetch_array($sql1) ){
						$id = $row["id"];
						$sec = $row["sec"];
					$sql11 = mysqli_query($connect, "SELECT DISTINCT(fac) as fac FROM a3 WHERE id = '$id' ");
					while($row = mysqli_fetch_array($sql11) ){
						
						$sub = $row["fac"];
						//$date = $row["day"];
						//$atten = $row["atten"];
						//contando el número total de días presentes
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a3` WHERE `id`='$id' and `fac` = '$sub' and atten = '1'");
						while($rows = mysqli_fetch_array($sql2)){
							//recuperando el número de días presentes 
							$total1 = $rows["ATTEN"];
						}
						//contando el número total de días ausentes
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a3` WHERE `id`='$id' and `fac` = '$sub' and atten = '0'");
						while($rows = mysqli_fetch_array($sql3)){
							//recuperando el número de días ausentes
							$total2 = $rows["LOSS"];
						}
						// a significa el número de días presentes
						$a = $total1;
						// b significa el número de días ausentes
						$b = $total2 ;
						//CALCULANDO el número total de días
						$total = $a+$b;
						//calculando el porcentaje de asistencia
						$percent = round((($a/$total)*100),2);
						
						echo "
							<tr>
								<td class='info'>$id</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$dates TO $subject</td><td class='info'>$total</td><td class='info'>$total1</td><td class='info'>$percent</td>
							</tr>
						";
					 
					}
				}
				}
				
				else{
					echo "<div align='center'><b><font color='red'>Selection Parameter do not Match</font></b></div>";
				}
			}
			//RECUPERANDO EL RESULTADO DE II-II 
			else if($sem == "II-II"){
				$sql1 = mysqli_query($connect, "SELECT distinct(id),sec FROM a4 WHERE day BETWEEN ('$dates' AND '$subject') and sec = '$section' ");
				$count = mysqli_num_rows($sql1);
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>REG ID</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>FECHA</th><th class='danger'>CLASE TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>PORCENTAJE</th>";
				if($count){
				while($row = mysqli_fetch_array($sql1) ){
						$id = $row["id"];
						$sec = $row["sec"];
					$sql11 = mysqli_query($connect, "SELECT DISTINCT(fac) as fac FROM a4 WHERE id = '$id' ");
					while($row = mysqli_fetch_array($sql11) ){
						
						$sub = $row["fac"];
						//$date = $row["day"];
						//$atten = $row["atten"];
						//contando el número total de días presentes
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a4` WHERE `id`='$id' and `fac` = '$sub' and atten = '1'");
						while($rows = mysqli_fetch_array($sql2)){
							//recuperando el número de días presentes 
							$total1 = $rows["ATTEN"];
						}
						//contando el número total de días ausentes
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a4` WHERE `id`='$id' and `fac` = '$sub' and atten = '0'");
						while($rows = mysqli_fetch_array($sql3)){
							//recuperando el número de días ausentes 
							$total2 = $rows["LOSS"];
						}
						// a significa el número de días presentes
						$a = $total1;
						// b significa el número de días ausentes
						$b = $total2 ;
						//CALCULANDO el número total de días
						$total = $a+$b;
						//calculando el porcentaje de asistencia
						$percent = round((($a/$total)*100),2);
						
						echo "
							<tr>
								<td class='info'>$id</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$dates TO $subject</td><td class='info'>$total</td><td class='info'>$total1</td><td class='info'>$percent</td>
							</tr>
						";
					 
					}
				}
				}
				
				else{
					echo "<div align='center'><b><font color='red'>Selection Parameter do not Match</font></b></div>";
				}
			}
			//RECUPERANDO EL RESULTADO DE III-I 
			else if($sem == "III-I"){
				$sql1 = mysqli_query($connect, "SELECT distinct(id),sec FROM a5 WHERE day BETWEEN ('$dates' AND '$subject') and sec = '$section' ");
				$count = mysqli_num_rows($sql1);
					echo "<table class='table table-bordered table-hover'>
				<th class='danger'>REG ID</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>FECHA</th><th class='danger'>CLASE TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>PORCENTAJE</th>";
				if($count){
				while($row = mysqli_fetch_array($sql1) ){
						$id = $row["id"];
						$sec = $row["sec"];
					$sql11 = mysqli_query($connect, "SELECT DISTINCT(fac) as fac FROM a5 WHERE id = '$id' ");
					while($row = mysqli_fetch_array($sql11) ){
						
						$sub = $row["fac"];
						//$date = $row["day"];
						//$atten = $row["atten"];
						//contando el número total de días presentes
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a5` WHERE `id`='$id' and `fac` = '$sub' and atten = '1'");
						while($rows = mysqli_fetch_array($sql2)){
							//recuperando el número de días presentes 
							$total1 = $rows["ATTEN"];
						}
						//contando el número total de días ausentes
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a5` WHERE `id`='$id' and `fac` = '$sub' and atten = '0'");
						while($rows = mysqli_fetch_array($sql3)){
							//recuperando el número de días ausentes
							$total2 = $rows["LOSS"];
						}
						// a significa el número de días presentes
						$a = $total1;
						// b significa el número de días ausentes
						$b = $total2 ;
						//CALCULANDO el número total de días
						$total = $a+$b;
						//calculando el porcentaje de asistencia
						$percent = round((($a/$total)*100),2);
						
						echo "
							<tr>
								<td class='info'>$id</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$dates TO $subject</td><td class='info'>$total</td><td class='info'>$total1</td><td class='info'>$percent</td>
							</tr>
						";
					 
					}
				}
				}
				
				else{
					echo "<div align='center'><b><font color='red'>Selection Parameter do not Match</font></b></div>";
				}
			}
			//RECUPERANDO EL RESULTADO DE III-II 
			else if($sem == "III-II"){
				$sql1 = mysqli_query($connect, "SELECT distinct(id),sec FROM a6 WHERE day BETWEEN ('$dates' AND '$subject') and sec = '$section' ");
				$count = mysqli_num_rows($sql1);
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>REG ID</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>FECHA</th><th class='danger'>CLASE TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>PORCENTAJE</th>";
				if($count){
				while($row = mysqli_fetch_array($sql1) ){
						$id = $row["id"];
						$sec = $row["sec"];
					$sql11 = mysqli_query($connect, "SELECT DISTINCT(fac) as fac FROM a6 WHERE id = '$id' ");
					while($row = mysqli_fetch_array($sql11) ){
						
						$sub = $row["fac"];
						//$date = $row["day"];
						//$atten = $row["atten"];
						//contando el número total de días presentes
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a6` WHERE `id`='$id' and `fac` = '$sub' and atten = '1'");
						while($rows = mysqli_fetch_array($sql2)){
							//recuperando el número de días presentes 
							$total1 = $rows["ATTEN"];
						}
						//contando el número total de días ausentes
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a6` WHERE `id`='$id' and `fac` = '$sub' and atten = '0'");
						while($rows = mysqli_fetch_array($sql3)){
							//recuperando el número de días ausentes
							$total2 = $rows["LOSS"];
						}
						// a significa el número de días presentes
						$a = $total1;
						// b significa el número de días ausentes
						$b = $total2 ;
						//CALCULANDO el número total de días
						$total = $a+$b;
						//calculando el porcentaje de asistencia
						$percent = round((($a/$total)*100),2);
						
						echo "
							<tr>
								<td class='info'>$id</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$dates TO $subject</td><td class='info'>$total</td><td class='info'>$total1</td><td class='info'>$percent</td>
							</tr>
						";
					 
					}
				}
				}
				
				else{
					echo "<div align='center'><b><font color='red'>Selection Parameter do not Match</font></b></div>";
				}
			}
			//RECUPERANDO EL RESULTADO DE IV-I 
			else if($sem == "IV-I"){
				$sql1 = mysqli_query($connect, "SELECT distinct(id),sec FROM a7 WHERE day BETWEEN ('$dates' AND '$subject') and sec = '$section' ");
				$count = mysqli_num_rows($sql1);
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>REG ID</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>FECHA</th><th class='danger'>CLASE TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>PORCENTAJE</th>";
				if($count){
				while($row = mysqli_fetch_array($sql1) ){
						$id = $row["id"];
						$sec = $row["sec"];
					$sql11 = mysqli_query($connect, "SELECT DISTINCT(fac) as fac FROM a7 WHERE id = '$id' ");
					while($row = mysqli_fetch_array($sql11) ){
						
						$sub = $row["fac"];
						//$date = $row["day"];
						//$atten = $row["atten"];
						//contando el número total de días presentes
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a7` WHERE `id`='$id' and `fac` = '$sub' and atten = '1'");
						while($rows = mysqli_fetch_array($sql2)){
							//recuperando el número de días presentes
							$total1 = $rows["ATTEN"];
						}
						//contando el número total de días ausentes
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a7` WHERE `id`='$id' and `fac` = '$sub' and atten = '0'");
						while($rows = mysqli_fetch_array($sql3)){
							//recuperando el número de días ausentes
							$total2 = $rows["LOSS"];
						}
						// a significa el número de días presentes
						$a = $total1;
						// b significa el número de días ausentes
						$b = $total2 ;
						//CALCULANDO el número total de días
						$total = $a+$b;
						//calculando el porcentaje de asistencia
						$percent = round((($a/$total)*100),2);
						
						echo "
							<tr>
								<td class='info'>$id</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$dates TO $subject</td><td class='info'>$total</td><td class='info'>$total1</td><td class='info'>$percent</td>
							</tr>
						";
					 
					}
				}
				}
				
				else{
					echo "<div align='center'><b><font color='red'>Selection Parameter do not Match</font></b></div>";
				}
			}
			//RECUPERANDO EL RESULTADO DE IV-II 
			else if($sem == "IV-II"){
				$sql1 = mysqli_query($connect, "SELECT distinct(id),sec FROM a8 WHERE day BETWEEN ('$dates' AND '$subject') and sec = '$section' ");
				$count = mysqli_num_rows($sql1);
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>REG ID</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>FECHA</th><th class='danger'>CLASE TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>PORCENTAJE</th>";
				if($count){
				while($row = mysqli_fetch_array($sql1) ){
						$id = $row["id"];
						$sec = $row["sec"];
					$sql11 = mysqli_query($connect, "SELECT DISTINCT(fac) as fac FROM a8 WHERE id = '$id' ");
					while($row = mysqli_fetch_array($sql11) ){
						
						$sub = $row["fac"];
						//$date = $row["day"];
						//$atten = $row["atten"];
						//contando el número total de días presentes
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a8` WHERE `id`='$id' and `fac` = '$sub' and atten = '1'");
						while($rows = mysqli_fetch_array($sql2)){
							//recuperando el número de días presentes 
							$total1 = $rows["ATTEN"];
						}
						//contando el número total de días ausentes
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a8` WHERE `id`='$id' and `fac` = '$sub' and atten = '0'");
						while($rows = mysqli_fetch_array($sql3)){
							//recuperando el número de días ausentes
							$total2 = $rows["LOSS"];
						}
						// a significa el número de días presentes
						$a = $total1;
						// b significa el número de días ausentes
						$b = $total2 ;
						//CALCULANDO el número total de días
						$total = $a+$b;
						//calculando el porcentaje de asistencia
						$percent = round((($a/$total)*100),2);
						
						echo "
							<tr>
								<td class='info'>$id</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$dates TO $subject</td><td class='info'>$total</td><td class='info'>$total1</td><td class='info'>$percent</td>
							</tr>
						";
					 
					}
				}
				}
				
				else{
					echo "<div align='center'><b><font color='red'>El parámetro de selección no coincide</font></b></div>";
				}
			}
	}

			?>
		</div>
	</body>
</html>
