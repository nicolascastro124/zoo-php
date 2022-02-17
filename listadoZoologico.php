<?php

/* Este php se encargara de mostrar el listado de zoologicos en su detalle
   uno por uno */

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
   <section class="banner">
       <img src="img/banner2.jpg" alt="" class="banner__img">

   </section>
   <main class="main">
       <section class="group group--color">
           <div class="container">
               <h2 class="main__title">Listado de Zoologicos Registrados</h2>
              
           </div>
       </section>
       <section>
       
       <?php
        
           require("db.php");
           $conexion = mysqli_connect($db_host, $db_user, $db_pass);
           if (mysqli_connect_errno()){
               exit();
           }
           mysqli_select_db($conexion, $db_nombre) or die("no se encuentra");
        mysqli_set_charset($conexion,'utf8');
        
        $consulta = "SELECT * FROM zoologico";
        $resultado =  mysqli_query($conexion, $consulta);
        
        
        while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
            ?>
           <section class="group main__about__description">
               <div class="container container--flex">
                <div class="column column--50">
                <img src="img/zoo.jpg" alt="">
                </div>
            <!--
                Se rescataran los datos por medios del select anterior para cada dato, en el caso de foraneas
                se usara un select a dicha tabla,luego para imprimirlo se utilizara la variable
                de cada uno junto con echo y el nombre de la columna en la base de datos
                -->    
           <div class="column column--50">
               <h3 class="column__title">___________________</h3><br>
               <h5 class="column__title">ID : </h5><label for="" class="formulario__label"><?php echo $fila['ID_ZOOLOGICO']; ?></label><br>
               <h5 class="column__title">Nombre : </h5><label for="" class="formulario__label"><?php echo $fila['NOMBRE_ZOOLOGICO']; ?></label><br>
               <h5 class="column__title">Presupuesto : </h5><label for="" class="formulario__label"><?php echo "$ ".$fila['PRESUPUESTO']; ?></label><br>
               <h5 class="column__title">Tamaño : </h5><label for="" class="formulario__label"><?php echo $fila['TAMANIO']; ?></label>
               <br>              
               <?php
               //select que rescatara el nombre de la ciudad asociado al zoologico que se obtuvo de la busqueda
               $consulta2 = "SELECT NOMBRE_CIUDAD FROM ciudad where ID_CIUDAD=".$fila['FK_CIUDAD'];
               $resultado2 =  mysqli_query($conexion, $consulta2);
               $c = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
               ?>   
               <h5 class="column__title">Ciudad : </h5><label for="" class="formulario__label"><?php echo $c['NOMBRE_CIUDAD'] ?></label><br>
               
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