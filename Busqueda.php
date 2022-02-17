<?php

// Este php se encargara de realizar las busqueda por id el cual sera 
// activado por el formulario de busqueda en la pagina de index

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Zoo</title>   
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css"> 
</head>
<body>
   <header class="main-header">
       <div class="container container--flex">
           
       
       <div class="logo-container column column--50">
           <h1 class="logo">Zoologico</h1>
       </div>
       
       </div>
   </header>
   <!--  
        Menu desplegable
   -->
   <nav class="main-nav">
       <div class="container container--flex">
           <span class="icon-menu" id="btnmenu"><span class="fa fa-bars icon-men"></span></span>
           <ul class="menu" id="menu">
               <li class="menu__item"><a href="index.php" class="menu__link menu__link--select"><span class="fa fa-home icon-home"></span> Inicio</a></li>
               <li class="menu__item"><a href="listadoZoologico.php" class="menu__link"><span class="fa fa-tree icon-tree"></span> Lista Zoologicos</a></li>
               <li class="menu__item"><a href="listadoAnimales.php" class="menu__link"><span class="fa fa-paw icon-paw"></span> Lista Animales</a></li>
           </ul>
          
       </div>
   </nav>
    <!--
        Imagen para el fondo del banner
    -->
   <section class="banner">
       <img src="img/banner4.jpg" alt="" class="banner__img">

   </section>

   <main class="main">
       <section class="group group--color">
           <div class="container">
               <h2 class="main__title">Busqueda de Animal</h2>
               
           </div>
       </section>
       <section>
       
       <?php
           // $id corresponde al parametro recibido desde el index
           $id = $_POST['id_busqueda'];
           require("db.php"); // Se solicita los datos de conexion a base de datos
           $conexion = mysqli_connect($db_host, $db_user, $db_pass);
           if (mysqli_connect_errno()){
               exit();
           }
           mysqli_select_db($conexion, $db_nombre) or die("no se encuentra");
        mysqli_set_charset($conexion,'utf8');
        
        $consulta = "SELECT * FROM animal where ID_ANIMAL='".$id."'";
        $resultado =  mysqli_query($conexion, $consulta);
        
        if(!mysqli_num_rows($resultado)>0){
            ?>
           <h2 class="main__title" style="color:black; text-align:center;font-family:Times New Roman;">No se encontro Resultado</h2>
           <?php
        }
        while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
            ?>
           <section class="group main__about__description">
               <div class="container container--flex">
                <div class="column column--50">
                <img src="img/animal.jpg" alt="">
                </div>
           
           <div class="column column--50">
               <h3 class="column__title">___________________</h3><br>
               <h5 class="column__title">ID : </h5><label for="" class="formulario__label"><?php echo $fila['ID_ANIMAL']; ?></label><br>
               <h5 class="column__title">Nombre : </h5><label for="" class="formulario__label"><?php echo $fila['NOMBRE_ANIMAL']; ?></label><br> <!--
                Se rescataran los datos por medios de select individuales para cada dato, luego para imprimirlo se utilizara la variable
                de cada uno junto con echo y el nombre de la columna en la base de datos
                -->            
               <?php 
               //select que rescatara el tipo de sexo asociado al animal que se obtuvo de la busqueda
               $consulta2 = "SELECT TIPO_SEXO FROM sexo where ID_SEXO=".$fila['FK_SEXO'];
               $resultado2 =  mysqli_query($conexion, $consulta2);
               $s = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
               ?>   
               <h5 class="column__title">Sexo : </h5><label for="" class="formulario__label"><?php echo $s['TIPO_SEXO'] ?></label><br>
               <?php
               //select que rescatara el nombre tanto vulgar como cientifico asociado al animal que se obtuvo de la busqueda
               $consulta3 = "SELECT NOMBRE_VULGAR,NOMBRE_CIENTIFICO FROM especie where ID_ESPECIE=".$fila['FK_ESPECIE'];
               $resultado3 =  mysqli_query($conexion, $consulta3);
               $e = mysqli_fetch_array($resultado3, MYSQLI_ASSOC);             
               ?>
               <h5 class="column__title">Especie : </h5><label for="" class="formulario__label"><?php echo $e['NOMBRE_VULGAR']." / ". $e['NOMBRE_CIENTIFICO'];?></label><br>
               <?php
               //select que rescatara el nombre del zoologico asociado al animal que se obtuvo de la busqueda
                
               $consulta4 = "SELECT NOMBRE_ZOOLOGICO FROM zoologico where ID_ZOOLOGICO=".$fila['FK_ZOOLOGICO'];
               $resultado4 =  mysqli_query($conexion, $consulta4);
               $z = mysqli_fetch_array($resultado4, MYSQLI_ASSOC);             
               ?>
               <h5 class="column__title">Zoologico : </h5><label for="" class="formulario__label"><?php echo $z['NOMBRE_ZOOLOGICO'] ?></label><br>
               <?php
               //select que rescatara el nombre del pais asociado al animal que se obtuvo de la busqueda
               $consulta5 = "SELECT NOMBRE_PAIS FROM pais where ID_PAIS=".$fila['FK_ORIGEN'];
               $resultado5 =  mysqli_query($conexion, $consulta5);
               $p = mysqli_fetch_array($resultado5, MYSQLI_ASSOC);             
               ?>
               <h5 class="column__title">Pais : </h5><label for="" class="formulario__label"><?php echo $p['NOMBRE_PAIS'] ?></label><br>
           </div>
           <?php
           
            }
           mysqli_close($conexion);
        
            ?>
       
       
       </section>
       
       
       
   </main>
   
   <footer class="main-footer">
           <div class="container container--flex">
               
           </div>
       </footer>
    <script src="js/menu.js"></script>   
       
</body>

</html>