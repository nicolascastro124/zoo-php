<?php
      /*
      Este php realizara la funcion de insertar lo datos en la base de datos, haciendo
      las comprobaciones necesarias antes de hacer dicho proceso, para la  tabla de animal
      */   
        $id_animal = $_GET["id_animal"];
        $nombre_animal = $_GET["nombre_animal"];
        $fk_sexo = $_GET["sexo"];
        $fk_especie = $_GET["especie"];
        $fk_zoologico = $_GET["zoo"];
        $fk_origen = $_GET["origen"];
           require("db.php"); // Se solicita los datos de conexion a base de datos
           $conexion = mysqli_connect($db_host, $db_user, $db_pass);
           if (mysqli_connect_errno()){
               ?>
                <script language='javascript'>
                alert('Fallo al conectar');
                location.href ="index.php";
                </script>"
               <?php
           }
           mysqli_select_db($conexion, $db_nombre) or die("no se encuentra");
           mysqli_set_charset($conexion,'utf8');
        
        // Comprobar si viene algun campo vacio o nulo
        if(empty($id_animal || $nombre_animal || $fk_sexo ||$fk_especie ||$fk_zoologico ||$fk_origen)){
               ?>
                <script language='javascript'>
                alert('Faltan datos');
                location.href ="index.php";
                </script>
               <?php 
        }else{
        $comprobar = "SELECT ID_ANIMAL from animal WHERE ID_ANIMAL=".$id_animal;
        $r = mysqli_query($conexion, $comprobar) or die;
        //Comprobacion para No tener id de animal repetida en base de datos
            if(mysqli_num_rows($r)>0){
                ?>
                <script language='javascript'>
                alert('Ya existe un registro con ese ID');
                location.href ="index.php";
                </script>"
               <?php
                
            }else{
                
                $consulta = "INSERT INTO animal (ID_ANIMAL, NOMBRE_ANIMAL, FK_SEXO, FK_ESPECIE, FK_ZOOLOGICO, FK_ORIGEN) VALUES ('$id_animal', '$nombre_animal', '$fk_sexo', '$fk_especie', '$fk_zoologico', '$fk_origen')";
                /* Se verifica si existen errores de sintaxis a la hora de hacer el insert en caso 
                contrario se procedera a mostrar un mensaje de exito */
            if(!mysqli_query($conexion,$consulta)){
                   ?>
                <script language='javascript'>
                alert('Error al Insertar');
                location.href ="index.php";
                </script>
                <?php 
                 
                }else{
                ?>
                <script language='javascript'>
                alert('Registro Ingresado correctamente');
                location.href ="listadoAnimales.php";
                </script>
                <?php 
            }
        
    }
    }
                mysqli_close($conexion);
?>