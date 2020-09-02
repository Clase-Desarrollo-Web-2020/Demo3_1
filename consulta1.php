
<?php
    session_start();
  
    if (!isset($_SESSION['user_id'])) {
        header('Location: /Demo3_1/login');
    }
?>
  <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <head>
        <meta charset="UTF-8">
        <title>Consulta por Departamento</title>
    </head>
    <body>
        Seleccione un departamento:
        <?php
        $con =  mysqli_connect(
                "localhost:3306","root","");
        
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                   . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');

        // estableciendo la BDD
        mysqli_select_db($con, "colegiodb");
                
        // enviando el comando SQL
        $deptos = mysqli_query($con, "SELECT codigo, nombre FROM departamento order by nombre");
        if (mysqli_num_rows($deptos) < 1) {
            exit("No hay departamentos registrados!");
        }
        ?>
        
        <form action="">
            <select name='listadeptos'>
            <option>seleccione una opcion</option>
            <?php
                //llenando el combo con los registros devueltos por el comando SQL
                while ($row = mysqli_fetch_array($deptos)) {
            ?>
                <option value="<?php echo $row['codigo']; ?>">
                        <?php echo $row['nombre']; ?>
                </option>
            <?php 
            } 		
                // cerrando la conexion a la BDD
                mysqli_free_result($deptos);
                mysqli_close($con);					
            ?>                            
            </select>   
            <br>
            <a href="/Demo3_1/logout.php">Salir</a>
            
	</form>
    </body>
    </body>
</html>