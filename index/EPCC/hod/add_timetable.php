
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
$msg ="";
if( (isset($_POST["year"])) && (isset($_POST["section"]))  ){
	
	$year = $_POST["year"];
	$section=$_POST["section"];
	
	
	if( $year=="" || $section == "" ){
					$msg = "<font color=\"red\">All fields are required.</font>";

	}
	else{
	// Lunes/Monday
	$mday = $_POST["Mday1"];
	$mper1 = $_POST["Mper1"]; 
	$mper2 = $_POST["Mper2"]; 
	$mper3 = $_POST["Mper3"]; 
	$mper4 = $_POST["Mper4"]; 
	$mper5 = $_POST["Mper5"]; 
	$mper6 = $_POST["Mper6"]; 
	$mper7 = $_POST["Mper7"]; 
	// Martes/Tuesday
	$tday = $_POST["Tday1"];
	$tper1 = $_POST["Tper1"]; 
	$tper2 = $_POST["Tper2"]; 
	$tper3 = $_POST["Tper3"]; 
	$tper4 = $_POST["Tper4"]; 
	$tper5 = $_POST["Tper5"]; 
	$tper6 = $_POST["Tper6"]; 
	$tper7 = $_POST["Tper7"]; 
	
	// Miercoles/Wednesday
	$wday = $_POST["Wday1"];
	$wper1 = $_POST["Wper1"]; 
	$wper2 = $_POST["Wper2"]; 
	$wper3 = $_POST["Wper3"]; 
	$wper4 = $_POST["Wper4"]; 
	$wper5 = $_POST["Wper5"]; 
	$wper6 = $_POST["Wper6"]; 
	$wper7 = $_POST["Wper7"]; 
	// Jueves/Thursday
	$thday = $_POST["THday1"];
	$thper1 = $_POST["THper1"]; 
	$thper2 = $_POST["THper2"]; 
	$thper3 = $_POST["THper3"]; 
	$thper4 = $_POST["THper4"]; 
	$thper5 = $_POST["THper5"]; 
	$thper6 = $_POST["THper6"]; 
	$thper7 = $_POST["THper7"]; 
	// Viernes/Friday
	$fday = $_POST["Fday1"];
	$fper1 = $_POST["Fper1"]; 
	$fper2 = $_POST["Fper2"]; 
	$fper3 = $_POST["Fper3"]; 
	$fper4 = $_POST["Fper4"]; 
	$fper5 = $_POST["Fper5"]; 
	$fper6 = $_POST["Fper6"]; 
	$fper7 = $_POST["Fper7"]; 
	// Sábado/Saturday
	$sday = $_POST["Sday1"];
	$sper1 = $_POST["Sper1"]; 
	$sper2 = $_POST["Sper2"]; 
	$sper3 = $_POST["Sper3"]; 
	$sper4 = $_POST["Sper4"]; 
	$sper5 = $_POST["Sper5"]; 
	$sper6 = $_POST["Sper6"]; 
	$sper7 = $_POST["Sper7"]; 
	
	// Revisando si está ya registrado o no.
	$check = mysqli_query($connect, "select * from timetable where year='$year' AND sec='$section'");
	$count = mysqli_num_rows($check);
	if(!$count){
	//Si no está añadido, se añade ahora
	// Insertando a la base de datos 
	// Lunes
	$monday = mysqli_query($connect, "INSERT INTO timetable (day,per1,per2,per3,per4,per5,per6,per7,year,sec) VALUES ('$mday','$mper1','$mper2','$mper3','$mper4','$mper5','$mper6','$mper7','$year','$section')");
	// Martes
$tuesday = mysqli_query($connect, "INSERT INTO timetable (day,per1,per2,per3,per4,per5,per6,per7,year,sec) VALUES ('$tday','$tper1','$tper2','$tper3','$tper4','$tper5','$tper6','$tper7','$year','$section')");
// Miercoles
$wednesday = mysqli_query($connect, "INSERT INTO timetable (day,per1,per2,per3,per4,per5,per6,per7,year,sec) VALUES ('$wday','$wper1','$wper2','$wper3','$wper4','$wper5','$wper6','$wper7','$year','$section')");
// Jueves
$thursday = mysqli_query($connect, "INSERT INTO timetable (day,per1,per2,per3,per4,per5,per6,per7,year,sec) VALUES ('$thday','$thper1','$thper2','$thper3','$thper4','$thper5','$thper6','$thper7','$year','$section')");
// Viernes
$friday = mysqli_query($connect, "INSERT INTO timetable (day,per1,per2,per3,per4,per5,per6,per7,year,sec) VALUES ('$fday','$fper1','$fper2','$fper3','$fper4','$fper5','$fper6','$fper7','$year','$section')");
// Sábado
$saturday = mysqli_query($connect, "INSERT INTO timetable (day,per1,per2,per3,per4,per5,per6,per7,year,sec) VALUES ('$sday','$sper1','$sper2','$sper3','$sper4','$sper5','$sper6','$sper7','$year','$section')");
	
	$msg = "<font color=\"green\">Success.</font>";
}
else{
	// Mensaje de error
		$msg = "<font color=\"red\">Sorry! the time table is already added.</font>";
}
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
			<br/>
			<div class="promotes">
			<form method="post" action="add_timetable.php" name="regupdate">
			<table class="table table-bordered table-hover" width="600px">
			<caption align="center"><h3>Nuevo registro de la tabla de tiempos</h3></caption>
			<tbody>
				<th class="danger" colspan="8">Registro de la tabla de tiempos			
				</th>
			</td>
			</tr>
				<tr>
				
					<td class="info" colspan="4"> 	
						<select name="year" class="form-control">
					<option value="">-- SELECCIONE SEMESTRE--</option>
								
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
					<td class="info" colspan="4"> 	
						<select name="section" class="form-control">
					<option value=""> -- Sección--</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
			
						</select>
						
					</td>
				</tr>
				<tr>
					<td class="danger">Dia</td><td class="danger">Periodo-I</td><td class="danger">Periodo-II</td><td class="danger">Periodo-III</td><td class="danger">Periodo-IV</td><td class="danger">Periodo-V</td><td class="danger">Periodo-VI</td><td class="danger">Periodo-VII</td>
				</tr>
				<!-- Para seleccionar curso y día - Lunes-->
				<tr>
				<td class="info"><input type="text" name="Mday1" class="form-control" Readonly value="MONDAY"/></td>
				<td class="info">
				<select name="Mper1" class="form-control">
					<option value="---">No Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<!-- periodo 2 -->
				<td class="info">
				<select name="Mper2" class="form-control">
				<option value="---">No Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<!-- periodo 3 -->
				<td class="info">
				<select name="Mper3" class="form-control">
				<option value="---">No Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<!-- periodo 4 -->
				<td class="info">
				<select name="Mper4" class="form-control">
				<option value="---">No Period </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<!-- periodo 5 -->
				<td class="info">
				<select name="Mper5" class="form-control">
				<option value="---">Sin Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<!-- periodo 6 -->
				<td class="info">
				<select name="Mper6" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<!-- periodo 7 -->
				<td class="info">
				<select name="Mper7" class="form-control"><option value="---">Sin Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				</tr>
				<!-- Martes -->
	<tr>
				<td class="info"><input type="text" name="Tday1" class="form-control" Readonly value="TUESDAY"/></td>
				<td class="info">
				<select name="Tper1" class="form-control"><option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<td class="info">
				<select name="Tper2" class="form-control"><option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<!-- period 3 -->
				<td class="info">
				<select name="Tper3" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<td class="info">
				<select name="Tper4" class="form-control">
				<option value="---">Sin Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>

				<td class="info">
				<select name="Tper5" class="form-control">
				<option value="---">Sin Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<td class="info">
				<select name="Tper6" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				<td class="info">
				<select name="Tper7" class="form-control">
				<option value="---">Sin Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				</tr>
			<!-- Miercoles-->
	<tr>
				<td class="info"><input type="text" name="Wday1" class="form-control" Readonly value="WEDNESDAY"/></td>
				<td class="info">
				<select name="Wper1" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				
				<td class="info">
				<select name="Wper2" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				
				<td class="info">
				<select name="Wper3" class="form-control">
				<option value="---">Sin Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="Wper4" class="form-control">
				<option value="---">Sin Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				
				<td class="info">
				<select name="Wper5" class="form-control">
				<option value="---">Sin Periodo </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				
				<td class="info">
				<select name="Wper6" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				
				<td class="info">
				<select name="Wper7" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				</tr>
			<!-- Jueves -->
	<tr>
				<td class="info"><input type="text" name="THday1" class="form-control" Readonly value="THURSDAY"/></td>
				<td class="info">
				<select name="THper1" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
	
				<td class="info">
				<select name="THper2" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
		
				<td class="info">
				<select name="THper3" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
		
				<td class="info">
				<select name="THper4" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="THper5" class="form-control">
				<option value="---">Sin Periodo</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				
				<td class="info">
				<select name="THper6" class="form-control">
				<option value="---">Sin Periodo
</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="THper7" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				</tr>
			<!-- Viernes-->
	<tr>
				<td class="info"><input type="text" name="Fday1" class="form-control" Readonly value="FRIDAY"/></td>
				<td class="info">
				<select name="Fper1" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="Fper2" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				
				<td class="info">
				<select name="Fper3" class="form-control">
				<option value="---">Sin Periodo
</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="Fper4" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				
				<td class="info">
				<select name="Fper5" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="Fper6" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="Fper7" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				</tr>
			<!-- Sábado -->
				<tr>
				<td class="info"><input type="text" name="Sday1" class="form-control" Readonly value="SATURDAY"/></td>
				<td class="info">
				<select name="Sper1" class="form-control">
				<option value="---">Sin Periodo
</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="Sper2" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				
				<td class="info">
				<select name="Sper3" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="Sper4" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="Sper5" class="form-control">
				<option value="---">Sin Periodo
</option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
			
				<td class="info">
				<select name="Sper6" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				
				<td class="info">
				<select name="Sper7" class="form-control">
				<option value="---">Sin Periodo
 </option>
					<?php				
					$ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty`  GROUP BY `name` ORDER BY `name`");				
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					
				?>
				</select>
				</td>
				</tr>
			
				<tr>
					<td colspan="8" align="center" class="success">
						<input type="submit" class="btn btn-success" name="submit"	value="Registrar">	
					</td>
				</tr>
				<tr>
					<td colspan="8" align="center" class="success">
						<?php echo $msg; ?>
					</td>
				</tr>
			</tbody>			
			</table>
			</form>
		 </div>
		</div>
	</body>
</html>
