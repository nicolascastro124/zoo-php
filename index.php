<?php
/*
 Pagina de inicio correspondiente a la aplicacion
 contara con un buscador para animal por id, tambien con dos formularios
 que se encargaran de hacer insert a las tablas de animal,zoologico
*/
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
       <img src="img/banner.jpg" alt="" class="banner__img">

   </section>
   <main class="main">
       <section class="group group--color">
           <div class="container">
               <h2 class="main__title" style="float: left;">Buscar Animal por ID</h2>
               <form class="formulario column column--50" method="post" action="Busqueda.php">
               <input type="number" name="id_busqueda" class="formulario__input-txt" min="0">
               <input type="submit" id="btn" class="btn formulario__btn" value="Buscar" style="background: #e4dddc; color:black;">
               
               </form>
              
           </div>
       </section>
       <section class="group main__about__description">
           <div class="container container--flex">
               <div class="column column--50">
               <img src="img/img2.jpg" alt="">
               </div>
               <div class="column column--50">
                   <h3 class="column__title">Registrar Zoologico</h3>
                  
                   <form action ="insertZoo.php" method="get" class="formulario column column--50">
                 <label for="" class="formulario__label">ID </label><input  type="number" name="id_zoo" class="formulario__input-txt" min="0" >
                 
                 <label for="" class="formulario__label">Nombre</label><input  type="text" name="nombre_zoo" class="formulario__input-txt" min="0" >
                 <label for="" class="formulario__label">Tamaño</label><input  type="number" name="tamanio" class="formulario__input-txt" min="0" >
                 <label for="" class="formulario__label">Presupuesto</label><input  type="number" name="presupuesto" class="formulario__input-txt" min="0">
                 <label for="" class="formulario__label">Ciudad</label>
                       <?php

                        require("db.php"); // Se solicita los datos de conexion a base de datos
                        $conexion = mysqli_connect($db_host, $db_user, $db_pass);
                        mysqli_select_db($conexion, $db_nombre);
                        $query = "select * from ciudad";
                        $res = mysqli_query($conexion, $query);
                       ?>                         
                       <select name="ciudad" class="formulario__select">
                       <option value="" selected>Eliga Ciudad</option>
                           <?php while($row=mysqli_fetch_array($res))
                            { ?>
                           <option value="<?php echo $row['ID_CIUDAD']?>"> <?php echo $row['NOMBRE_CIUDAD'];?></option>
                           <?php } ?>
                       
                       </select>
                 

                 <input id="boton" type="submit" class="btn formulario__btn" value="Registrar" >
                  
                    
              </form><br><br>
                 
               </div>
           </div>
       </section>
       <section class="group main__about__description">
           <div class="container container--flex">
               <div class="column column--50">
               <img src="img/img3.jpg" alt="">
               </div>
               <div class="column column--50">
                   <h3 class="column__title">Registrar Animal</h3>
                  
                   <form action="insertAnimal.php" method="get" class="formulario column column--50">
                 <label for="" class="formulario__label">ID </label><input  type="number" name="id_animal" class="formulario__input-txt" min="0" >
                 
                 <label for="" class="formulario__label">Nombre</label><input  type="text" name="nombre_animal" class="formulario__input-txt" min="0" >
                 
                 <label for="" class="formulario__label">Sexo</label>
                      
                        <?php
                        //Se rescataran los datos de sexos existentes para llenar el combo box
                        require("db.php"); // Se solicita los datos de conexion a base de datos
                        $conexion = mysqli_connect($db_host, $db_user, $db_pass);
                        mysqli_select_db($conexion, $db_nombre);
                        $query = "select * from sexo";
                        $res = mysqli_query($conexion, $query);
                       ?>                         
                       <select name="sexo" class="formulario__select">
                       <option value="" selected>Eliga sexo</option>
                           <?php while($row=mysqli_fetch_array($res))
                            { ?>
                           <option value="<?php echo $row['ID_SEXO']?>"> <?php echo $row['TIPO_SEXO'];?></option>
                           <?php } ?>
    
                       </select>
                 <label for="" class="formulario__label">Especie</label>
                         <?php
                        //Se rescataran los datos de especies existentes para llenar el combo box
                        require("db.php"); // Se solicita los datos de conexion a base de datos
                        $conexion = mysqli_connect($db_host, $db_user, $db_pass);
                        mysqli_select_db($conexion, $db_nombre);
                        $query = "select * from especie";
                        $res = mysqli_query($conexion, $query);
                       ?>                         
                       <select name="especie" class="formulario__select">
                       <option value="" selected>Eliga especie</option>
                           <?php while($row=mysqli_fetch_array($res))
                            { ?>
                           <option value="<?php echo $row['ID_ESPECIE']?>"> <?php echo $row['NOMBRE_VULGAR'];?> / <?php echo $row['NOMBRE_CIENTIFICO'];?> </option>
                           <?php } ?>
                           </select>
    
                       
                       
                       
                 <label for="" class="formulario__label">Zoologico</label>
                       
                       <?php
                        //Se rescataran los datos de zoologicos existentes para llenar el combo box
                        require("db.php"); // Se solicita los datos de conexion a base de datoss
                        $conexion = mysqli_connect($db_host, $db_user, $db_pass);
                        mysqli_select_db($conexion, $db_nombre);
                        $query = "select * from zoologico";
                        $res = mysqli_query($conexion, $query);
                       ?>                         
                       <select name="zoo" class="formulario__select">
                       <option value="" selected>Eliga Zoologico </option>
                           <?php while($row=mysqli_fetch_array($res))
                            { ?>
                           <option value="<?php echo $row['ID_ZOOLOGICO']?>"> <?php echo $row['NOMBRE_ZOOLOGICO'];?></option>
                           <?php } ?>
                           </select>
                       
                       
                 <label for="" class="formulario__label">Origen</label>
                       
                        <?php
                        //Se rescataran los datos de Origenes (pais) existentes para llenar el combo box
                        require("db.php"); // Se solicita los datos de conexion a base de datos
                        $conexion = mysqli_connect($db_host, $db_user, $db_pass);
                        mysqli_select_db($conexion, $db_nombre);
                        $query = "select * from pais";
                        $res = mysqli_query($conexion, $query);
                       ?>                         
                       <select name="origen" class="formulario__select">
                       <option value="" selected>Eliga pais</option>
                           <?php while($row=mysqli_fetch_array($res))
                            { ?>
                           <option value="<?php echo $row['ID_PAIS']?>"> <?php echo $row['NOMBRE_PAIS'];?></option>
                           <?php } ?>
                           </select>
                       
                 

                 <input id="boton" type="submit" class="btn formulario__btn" value="Registrar">
                  
                    
              </form><br><br>
                 
               </div>
           </div>
       </section>
       
       
       
   </main>
   
   <footer class="main-footer">
           <div class="container container--flex">
               
           </div>
       </footer>
    <script src="js/menu.js"></script>   
       
</body>

</html>