
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
			<br/>
			<div class="promote">
		
			<table class="table table-bordered table-hover" width="400px">
			<caption align="center"><h3>Lista de profesores</h3></caption>
			<tbody>
				<th class="danger">Nombre</th><th class="danger">	ID de la facultad
</th>
				
				<?php
					
				//	echo  $yrs;
				//Ver lista de aprobados
					
						$sts = mysqli_query($connect, "SELECT * FROM user where did='1'");
						while($row=mysqli_fetch_array($sts)){
							$name = $row["fname"];
							$rid = $row["userId"];
							echo "<tr> <td class='info'>$name</td><td class='info'>$rid</td></tr>";
						}
					

				?>
				<tr> <td colspan="2" class="info"><a href="fac_subdetails.php">Ver detalles del asunto </a></td></tr>
			</tbody>			
			</table>
		

			</form>
		 </div>
		</div>
	</body>
</html>
