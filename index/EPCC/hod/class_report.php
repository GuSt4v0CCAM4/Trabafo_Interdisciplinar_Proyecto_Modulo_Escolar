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
				<h2 class="pull-left">EPCC<small>&nbsp;&nbsp;Universidad Nacional de San Agustin </small></h2>
			</div>
			<hr class="horline" width="100%" /> 
			<div><?php include("../include/hodmenu.txt");?></div>
			<div align="center" class="promote">
			<form method="post" action="class_report.php">			
			<table class="table table-bordered table-hover">
				<caption>Ver el informe de la clase diaria de la facultad</caption>
				<tbody>
					<th class="danger" colspan="2">Informe de clase</th>
					<tr>
						<td class="active" colspan="3">
							<input type ="date" name="date" class="form-control"/>
						</td>

					
					</tr>
					<tr>
						<td class="active">
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
						<td class="active">
								<select name="section" class="form-control">
			<option >Seccion</option>
			<option value="A">A</option>
			<option value="B">B</option>
			<option value="C">C</option>

					
		     </select>
						</td>
					</tr>
					<tr>
					<td class="active" colspan="2">
						<input type="submit" name="submit" class="btn btn-success" value="Get Report"/>
					</td>
					</tr>
				</tbody>
			</table>
			</form>
			</div>
	<?php
				$i = 1;
				$stat="";
	 if( (isset($_POST["date"])) && (isset($_POST["sem"]))  && (isset($_POST["section"])) ){
					$date = $_POST["date"];
					$sem = $_POST["sem"];
					$section = $_POST["section"];
					
			// Recuperando asistencia para I-I	
			if($sem == "I-I"){
				$sql12 = mysqli_query($connect, "SELECT  distinct(per) as perd,fac,sec FROM a1 WHERE day = '$date'  and sec = '$section' order by per asc ");
				$count = mysqli_num_rows($sql12);
				if($count){
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>FECHA</th><th class='danger'>SECTION</th><th class='danger'>SUBJECT</th><th class='danger'>PERIOD</th><th class='danger'>TOTAL</th><th class='danger'>PRESENT</th><th class='danger'>ABSENT</th>";
				
					while($rowa = mysqli_fetch_array($sql12) ){
						$dsub = $rowa["fac"];
						$period = $rowa["perd"];
						$sec = $rowa["sec"];
						$sub = $rowa["fac"];
						
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a1` WHERE `fac` = '$sub' and atten = '1' and per='$period' ");
						while($rows = mysqli_fetch_array($sql2)){
							//Recuperando días presente
							$total1 = $rows["ATTEN"];
						}
						//Contando días ausencias
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a1` WHERE  `fac` = '$sub' and atten = '0' and per='$period' ");
						while($rows = mysqli_fetch_array($sql3)){
							//Recuperando días ausencias
							$total2 = $rows["LOSS"];
						}
						// a=días presente
						$a = $total1;
						// b=días de ausencia
						$b = $total2 ;
						//Calculando dias totales
						$total = $a+$b;

						
						echo "
							<tr>
								<td class='info'>$date</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$period</td><td class='info'>$total</td><td class='info'><font color='green'>$total1</font></td><td class='info'><font color='red'>$total2<font></td>
							</tr>
						";
					
					
				}
				}
				else{
					echo "<div align='center'><b><font color='red'>El parámetro de selección no coincide
</font></b></div>";
				}
			}
		
			else if($sem == "I-II"){
					$sql12 = mysqli_query($connect, "SELECT  distinct(per) as perd,fac,sec FROM a2 WHERE day = '$date'  and sec = '$section' order by per asc ");
				$count = mysqli_num_rows($sql12);
				if($count){
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>FECHA</th><th class='danger'>SECTION</th><th class='danger'>SUBJECT</th><th class='danger'>PERÍODO
</th><th class='danger'>TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>AUSENTE</th>";
				
					while($rowa = mysqli_fetch_array($sql12) ){
						$dsub = $rowa["fac"];
						$period = $rowa["perd"];
						$sec = $rowa["sec"];
						$sub = $rowa["fac"];
						
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a2` WHERE `fac` = '$sub' and atten = '1' and per='$period' ");
						while($rows = mysqli_fetch_array($sql2)){
							
							$total1 = $rows["ATTEN"];
						}
						
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a2` WHERE  `fac` = '$sub' and atten = '0' and per='$period' ");
						while($rows = mysqli_fetch_array($sql3)){
							//retriving number of absent days 
							$total2 = $rows["LOSS"];
						}
						
						$a = $total1;
						
						$b = $total2 ;
					
						$total = $a+$b;

						
						echo "
							<tr>
								<td class='info'>$date</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$period</td><td class='info'>$total</td><td class='info'><font color='green'>$total1</font></td><td class='info'><font color='red'>$total2<font></td>
							</tr>
						";
					
					
					}
			}
		}

			else if($sem == "II-I"){
					$sql12 = mysqli_query($connect, "SELECT  distinct(per) as perd,fac,sec FROM a3 WHERE day = '$date'  and sec = '$section' order by per asc ");
				$count = mysqli_num_rows($sql12);
				if($count){
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>FECHA</th><th class='danger'>SECCIÓN</th><th class='danger'>TEMA</th><th class='danger'>PERÍODO</th><th class='danger'>TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>AUSENTE</th>";
				
					while($rowa = mysqli_fetch_array($sql12) ){
						$dsub = $rowa["fac"];
						$period = $rowa["perd"];
						$sec = $rowa["sec"];
						$sub = $rowa["fac"];
						
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a3` WHERE `fac` = '$sub' and atten = '1' and per='$period' ");
						while($rows = mysqli_fetch_array($sql2)){
							
							$total1 = $rows["ATTEN"];
						}
					
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a3` WHERE  `fac` = '$sub' and atten = '0' and per='$period' ");
						while($rows = mysqli_fetch_array($sql3)){
							
							$total2 = $rows["LOSS"];
						}
						
						$a = $total1;
						
						$b = $total2 ;
					
						$total = $a+$b;

						
						echo "
							<tr>
								<td class='info'>$date</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$period</td><td class='info'>$total</td><td class='info'><font color='green'>$total1</font></td><td class='info'><font color='red'>$total2<font></td>
							</tr>
						";
					
					
					}
			}
			}
			
			else if($sem == "II-II"){
					$sql12 = mysqli_query($connect, "SELECT  distinct(per) as perd,fac,sec FROM a4 WHERE day = '$date'  and sec = '$section' order by per asc ");
				$count = mysqli_num_rows($sql12);
				if($count){
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>FECHA</th><th class='danger'>SECCIÓN</th><th class='danger'>TEMA</th><th class='danger'>PERIODO</th><th class='danger'>TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>AUSENTE</th>";
				
					while($rowa = mysqli_fetch_array($sql12) ){
						$dsub = $rowa["fac"];
						$period = $rowa["perd"];
						$sec = $rowa["sec"];
						$sub = $rowa["fac"];
						
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a4` WHERE `fac` = '$sub' and atten = '1' and per='$period' ");
						while($rows = mysqli_fetch_array($sql2)){
							
							$total1 = $rows["ATTEN"];
						}
						
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a4` WHERE  `fac` = '$sub' and atten = '0' and per='$period' ");
						while($rows = mysqli_fetch_array($sql3)){
							
							$total2 = $rows["LOSS"];
						}
					
						$a = $total1;
					
						$b = $total2 ;
						
						$total = $a+$b;

						
						echo "
							<tr>
								<td class='info'>$date</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$period</td><td class='info'>$total</td><td class='info'><font color='green'>$total1</font></td><td class='info'><font color='red'>$total2<font></td>
							</tr>
						";
					
					
					}
			}
			}
	
			else if($sem == "III-I"){
					$sql12 = mysqli_query($connect, "SELECT  distinct(per) as perd,fac,sec FROM a5 WHERE day = '$date'  and sec = '$section' order by per asc ");
				$count = mysqli_num_rows($sql12);
				if($count){
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>FECHA</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>PERIODO</th><th class='danger'>TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>AUSENTE</th>";
				
					while($rowa = mysqli_fetch_array($sql12) ){
						$dsub = $rowa["fac"];
						$period = $rowa["perd"];
						$sec = $rowa["sec"];
						$sub = $rowa["fac"];
						
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a5` WHERE `fac` = '$sub' and atten = '1' and per='$period' ");
						while($rows = mysqli_fetch_array($sql2)){
						
							$total1 = $rows["ATTEN"];
						}
					
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a5` WHERE  `fac` = '$sub' and atten = '0' and per='$period' ");
						while($rows = mysqli_fetch_array($sql3)){
							
							$total2 = $rows["LOSS"];
						}
					
						$a = $total1;
						
						$b = $total2 ;
					
						$total = $a+$b;

						
						echo "
							<tr>
								<td class='info'>$date</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$period</td><td class='info'>$total</td><td class='info'><font color='green'>$total1</font></td><td class='info'><font color='red'>$total2<font></td>
							</tr>
						";
					
					
					}
			 }
			}
			
			else if($sem == "III-II"){
					$sql12 = mysqli_query($connect,"SELECT  distinct(per) as perd,fac,sec FROM a6 WHERE day = '$date'  and sec = '$section' order by per asc ");
				$count = mysqli_num_rows($sql12);
				if($count){
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>FECHA</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>PERIODO</th><th class='danger'>TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>AUSENTE</th>";
				
					while($rowa = mysqli_fetch_array($sql12) ){
						$dsub = $rowa["fac"];
						$period = $rowa["perd"];
						$sec = $rowa["sec"];
						$sub = $rowa["fac"];
						
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a6` WHERE `fac` = '$sub' and atten = '1' and per='$period' ");
						while($rows = mysqli_fetch_array($sql2)){
							
							$total1 = $rows["ATTEN"];
						}
					
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a6` WHERE  `fac` = '$sub' and atten = '0' and per='$period' ");
						while($rows = mysqli_fetch_array($sql3)){
						
							$total2 = $rows["LOSS"];
						}
					
						$a = $total1;
						
						$b = $total2 ;
						
						$total = $a+$b;

						
						echo "
							<tr>
								<td class='info'>$date</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$period</td><td class='info'>$total</td><td class='info'><font color='green'>$total1</font></td><td class='info'><font color='red'>$total2<font></td>
							</tr>
						";
					
					
					}
			}
			}
			
			else if($sem == "IV-I"){
					$sql12 = mysqli_query($connect, "SELECT  distinct(per) as perd,fac,sec FROM a7 WHERE day = '$date'  and sec = '$section' order by per asc ");
				$count = mysqli_num_rows($sql12);
				if($count){
				echo "<table class='table table-bordered table-hover'>
				<th class='danger'>FECHA</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>PERIODO</th><th class='danger'>TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>AUSENTE</th>";
				
					while($rowa = mysqli_fetch_array($sql12) ){
						$dsub = $rowa["fac"];
						$period = $rowa["perd"];
						$sec = $rowa["sec"];
						$sub = $rowa["fac"];
						
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a7` WHERE `fac` = '$sub' and atten = '1' and per='$period' ");
						while($rows = mysqli_fetch_array($sql2)){
						
							$total1 = $rows["ATTEN"];
						}
					
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a7` WHERE  `fac` = '$sub' and atten = '0' and per='$period' ");
						while($rows = mysqli_fetch_array($sql3)){
							
							$total2 = $rows["LOSS"];
						}
						
						$a = $total1;
						
						$b = $total2 ;
					
						$total = $a+$b;

						
						echo "
							<tr>
								<td class='info'>$date</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$period</td><td class='info'>$total</td><td class='info'><font color='green'>$total1</font></td><td class='info'><font color='red'>$total2<font></td>
							</tr>
						";
					
					
					}
			}
			}
		
			else if($sem == "IV-II"){
					$sql12 = mysqli_query($connect, "SELECT  distinct(per) as perd,fac,sec FROM a8 WHERE day = '$date'  and sec = '$section' order by per asc ");
				$count = mysqli_num_rows($sql12);
				if($count){
					echo "<table class='table table-bordered table-hover'>
				<th class='danger'>FECHA</th><th class='danger'>SECCION</th><th class='danger'>TEMA</th><th class='danger'>PERIODO</th><th class='danger'>TOTAL</th><th class='danger'>PRESENTE</th><th class='danger'>AUSENTE</th>";
				
					while($rowa = mysqli_fetch_array($sql12) ){
						$dsub = $rowa["fac"];
						$period = $rowa["perd"];
						$sec = $rowa["sec"];
						$sub = $rowa["fac"];
						
						$sql2 = mysqli_query($connect, "SELECT count(atten) AS ATTEN FROM `a8` WHERE `fac` = '$sub' and atten = '1' and per='$period' ");
						while($rows = mysqli_fetch_array($sql2)){
						
							$total1 = $rows["ATTEN"];
						}
					
						$sql3 = mysqli_query($connect, "SELECT count(atten) AS LOSS FROM `a8` WHERE  `fac` = '$sub' and atten = '0' and per='$period' ");
						while($rows = mysqli_fetch_array($sql3)){
						
							$total2 = $rows["LOSS"];
						}

						$a = $total1;
						
						$b = $total2 ;
					
						$total = $a+$b;

						
						echo "
							<tr>
								<td class='info'>$date</td><td class='info'>$sec</td><td class='info'>$sub</td><td class='info'>$period</td><td class='info'>$total</td><td class='info'><font color='green'>$total1</font></td><td class='info'><font color='red'>$total2<font></td>
							</tr>
						";
					
					
					}
			}
			}
	}

			?>
		</div>
	</body>
</html>
