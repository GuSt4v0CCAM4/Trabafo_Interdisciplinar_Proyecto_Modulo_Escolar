
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
if((isset($_POST["rid"])) && (isset($_POST["year"])) && (isset($_POST["section"])) && (isset($_POST["names"])) ){
	$id = $_POST["rid"];
	$year = $_POST["year"];
	$section=$_POST["section"];
	$sname = $_POST["names"];
	
	if($id=="" && $year=="" && $section == "" && $sname==""){
					$msg = "<font color=\"red\">Todos los campos son obligatorios.</font>";

	}
	else{
	
	//nuevo registro para  1-1 
	if($year == "I-I"){
					$sql = mysqli_query($connect, "SELECT * FROM s1 where id='$id' ");
					$count = mysqli_num_rows($sql);
				if($count){
					$msg = "<font color=\"red\">Lo sentimos Estudiantes ya registrados</font>";
				}
				else{
					$sql1 = mysqli_query($connect, "INSERT INTO `s1` (`id`, `sem`, `detained`,`sec`,`sname`) VALUES ('$id', 'I-I', '0','$section','$sname')");
					if($sql1){
						$msg = "<font color=\"green\">Registrado exitosamente</font>";
					}
					
				}
	}
	//para transferir estudiantes
	else if($year == "I-II"){
					$sql = mysqli_query($connect, "SELECT * FROM s2 where id='$id' ");
					$count = mysqli_num_rows($sql);
				if($count){
					$msg = "<font color=\"red\">Lo sentimos Estudiantes ya registrados
</font>";
				}
				else{
					$sql1 = mysqli_query($connect, "INSERT INTO `s2` (`id`, `sem`, `detained`,`sec`,`sname`) VALUES ('$id', 'I-II', '0','$section','$sname')");
					if($sql1){
						$msg = "<font color=\"green\">Registrado exitosamente</font>";
					}
					
				}
	}
	//REGISTRO PARA ENTRADA LATERAL
	else if($year == "II-I"){
					$sql = mysqli_query($connect, "SELECT * FROM s3 where id='$id' ");
					$count = mysqli_num_rows($sql);
				if($count){
					$msg = "<font color=\"red\">Lo sentimos Estudiantes ya registrados</font>";
				}
				else{
					$sql1 = mysqli_query($connect, "INSERT INTO `s3` (`id`, `sem`, `detained`,`sec`,`sname`) VALUES ('$id', 'II-I', '0','$section','$sname')");
					if($sql1){
						$msg = "<font color=\"green\">Registrado exitosamente</font>";
					}
					
				}
	}
//TRANSFERIR ESTUDIANTES II II
	else if($year == "II-II"){
					$sql = mysqli_query($connect, "SELECT * FROM s4 where id='$id' ");
					$count = mysqli_num_rows($sql);
				if($count){
					$msg = "<font color=\"red\">Lo sentimos Estudiantes ya registrados</font>";
				}
				else{
					$sql1 = mysqli_query($connect, "INSERT INTO `s4` (`id`, `sem`, `detained`,`sec`,`sname`) VALUES ('$id', 'II-II', '0','$section','$sname')");
					if($sql1){
						$msg = "<font color=\"green\">Registrado exitosamente</font>";
					}
					
				}
	}
	// III-I TRANSFERIR ESTUDIANTES
	else if($year == "III-I"){
					$sql = mysqli_query($connect, "SELECT * FROM s5 where id='$id' ");
					$count = mysqli_num_rows($sql);
				if($count){
					$msg = "<font color=\"red\">Lo sentimos Estudiantes ya registrados</font>";
				}
				else{
					$sql1 = mysqli_query($connect, "INSERT INTO `s5` (`id`, `sem`, `detained`,`sec`,`sname`) VALUES ('$id', 'III-I', '0','$section','$sname')");
					if($sql1){
						$msg = "<font color=\"green\">Registrado exitosamente</font>";
					}
					
				}
	}
	
	//PARA TRANSFERIR ESTUDIANTES III -II 
	else if($year == "III-II"){
					$sql = mysqli_query($connect, "SELECT * FROM s6 where id='$id' ");
					$count = mysqli_num_rows($sql);
				if($count){
					$msg = "<font color=\"red\">Lo sentimos Estudiantes ya registrados</font>";
				}
				else{
					$sql1 = mysqli_query($connect, "INSERT INTO `s6` (`id`, `sem`, `detained`,`sec`,`sname`) VALUES ('$id', 'III-II', '0','$section','$sname')");
					if($sql1){
						$msg = "<font color=\"green\">Registrado exitosamente</font>";
					}
					
				}
	}
	//PARA 4 1
	else if($year == "IV-I"){
					$sql = mysqli_query($connect, "SELECT * FROM s7 where id='$id' ");
					$count = mysqli_num_rows($sql);
				if($count){
					$msg = "<font color=\"red\">Lo sentimos Estudiantes ya registrados</font>";
				}
				else{
					$sql1 = mysqli_query($connect, "INSERT INTO `s7` (`id`, `sem`, `detained`,`sec`,`sname`) VALUES ('$id', 'IV-I', '0','$section','$sname')");
					if($sql1){
						$msg = "<font color=\"green\">Registrado exitosamente</font>";
					}
					
				}
	}
	//PARA EL SEMESTRE FINAL
	else if($year == "IV-II"){
					$sql = mysqli_query($connect, "SELECT * FROM s8 where id='$id' ");
					$count = mysqli_num_rows($sql);
				if($count){
					$msg = "<font color=\"red\">Lo sentimos Estudiantes ya registrados</font>";
				}
				else{
					$sql1 = mysqli_query($connect, "INSERT INTO `s8` (`id`, `sem`, `detained`,`sec`,`sname`) VALUES ('$id', 'IV-II', '0','$section','$sname')");
					if($sql1){
						$msg = "<font color=\"green\">Registrado exitosamente
</font>";
					}
					
				}
	}

	
	//final del else que indica not null
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
			<div class="promote">
			<form method="post" action="student_register.php" name="regupdate">
			<table class="table table-bordered table-hover" width="500px">
			<caption align="center"><h3>Registro de nuevos estudiantes
 </h3></caption>
			<tbody>
				<th class="danger" colspan="3">Registro				
				</th>
			<tr>
					<td class="info" colspan="3">
					<input type="text" name="names" class="form-control" placeholder="Name" />
						</td>
			</tr>
				<tr>
					<td class="info">	
						<input type="text" name="rid" class="form-control" placeholder="REG ID" />
					</td>
					<td class="info"> 	
						<select name="year" class="form-control">
					<option value="">--SELECCIONE SEMESTRE--</option>
								
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
					<td class="info"> 	
						<select name="section" class="form-control">
					<option value=""> -- Seccion--</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
			
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center" class="success">
						<input type="submit" class="btn btn-success" name="submit"	value="Register">	
								<p>Nota: para promover a los estudiantes<a href="promote.php">haga clic aquí</a></p>	
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center" class="success">
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
