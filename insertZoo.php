<?php
      /*
      Este php realizara la funcion de insertar lo datos en la base de datos, haciendo
      las comprobaciones necesarias antes de hacer dicho proceso, para la tabla de zoologico
      */    
        $id_zoologico = $_GET["id_zoo"];
        $nombre_zoologico = $_GET["nombre_zoo"];
        $presupuesto = $_GET["presupuesto"];
        $tamanio = $_GET["tamanio"];
        $ciudad = $_GET["ciudad"];
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
        if(empty($id_zoologico || $nombre_zoologico || $presupuesto || $tamanio ||$ciudad)){
               ?>
                <script language='javascript'>
                alert('Faltan datos');
                location.href ="index.php";
                </script>
               <?php 
        }else{
            $comprobar = "SELECT ID_ZOOLOGICO from zoologico WHERE ID_ZOOLOGICO=".$id_zoologico;
            $r = mysqli_query($conexion, $comprobar) or die;
            
            //Comprobacion para No tener id de zoologico repetida en base de datos
            if(mysqli_num_rows($r)>0){
                ?>
                <script language='javascript'>
                alert('Ya existe un registro con ese ID');
                location.href ="index.php";
                </script>"
               <?php
                
            }else{
                $consulta = "INSERT INTO zoologico (ID_ZOOLOGICO, NOMBRE_ZOOLOGICO, PRESUPUESTO, TAMANIO, FK_CIUDAD) VALUES('$id_zoologico', '$nombre_zoologico', '$presupuesto', '$tamanio', '$ciudad')";
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
                location.href ="listadoZoologico.php";
                </script>"
               <?php 
                }
                
               
                }            
        }
                mysqli_close($conexion);
        ?>