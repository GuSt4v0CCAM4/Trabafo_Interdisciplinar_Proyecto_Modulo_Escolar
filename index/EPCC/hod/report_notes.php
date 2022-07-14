    <?php
include_once "conexion.php";
include_once "encabezado.php";
include_once "Estudiante.php";
include_once "Materia.php";
include_once "Nota.php";
$materias = Materia::obtener();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.esm.min.js" integrity="sha512-yPOQ2pPoQ9JtP0/jDKpXiKyWNCJWT5OI+6r1EqZmTg+afKQOBpy08VYboeq+Tt9kl9/FOCueEhH6cmHN3nAdJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/helpers.esm.min.js" integrity="sha512-vxCPccgWacJoW2HlxhlKKtczdzvcg0r1UuB9LfNGt6vsDbgLfSFxKlolUS2mqKNXrOK5b93S45309T+V5BhueA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <title>Informe de Notas</title>
    </head>
        <body>
            <form><input type='button' class='hidden-print btn btn-success' onClick='javascript:print()' value='Impresión'/></form>
            <br>
            
            <table class="table table-bordered table-hover">Notas de la Primemra Unidad
                <tr>
                    <td>Nombre</td>
                    <td>Nota Continua</td>
                    <td>Examen</td>
                    <td>Puntaje total de la Primera Unidad</td>
                </tr>
                
                <?php
                // consultamod dos tablas dinamicas con la ayuda de INNER JOIN
                $sql="SELECT * FROM estudiantes e INNER JOIN notas_estudiantes_materias n
                ON e.id = n.id_estudiante WHERE n.id_materia = 8";
                $sql1="SELECT * FROM estudiantes e INNER JOIN notas_estudiantes_materias n
                ON e.id = n.id_estudiante WHERE n.id_materia = 9";
                $result=mysqli_query($mysqli,$sql);
                $result1=mysqli_query($mysqli,$sql1);
                
                //Bucle con dos condicionales para mostrar los datos que contiene la evaluacion continua y examen
                while($mostrar=mysqli_fetch_array($result) AND $mostrar1=mysqli_fetch_array($result1)){
                ?>
                <tr>
                    <td><?php echo $mostrar['nombre'] ?></td>
                    <td><?php echo $mostrar['puntaje'] ?></td>
                    <td><?php echo $mostrar1['puntaje'] ?></td>
                    <td><?php 
                        $nota1 = $mostrar['puntaje'];
                        $nota2 = $mostrar1['puntaje'];
                        $por1 = 0.10;
                        $por2 = 0.10;
                        $prom = ($nota1 * $por1)+($nota2 * $por2);
                        echo $prom
                        ?></td>
                </tr>
                    <?php 
                }
                
                // Con la ayuda de Chart.js se crea el siguiente grafico a partir de los datos de la tabla
                ?>
            </table>
       <div style="width: 500px; height: 500px; text-align: center;" ><canvas id="myChart" width="400" height="400"></canvas>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            <?php
            $sql2 = "SELECT * FROM estudiantes";
            $result = mysqli_query($mysqli,$sql2);
            while($registros = mysqli_fetch_array($result)){
            ?>
             '<?php echo $registros["nombre"] ?>',
            <?php
            }
            ?>
        ],
        datasets: [
            {
            label: 'Nota Continua',
            data: [
            <?php
                $sql="SELECT * FROM estudiantes e INNER JOIN notas_estudiantes_materias n
                ON e.id = n.id_estudiante WHERE n.id_materia = 8";
                $result=mysqli_query($mysqli,$sql);
                while($mostrar1=mysqli_fetch_array($result)){
                ?>
                '<?php echo $mostrar1['puntaje'] ?>',
                <?php
                    }
                ?>

            ],
            
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },
            {
            label: 'Examen',
            data: [
            <?php
                $sql1="SELECT * FROM estudiantes e INNER JOIN notas_estudiantes_materias n
                ON e.id = n.id_estudiante WHERE n.id_materia = 9";
                $result1=mysqli_query($mysqli,$sql1);
                while($mostrar=mysqli_fetch_array($result1)){
                ?>
                '<?php echo $mostrar['puntaje'] ?>',
                <?php
                    }
                ?>

            ],
            
            backgroundColor: [
                'rgba(255, 159, 64, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }
        
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
           </div> 
        </body>
</html>