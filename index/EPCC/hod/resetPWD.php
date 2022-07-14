
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
$ck="";
$id = $_SESSION["id"];
//comprobando si se pasa o no la nueva identificación
if(isset($_POST["old_Id"])){
	//$newID = $_POST["new_Id"];
	$old = $_POST["old_Id"];
	//recuperando datos para verificar la contraseña anterior
	$sql1 = mysqli_query($connect, "SELECT * FROM user WHERE  userId = '$old' ");
	while($row= mysqli_fetch_array($sql1)){
		$ck = $row["userId"];
	}

	if($ck == $old){
		//significa que fue exitoso, así que se actualiza
		$sql = mysqli_query($connect, "UPDATE user SET password = 'ssn1234cse' WHERE userId='$old' ");
		$msg = "<div align='center'><font color='green'>Password Reset Success</font></div>";
		
	}
	else{
		//significa que un error ha ocurrido
		$msg = "<div align='center'><font color='red'>Sorry Wrong ID provided, try again</font></div>";
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
			<form method="post" action="resetPWD.php" name="regupdate">
			<table class="table table-bordered table-hover" width="400px">
			<caption align="center"><h3>Restablecer la contraseña</h3></caption>
			<tbody>
					<th class="danger" colspan="2">Ingresar ID para restablecer la contraseña				
				</th>
				<tr>
					<td class="active" colspan="2">	
						<input type="text" class="form-control" placeholder="Enter ID" name="old_Id"/>
						</select>
					</td>
		
				</tr>
				<tr>
					<td class="active" colspan="2">	
						Nota: La contraseña de reinicio es: ssn1234cse.

					</td>
		
				</tr>

				<tr>
					<td colspan="2" align="center" class="success">
						<input type="submit" class="btn btn-success" name="submit"	value="Reset Password">	
							
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center" class="success">
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
