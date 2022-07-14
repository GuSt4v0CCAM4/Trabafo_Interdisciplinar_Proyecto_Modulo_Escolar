
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
//Valisando id
if(isset($_POST["old_Id"]) && isset($_POST["new_Id"])){
	$newID = $_POST["new_Id"];
	$old = $_POST["old_Id"];
	//Recuperando datos para validar la contraseña
	$sql1 = mysqli_query($connect, "SELECT * FROM user WHERE id='$id'and password = '$old' ");
	while($row= mysqli_fetch_array($sql1)){
		$ck = $row["password"];
	}

	if($ck == $old){
		//Mensaje éxito
		$sql = mysqli_query($connect, "UPDATE user SET password = '$newID' WHERE id='$id' and password = '$old' ");
		$msg = "<div align='center'><font color='green'>Successfully Changed</font></div>";
		
	}
	else{
		//Mensaje error
		$msg = "<div align='center'><font color='red'>Sorry Wrong Old Password, try again</font></div>";
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
			<form method="post" action="changePWD.php" name="regupdate">
			<table class="table table-bordered table-hover" width="400px">
			<caption align="center"><h3>Cambia la contraseña
</h3></caption>
			<tbody>
					<th class="danger" colspan="2">Nueva contraseña
			
				</th>
				<tr>
					<td class="active" colspan="2">	
						<input type="password" class="form-control" placeholder="Contraseña anterior" name="old_Id"/>
						
					</td>
		
				</tr>
				<tr>
					<td class="active" colspan="2">	
						<input type="password" class="form-control" placeholder="Nueva contraseña" name="new_Id"/>
						
					</td>
		
				</tr>
				<tr>
					<td colspan="2" align="center" class="success">
						<input type="submit" class="btn btn-success" name="submit"	value="cambio">	
								<p>Nota: Para cambiar Id<a href="changeID.php">haga clic aquí
</a></p>	
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
