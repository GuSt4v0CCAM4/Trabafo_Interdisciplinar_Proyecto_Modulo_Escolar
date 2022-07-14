
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
		Agregar Asistencia
		</title>
	</head>
	<body>
		<div class="container" align="center">
			<div class="head pull-left">
				<h2 class="pull-left">EPCC<small>&nbsp;&nbsp;Universidad Nacional de San Agustin    </small></h2>
			</div>
			<hr class="horline" width="100%" /> 
			<div><?php include("../include/hodmenu.txt");?></div>
			<br/>
			<div class="promote">
			<form method="post" action="add_attendance.php" >
			<table class="table table-bordered table-hover" width="400px">
			<caption align="center"><h3>Agregar asistencia estudiantil  </h3></caption>
			<tbody>
				<th class="danger" colspan="3">Seleccione Semestre y Sección		
				</th>
			
				<tr>
					<td class="active" colspan="2">	
								<select name="sem" class="form-control">
			<option >-- Semestre --</option>
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
			<option >-- Sección --</option>
			<option value="A">A</option>
			<option value="B">B</option>
			<option value="C">C</option>

					
		</select>
					</td>
				</tr>
				<tr><td class="active" colspan="3"><input type="submit" class="btn btn-success" value="Get Sheet"/></td></tr>

			</tbody>			
			</table>
			</form>
		 </div>
		</div>

<?php
	include("../include/connect.php");
	$i=1;
	$j = 1;
	
