
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
$csubs="";
$csub="";
if((isset($_POST["fname"])) && (isset($_POST["subject"])) &&(isset($_POST["sem"])) &&(isset($_POST["sec"])) ){

	$name = $_POST["fname"];
	$subs = $_POST["subject"];
	$sec = $_POST["sec"];
	$sem = $_POST["sem"];
	//Revisando valores null
	if( ($name == "") || ($subs=="") || ($sec=="") || ($sem=="") ){
		$msg = "<div align='center'><font color='red'>Select all options properly</font></div>";
	}else{
	 $sql = mysqli_query($connect, "SELECT * FROM facsub WHERE names='$name'  and sem = '$sem' and sec = '$sec'");

	 $count = mysqli_num_rows($sql);
	 if($count){

		$update = mysqli_query($connect, "UPDATE facsub SET subjects = '$subs' WHERE names='$name'  and sem = '$sem' and sec = '$sec' ");
		$sql1 = mysqli_query($connect, "SELECT * FROM facsub WHERE names='$name'  and sem = '$sem' and sec = '$sec'");
	 		while($row=mysqli_fetch_array($sql1)){
				$csubs = $row["subjects"];
			}
			if($csubs == $subs){
					$msg = "<div align='center'><font color='green'>Cambio aplicado con éxito</font></div>";
			}
			else{
				$msg = "<div align='center'><font color='red'>El cambio no se puede aplicar, contacto administrador </font></div>";
			}
		
	}
	else{
		$msg = "<div align='center'><font color='red'>El parámetro de selección no coincide</font></div>";
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
			<div class="promote">
			<form method="post" action="edit_alloc.php" name="regupdate">
			<table class="table table-bordered table-hover" width="500px">
			<caption align="center"><h3>Editar Asignación de Asignatura </h3></caption>
			<tbody>
				<th class="danger" colspan="4">Seleccione Asunto para cambiar			
				</th>
			
				<tr>
					<td class="active" colspan="2">	
						<select name="fname" class="form-control" />
							<option value=""> Nombre de la facultad</option>
							<?php 
							//Recuperando el nombre de la facultad para mostrarlo como opción
								$sql=mysqli_query($connect, "select distinct(fname) as fname from user");
								while($row = mysqli_fetch_array($sql)){
									$faculty = $row["fname"];
									// Mostrandolo como opcion
									echo "<option value='$faculty'>$faculty</option>";
								}
							?>
						
						
					</td>
										<td class="active" colspan="2"><select name="subject" class="form-control">
							<option value="">Cambio Asignado Sujeto a</option>
					<?php
						
							//Recuperando el nombre del curso para mostrarlo como opción
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
				<!-- Elegir semestre -->
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
		 <!-- Para elegir sección -->
		 					<td class="active" colspan="2">							
			<select name="sec" class="form-control">
			<option value="">Seccion</option>
			<option value="A">A</option>
			<option value="B">B</option>

					
		 </select></td>
				</tr>
				<tr>
					<td colspan="4" align="center" class="success">
						<input type="submit" class="btn btn-success" name="submit"	value="Update Allocation">	
								
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center" class="success">
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
