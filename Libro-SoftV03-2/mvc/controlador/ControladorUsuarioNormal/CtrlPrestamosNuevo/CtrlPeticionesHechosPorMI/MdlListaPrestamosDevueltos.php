<?php

//Agrego el archivo RegionPDO para acceder a sus funciones 
require('../../../../modelo/PrestamoPDO.php');


$prestamoPDO = new PrestamoPDO();


session_start();
$rut_usuario = $_SESSION['rut_usuario'];

$estado_prestamo = "Devuelto a pto intercambio";
$estado_prestamo2 = "Devuelto a dueño";

$listadoprestamos = $prestamoPDO->obtieneEstadoPrestamoPorRutPrestatarioNombreEstado2($rut_usuario, $estado_prestamo, $estado_prestamo2);


?>      

    <table class="table table-sm table-bordered table-responsive table-striped ">
        <tr class="table-active">
            <th>ID Prestamo</th>
            <th>Titulo Libro</th>
            <th>Dueño Libro</th>
            <th>Estado Prestamo</th>
            <th>Acción Recomendada</th>
            <th>Punto Intercambio</th>
            <th>Detalle</th>
                         
        </tr>

<?php           
    foreach($listadoprestamos as $row){ 

?>
        <!-- Este el el contenido de la tabla -->
        <tr>
            <td><?php echo $row["id_prestamo"]; ?></td>
            <td><?php echo $row["titulo_libro"]; ?></td>         

            <td><?php echo $row["Nombre_prestador"] . " " . $row["Apellido_prestador"];  ?></td>
            <td><?php echo $row["nombre_estado_prestamo"]; ?></td> 
            <td>
                <?php
                    if ($row["nombre_estado_prestamo"] == "Devuelto a pto intercambio") {
                        echo "Libro devuelto al punto de intercambio.";
                    }else if($row["nombre_estado_prestamo"] == "Devuelto a dueño"){
                        echo "Libro devuelto al su dueño.";
                    }
                ?>


            </td>
            <td><?php echo $row["nombre_pto_intercambio"]; ?></td> 
            <td><button class="btn btn-success" onclick="cargaModalDetallePrestamoEnCurso(<?php echo $row['id_prestamo']; ?>)" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalDetallePrestamoEnCurso">Detalle</button></td>  
           
        </tr>
    
<?php  } ?>

    </table>