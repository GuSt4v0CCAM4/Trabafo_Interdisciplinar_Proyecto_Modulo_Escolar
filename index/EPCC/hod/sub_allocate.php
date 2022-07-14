
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
$ids="";
$sbj="";
if((isset($_POST["fname"])) && (isset($_POST["subject"])) &&(isset($_POST["sem"])) &&(isset($_POST["sec"])) ){

	$name = $_POST["fname"];
	$subs = $_POST["subject"];
	$sec = $_POST["sec"];
	$sem = $_POST["sem"];
	//COMPROBACIÓN PARA LOS VALORES NULOS 
	if( ($name == "") || ($subs=="") || ($sec=="") || ($sem=="") ){
		$msg = "<div align='center'><font color='red'>Seleccione todas las opciones apropiadamente</font></div>";
	}else{
		
		//$check = mysql_query("SELECT * FROM `facsub` WHERE `name`='$name' and `sub` ='$sub' and `sem`='$sem' and `sec`='$sec'");
		$sql = mysqli_query($connect, "SELECT * FROM facsub WHERE names='$name' and subjects='$subs' and sem = '$sem' and sec = '$sec'");
		$count = mysqli_num_rows($sql);
		//COMPROBAR SI EL ESTUDIANTE YA ESTÁ INSCRITO O NO
		if($count){
			//LOGRADO SIGNIFICA REGISTRADO POR LO CUAL DESPLIEGA EL MISMO MENSAJE
			$msg = "<div align='center'><font color='red'>Sujeto ya asignado.<a href='edit_alloc.php'>Haga clic aquí para editar</a></font></div>";
		}
		else{
		//AÚN NO REGISTRADO POR LO CUAL ASIGNAR EL ESTUDIANTE A LA FACULTAD
			$insert = mysqli_query($connect, "INSERT INTO facsub (names,subjects,sem,sec) VALUES ('$name','$subs','$sem','$sec')");
			if($insert){
				$msg = "<div align='center'><font color='green'>Asignado con éxito</font></div>";
			}
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
				<h2 class="pull-left">EPCC<small>&nbsp;&nbsp;Universidad Nacional de San Agustin    </small></h2>
			</div>
			<hr class="horline" width="100%" /> 
			<div><?php include("../include/hodmenu.txt");?></div>
			<br/>
			<div class="promote">
			<form method="post" action="sub_allocate.php" name="regupdate">
			<table class="table table-bordered table-hover" width="500px">
			<caption align="center"><h3>Nuevo registro de sujeto </h3></caption>
			<tbody>
				<th class="danger" colspan="4">Asignación de asignatura				
				</th>
			
				<tr>
					<td class="active" colspan="2">	
						<select name="fname" class="form-control" />
							<option value=""> Nombre de la facultad</option>
							<?php 
							//recuperando el nombre de la facultad para mostrar en la opción de selección
								$sql=mysqli_query($connect, "select distinct(fname) as fname from user");
								while($row = mysqli_fetch_array($sql)){
									$faculty = $row["fname"];
									// mostrar como una opción 
									echo "<option value='$faculty'>$faculty</option>";
								}
							?>
						
						</select>
					</td>
										<td class="active" colspan="2"><select name="subject" class="form-control">
							<option value="">Nombre del tema</option>
					<?php
						
							//mostrar y recuperar el nombre del estudiante de la base de datos para mostrar en las opciones de selección
						$ans = mysqli_query($connect, "SELECT distinct(`name`) FROM `faculty`  ORDER BY `name`");
						while($row = mysqli_fetch_array($ans)){
							$fname = $row["name"];
							echo "<option value='$fname'>$fname</option>";	
						}
					?>
					</select>	
						</td>
					
					
				</tr>
				<tr>
				<!-- for selecting semester -->
					<td class="active" colspan="2">							
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
					
		 </select></td>
		 <!-- for selecting seciton -->
		 					<td class="active" colspan="2">							
			<select name="sec" class="form-control">
			<option value="">Seccion</option>
			<option value="A">A</option>
			<option value="B">B</option>

					
		 </select></td>
				</tr>
				<tr>
					<td colspan="3" align="center" class="success">
						<input type="submit" class="btn btn-success" name="submit"	value="Allocate">	
								
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