if(isset($_POST["sem"]) && isset($_POST["section"])){
	$a = $_POST["sem"];
	$section = $_POST["section"];
	// Para la asistencia del primer semestre del primer año.
	if($a == "I-I"){
		$sql = mysqli_query($connect, "SELECT id,sem,sec,sname FROM s1 WHERE sec = '$section'");
		$count =  mysqli_num_rows($sql);
					echo "
					<div class='container'><div class='promotess'>
				<form method='post' action='add_attendance.php'>
				<table class='table table-bordered table-hover'>
				<tbody>
				<th class='danger' colspan='3'>Student Attendance</th>
				<tr><td class='info'>			
				<input type='date' class='form-control' name='date' ></td>";
			  	echo "
				<td class='info'><select class='form-control' name='fac'>";
				 $ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty` WHERE yr='I-I' GROUP BY `name` ORDER BY `name`");
				    $count1= mysqli_num_rows($ans);
				while($j<=$count1){
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					$j++;
				};
				echo "
				</select></td>
				<td class='info'>
						<select name='period' class='form-control'>
							<option value='1'>Primera hora</option>
							<option value='2'>Segunda hora</option>
							<option value='3'>Tercera hora</option>
							<option value='4'>Cuarta hora</option>
							<option value='5'>Quinta hora</option>
							<option value='6'>Sexta hora</option>
							<option value='7'>Septima hora</option>
						</select>
				</td>
				</tr></tbody></table>
				<input type='hidden' name='year' value='I-I'/> 
				";
				while($row = mysqli_fetch_array($sql)){
					$id = $row["id"];
					$sem = $row["sem"];
					$sections = $row["sec"];
					$nm = $row["sname"];
					echo "
						<input type='text' readonly value='$nm' name='nm$i'>
						<input type='text' readonly value='$id' name='ids$i'>
						<input type='checkbox'  name='result$i' value='1'>&nbsp;<br/>
					<input type='hidden' name='count' value='$count'/> 
					<input type='hidden' name='sect$i' value='$sections'/> 
				
					";
					$i++;
				}
				echo "		<table class='table'><tr><td colspan='2' align='center' class='info'> <input type='submit' class='btn btn-success' name='ok' value='Agregar'>	</td></tr>
				
				</table></form></div></div>";
	}
	else if($a == "I-II"){
		$sql = mysqli_query($connect, "SELECT id,sem,sec,sname FROM s2 WHERE sec = '$section'");
		$count =  mysqli_num_rows($sql);
					echo "
					<div class='container'><div class='promotess'>
				<form method='post' action='add_attendance.php'>
				<table class='table table-bordered table-hover'>
				<tbody>
				<th class='danger' colspan='3'>Asistencia del estudiante</th>
				<tr><td class='info'>			
				<input type='date' class='form-control' name='date' ></td>";
			  	echo "
				<td class='info'><select class='form-control' name='fac'>";
				 $ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty` WHERE yr='I-II' GROUP BY `name` ORDER BY `name`");
				    $count1= mysqli_num_rows($ans);
				while($j<=$count1){
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					$j++;
				};
				echo "
				</select></td>
								<td class='info'>
						<select name='period' class='form-control'>
							<option value='1'>Primera hora</option>
							<option value='2'>Segunda hora</option>
							<option value='3'>Tercera hora</option>
							<option value='4'>Cuarta hora</option>
							<option value='5'>Quinta hora</option>
							<option value='6'>Sexta hora</option>
							<option value='7'>Septima hora</option>
						</select>
				</td>
				</tr></tbody></table>
				<input type='hidden' name='year' value='I-II'/> 
				";
				while($row = mysqli_fetch_array($sql)){
					$id = $row["id"];
					$sem = $row["sem"];
					$sections = $row["sec"];
					$nm = $row["sname"];
					echo "
						<input type='text' readonly value='$nm' name='nm$i'>
						<input type='text' readonly value='$id' name='ids$i'>
						<input type='checkbox'  name='result$i' value='1'>&nbsp;<br/>
					<input type='hidden' name='count' value='$count'/> 
					<input type='hidden' name='sect$i' value='$sections'/> 
				
					";
					$i++;
				}
				echo "		<table class='table'><tr><td colspan='2' align='center' class='info'> <input type='submit' class='btn btn-success' name='ok' value='Add'>	</td></tr>
				
				</table></form></div></div>";
	}
	else if($a == "II-I"){
		$sql = mysqli_query($connect, "SELECT id,sem,sec,sname FROM s3 WHERE sec = '$section'");
		$count =  mysqli_num_rows($sql);
					echo "
					<div class='container'><div class='promotess'>
				<form method='post' action='add_attendance.php'>
				<table class='table table-bordered table-hover'>
				<tbody>
				<th class='danger' colspan='3'>Asistencia del estudiante</th>
				<tr><td class='info'>			
				<input type='date' class='form-control' name='date' ></td>";
			  	echo "
				<td class='info'><select class='form-control' name='fac'>";
				 $ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty` WHERE yr='II-I' GROUP BY `name` ORDER BY `name`");
				    $count1= mysqli_num_rows($ans);
				while($j<=$count1){
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					$j++;
				};
				echo "
				</select></td>
								<td class='info'>
						<select name='period' class='form-control'>
							<option value='1'>Primera hora</option>
							<option value='2'>Segunda hora</option>
							<option value='3'>Tercera hora</option>
							<option value='4'>Cuarta hora</option>
							<option value='5'>Quinta hora</option>
							<option value='6'>Sexta hora</option>
							<option value='7'>Septima hora</option>
						</select>
				</td></tr></tbody></table>
				<input type='hidden' name='year' value='II-I'/> 
				";
				while($row = mysqli_fetch_array($sql)){
					$id = $row["id"];
					$sem = $row["sem"];
					$sections = $row["sec"];
					$nm = $row["sname"];
					echo "
						<input type='text' readonly value='$nm' name='nm$i'>
						<input type='text' readonly value='$id' name='ids$i'>
						<input type='checkbox'  name='result$i' value='1'>&nbsp;<br/>
					<input type='hidden' name='count' value='$count'/> 
					<input type='hidden' name='sect$i' value='$sections'/> 
				
					";
					$i++;
				}
				echo "		<table class='table'><tr><td colspan='2' align='center' class='info'> <input type='submit' class='btn btn-success' name='ok' value='Agregar'>	</td></tr>
				
				</table></form></div></div>";
	}
	else if($a == "II-II"){
				$sql = mysqli_query($connect, "SELECT id,sem,sec,sname FROM s4 WHERE sec = '$section'");
		$count =  mysqli_num_rows($sql);
					echo "
					<div class='container'><div class='promotess'>
				<form method='post' action='add_attendance.php'>
				<table class='table table-bordered table-hover'>
				<tbody>
				<th class='danger' colspan='3'>Asistencia del estudiante</th>
				<tr><td class='info'>			
				<input type='date' class='form-control' name='date' ></td>";
			  	echo "
				<td class='info'><select class='form-control' name='fac'>";
				 $ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty` WHERE yr='II-II' GROUP BY `name` ORDER BY `name`");
				    $count1= mysqli_num_rows($ans);
				while($j<=$count1){
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					$j++;
				};
				echo "
				</select></td>
								<td class='info'>
						<select name='period' class='form-control'>
					<option value='1'>Primera hora</option>
							<option value='2'>Segunda hora</option>
							<option value='3'>Tercera hora</option>
							<option value='4'>Cuarta hora</option>
							<option value='5'>Quinta hora</option>
							<option value='6'>Sexta hora</option>
							<option value='7'>Septima hora</option>
						</select>
				</td></tr></tbody></table>
				<input type='hidden' name='year' value='II-II'/> 
				";
				while($row = mysqli_fetch_array($sql)){
					$id = $row["id"];
					$sem = $row["sem"];
					$sections = $row["sec"];
					$nm = $row["sname"];
					echo "
						<input type='text' readonly value='$nm' name='nm$i'>
						<input type='text' readonly value='$id' name='ids$i'>
						<input type='checkbox'  name='result$i' value='1'>&nbsp;<br/>
					<input type='hidden' name='count' value='$count'/> 
					<input type='hidden' name='sect$i' value='$sections'/> 
				
					";
					$i++;
				}
				echo "		<table class='table'><tr><td colspan='2' align='center' class='info'> <input type='submit' class='btn btn-success' name='ok' value='Agregar'>	</td></tr>
				
				</table></form></div></div>";
	}
	else if($a == "III-I"){
		$sql = mysqli_query($connect, "SELECT id,sem,sec,sname FROM s5 WHERE sec = '$section'");
		$count =  mysqli_num_rows($sql);
					echo "
					<div class='container'><div class='promotess'>
				<form method='post' action='add_attendance.php'>
				<table class='table table-bordered table-hover'>
				<tbody>
				<th class='danger' colspan='3'>	Asistencia del estudiante</th>
				<tr><td class='info'>			
				<input type='date' class='form-control' name='date' ></td>";
			  	echo "
				<td class='info'><select class='form-control' name='fac'>";
				 $ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty` WHERE yr='III-I' GROUP BY `name` ORDER BY `name`");
				    $count1= mysqli_num_rows($ans);
				while($j<=$count1){
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					$j++;
				};
				echo "
				</select></td>
								<td class='info'>
						<select name='period' class='form-control'>
						<option value='1'>Primera hora</option>
							<option value='2'>Segunda hora</option>
							<option value='3'>Tercera hora</option>
							<option value='4'>Cuarta hora</option>
							<option value='5'>Quinta hora</option>
							<option value='6'>Sexta hora</option>
							<option value='7'>Septima hora</option>
						</select>
				</td></tr></tbody></table>
				<input type='hidden' name='year' value='III-I'/> 
				";
				while($row = mysqli_fetch_array($sql)){
					$id = $row["id"];
					$sem = $row["sem"];
					$sections = $row["sec"];
					$nm = $row["sname"];
					echo "
						<input type='text' readonly value='$nm' name='nm$i'>
						<input type='text' readonly value='$id' name='ids$i'>
						<input type='checkbox'  name='result$i' value='1'>&nbsp;<br/>
					<input type='hidden' name='count' value='$count'/> 
					<input type='hidden' name='sect$i' value='$sections'/> 
				
					";
					$i++;
				}
				echo "		<table class='table'><tr><td colspan='2' align='center' class='info'> <input type='submit' class='btn btn-success' name='ok' value='Agregar'>	</td></tr>
				
				</table></form></div></div>";
	}
	else if($a == "III-II"){
		$sql = mysqli_query($connect, "SELECT id,sem,sec,sname FROM s6 WHERE sec = '$section'");
		$count =  mysqli_num_rows($sql);
					echo "
					<div class='container'><div class='promotess'>
				<form method='post' action='add_attendance.php'>
				<table class='table table-bordered table-hover'>
				<tbody>
				<th class='danger' colspan='3'>Asistencia del estudiante</th>
				<tr><td class='info'>			
				<input type='date' class='form-control' name='date' ></td>";
			  	echo "
				<td class='info'><select class='form-control' name='fac'>";
				 $ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty` WHERE yr='III-II' GROUP BY `name` ORDER BY `name`");
				    $count1= mysqli_num_rows($ans);
				while($j<=$count1){
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					$j++;
				};
				echo "
				</select></td>
								<td class='info'>
						<select name='period' class='form-control'>
						<option value='1'>Primera hora</option>
							<option value='2'>Segunda hora</option>
							<option value='3'>Tercera hora</option>
							<option value='4'>Cuarta hora</option>
							<option value='5'>Quinta hora</option>
							<option value='6'>Sexta hora</option>
							<option value='7'>Septima hora</option>
						</select>
				</td></tr></tbody></table>
				<input type='hidden' name='year' value='III-II'/> 
				";
				while($row = mysqli_fetch_array($sql)){
					$id = $row["id"];
					$sem = $row["sem"];
					$sections = $row["sec"];
					$nm = $row["sname"];
					echo "
						<input type='text' readonly value='$nm' name='nm$i'>
						<input type='checkbox'  name='result$i' value='1'>&nbsp;<br/>
					<input type='hidden' name='count' value='$count'/> 
					<input type='hidden' name='sect$i' value='$sections'/> 
				
					";
					$i++;
				}
				echo "		<table class='table'><tr><td colspan='2' align='center' class='info'> <input type='submit' class='btn btn-success' name='ok' value='Agregar'>	</td></tr>
				
				</table></form></div></div>";
	}
	else if($a == "IV-I"){
		$sql = mysqli_query($connect, "SELECT id,sem,sec,sname FROM s7 WHERE sec = '$section'");
		$count =  mysqli_num_rows($sql);
					echo "
					<div class='container'><div class='promotess'>
				<form method='post' action='add_attendance.php'>
				<table class='table table-bordered table-hover'>
				<tbody>
				<th class='danger' colspan='3'>Asistencia del estudiante</th>
				<tr><td class='info'>			
				<input type='date' class='form-control' name='date' ></td>";
			  	echo "
				<td class='info'><select class='form-control' name='fac'>";
				 $ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty` WHERE yr='IV-I' GROUP BY `name` ORDER BY `name`");
				    $count1= mysqli_num_rows($ans);
				while($j<=$count1){
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					$j++;
				};
				echo "
				</select></td>
								<td class='info'>
						<select name='period' class='form-control'>
							<option value='1'>Primera hora</option>
							<option value='2'>Segunda hora</option>
							<option value='3'>Tercera hora</option>
							<option value='4'>Cuarta hora</option>
							<option value='5'>Quinta hora</option>
							<option value='6'>Sexta hora</option>
							<option value='7'>Septima hora</option>
						</select>
				</td></tr></tbody></table>
				<input type='hidden' name='year' value='IV-I'/> 
				";
				while($row = mysqli_fetch_array($sql)){
					$id = $row["id"];
					$sem = $row["sem"];
					$sections = $row["sec"];
					$nm = $row["sname"];
					echo "
						<input type='text' readonly value='$nm' name='nm$i'>
						<input type='text' readonly value='$id' name='ids$i'>
						<input type='checkbox'  name='result$i' value='1'>&nbsp;<br/>
					<input type='hidden' name='count' value='$count'/> 
					<input type='hidden' name='sect$i' value='$sections'/> 
				
					";
					$i++;
				}
				echo "		<table class='table'><tr><td colspan='2' align='center' class='info'> <input type='submit' class='btn btn-success' name='ok' value='Agregar'>	</td></tr>
				
				</table></form></div></div>";
	}
	else if($a == "IV-II"){
		$sql = mysqli_query($connect, "SELECT id,sem,sec,sname FROM s8 WHERE sec = '$section'");
		$count =  mysqli_num_rows($sql);
					echo "
					<div class='container'><div class='promotess'>
				<form method='post' action='add_attendance.php'>
				<table class='table table-bordered table-hover'>
				<tbody>
				<th class='danger' colspan='3'>Asistencia del estudiante</th>
				<tr><td class='info'>			
				<input type='date' class='form-control' name='date' ></td>";
			  	echo "
				<td class='info'><select class='form-control' name='fac'>";
				 $ans = mysqli_query($connect, "SELECT COUNT(*) AS `Rows`, `name` FROM `faculty` WHERE yr='IV-II' GROUP BY `name` ORDER BY `name`");
				    $count1= mysqli_num_rows($ans);
				while($j<=$count1){
					while($row = mysqli_fetch_array($ans)){
						 $fname = $row["name"];
						echo "<option value='$fname'>$fname</option>";	
					}
					$j++;
				};
				echo "
				</select></td>
								<td class='info'>
						<select name='period' class='form-control'>
							
								<option value='1'>Primera hora</option>
							<option value='2'>Segunda hora</option>
							<option value='3'>Tercera hora</option>
							<option value='4'>Cuarta hora</option>
							<option value='5'>Quinta hora</option>
							<option value='6'>Sexta hora</option>
							<option value='7'>Septima hora</option>
						</select>
				</td></tr></tbody></table>
				<input type='hidden' name='year' value='IV-II'/> 
				";
				while($row = mysqli_fetch_array($sql)){
					$id = $row["id"];
					$sem = $row["sem"];
					$sections = $row["sec"];
					$nm = $row["sname"];
					echo "
						<input type='text' readonly value='$nm' name='nm$i'>
						<input type='text' readonly value='$id' name='ids$i'>
						<input type='checkbox'  name='result$i' value='1'>&nbsp;<br/>
					<input type='hidden' name='count' value='$count'/> 
					<input type='hidden' name='sect$i' value='$sections'/> 
				
					";
					$i++;
				}
				echo "		<table class='table'><tr><td colspan='2' align='center' class='info'> <input type='submit' class='btn btn-success' name='ok' value='Agregar'>	</td></tr>
				
				</table></form></div></div>";
	}
	
}
?>

<?php

	$msg="";
	$succ="";
	$count="";
	$sem="";
	$res="";
	$i=1;
	do{
	if(isset($_POST["ids$i"]) && isset($_POST["date"]) && (isset($_POST["period"]))){
		 if(isset($_POST["result$i"]) == null){
			$res = 0;
		 }
		 else{
			$res = $_POST["result$i"];
		}
		
		$period = $_POST["period"];
		$date = $_POST["date"];
		$count = $_POST["count"];
		$fac = $_POST["fac"];
		$sem = $_POST["year"];
		$sec = $_POST["sect$i"];
		$ides = $_POST["ids$i"];
		$names = $_POST["nm$i"];

		//Asistencia del primer año - primer semestre
	 if($sem == "I-I"){
		$check = mysqli_query($connect, "select id from a1 where(fac='$fac' and day='$date') and (sec = '$sec' and per = '$period') ");
		$countCheck = mysqli_num_rows($check);
		//Recuperando el periodo para confirmar si la asistencia para ese periodo fue insertanda un día o no
		$checkSub = mysqli_query($connect, "select per from a1 where day='$date' and per = '$period' and sec='$sec' ");
		$pers = mysqli_num_rows($checkSub);
		//Confirmando (revisando) el periodo
		if($pers == $count){
			// Mensaje - Ya insertado
					echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		else{
		//La asistencia para ese periodo no está, así que se inserta a la base de datos.
		if($countCheck != $count){
			$sql1 = mysqli_query($connect, "INSERT INTO `a1` (`id`, `sem`, `day`, `atten`, `fac`,`sec`,`per`,`sname`) VALUES ('$ides','$sem','$date','$res','$fac','$sec','$period','$names');");
		}
		else{
			echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este tema ya está insertada
</b></font></div>";
			break;
		}
		}
		
	 }
	 else if($sem == "I-II"){
		$check = mysqli_query($connect, "select id from a2 where (fac='$fac' and day='$date') and (sec = '$sec' and per = '$period') ");
		$countCheck = mysqli_num_rows($check);
		$checkSub = mysqli_query($connect, "select per from a2 where day='$date' and per = '$period' and sec='$sec' ");
		$pers = mysqli_num_rows($checkSub);
		if($pers == $count){
					echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		else{
		if($countCheck != $count){
			$sql1 = mysqli_query($connect, "INSERT INTO `a2` (`id`, `sem`, `day`, `atten`, `fac`,`sec`,`per`,`sname`) VALUES ('$ides','$sem','$date','$res','$fac','$sec','$period','$names');");
		}
		else{
			echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este tema ya está insertada
</b></font></div>";
			break;
		}
		}
		
	 }
	 else if($sem == "II-I"){
		$check = mysqli_query($connect, "select id from a3 where (fac='$fac' and day='$date') and (sec = '$sec' and per = '$period') ");
		$countCheck = mysqli_num_rows($check);
		$checkSub = mysqli_query($connect, "select per from a3 where day='$date' and per = '$period' and sec='$sec' ");
		$pers = mysqli_num_rows($checkSub);
		if($pers == $count){
					echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		else{
		if($countCheck != $count){
			$sql1 = mysqli_query($connect, "INSERT INTO `a3` (`id`, `sem`, `day`, `atten`, `fac`,`sec`,`per`,`sname`) VALUES ('$ides','$sem','$date','$res','$fac','$sec','$period','$names');");
		}
		else{
			echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este tema ya está insertada
</b></font></div>";
			break;
		}
		}
		
	 }
	 else if($sem == "II-II"){
		$check = mysqli_query($connect, "select id from a4 where (fac='$fac' and day='$date') and (sec = '$sec' and per = '$period') ");
		$countCheck = mysqli_num_rows($check);
		$checkSub = mysqli_query($connect, "select per from a4 where day='$date' and per = '$period' and sec='$sec' ");
		$pers = mysqli_num_rows($checkSub);
		if($pers == $count){
					echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		else{
		if($countCheck != $count){
			$sql1 = mysqli_query($connect, "INSERT INTO `a4` (`id`, `sem`, `day`, `atten`, `fac`,`sec`,`per`,`sname`) VALUES ('$ides','$sem','$date','$res','$fac','$sec','$period','$names');");
		}
		else{
			echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este tema ya está insertada
</b></font></div>";
			break;
		}
		}
		
	 }
	 else if($sem == "III-I"){
		$check = mysqli_query($connect, "select id from a5 where (fac='$fac' and day='$date') and (sec = '$sec' and per = '$period') ");
		$countCheck = mysqli_num_rows($check);
		$checkSub = mysqli_query($connect, "select per from a5 where day='$date' and per = '$period' and sec='$sec' ");
		$pers = mysqli_num_rows($checkSub);
		if($pers == $count){
					echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		else{
		if($countCheck != $count){
			$sql1 = mysqli_query($connect, "INSERT INTO `a5` (`id`, `sem`, `day`, `atten`, `fac`,`sec`,`per`,`sname`) VALUES ('$ides','$sem','$date','$res','$fac','$sec','$period','$names');");
		}
		else{
			echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		}
	 }
	 else if($sem == "III-II"){
		$check = mysqli_query($connect, "select id from a6 where (fac='$fac' and day='$date') and (sec = '$sec' and per = '$period') ");
		$countCheck = mysqli_num_rows($check);
		$checkSub = mysqli_query($connect, "select per from a6 where day='$date' and per = '$period' and sec='$sec' ");
		$pers = mysqli_num_rows($checkSub);
		if($pers == $count){
					echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		else{
		if($countCheck != $count){
			$sql1 = mysqli_query($connect, "INSERT INTO `a6` (`id`, `sem`, `day`, `atten`, `fac`,`sec`,`per`,`sname`) VALUES ('$ides','$sem','$date','$res','$fac','$sec','$period','$names');");
		}
		else{
			echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		}
		
	 }
	 else if($sem == "IV-I"){
		$check = mysqli_query($connect, "select id from a7 where (fac='$fac' and day='$date') and (sec = '$sec' and per = '$period') ");
		$countCheck = mysqli_num_rows($check);
		$checkSub = mysqli_query($connect, "select per from a7 where day='$date' and per = '$period' and sec='$sec' ");
		$pers = mysqli_num_rows($checkSub);
		if($pers == $count){
					echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		else{
		if($countCheck != $count){
			$sql1 = mysqli_query($connect, "INSERT INTO `a7` (`id`, `sem`, `day`, `atten`, `fac`,`sec`,`per`,`sname`) VALUES ('$ides','$sem','$date','$res','$fac','$sec','$period','$names');");
		}
		else{
			echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		}
		
	 }
	 else if($sem == "IV-II"){
		$check = mysqli_query($connect, "select id from a8 where (fac='$fac' and day='$date') and (sec = '$sec' and per = '$period')  ");
		$countCheck = mysqli_num_rows($check);
		$checkSub = mysqli_query($connect, "select per from a8 where day='$date' and per = '$period' and sec='$sec' ");
		$pers = mysqli_num_rows($checkSub);
		if($pers == $count){
					echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		else{
		if($countCheck != $count){
			$sql1 = mysqli_query($connect, "INSERT INTO `a8` (`id`, `sem`, `day`, `atten`, `fac`,`sec`,`per`,`sname`) VALUES ('$ides','$sem','$date','$res','$fac','$sec','$period','$names');");
		}
		else{
			echo "<div align='center'><font color='red'><b>Lo siento, la asistencia para este período ya está insertada
</b></font></div>";
			break;
		}
		}
				
	 }
	
	}
	$i++;

	}while($i<=$count);
	 
		
?>


	</body>
</html>
