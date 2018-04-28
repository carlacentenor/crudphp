<?php
// llamando al archivo connection
include_once 'connection.php'; 
// Lectura de datos
$sql_read = 'SELECT * FROM color';
$connect = $pdo->prepare($sql_read);  
$connect->execute();
$result = $connect->fetchAll(); // almacenando todo en un array

// agregar
if($_POST){
  $color = $_POST['nombre']; // obtener value del name 
  $descrip = $_POST['descripcion'];
  $sql_add = 'INSERT INTO color(nombre,descripcion) VALUES (?,?)';
  $sentence_add = $pdo->prepare($sql_add);
  $sentence_add->execute(array($color,$descrip));
  
  //cerramos conexión
  $sentence_add = null;
  $pdo = null;
   
  header('location:index.php'); // refrescar la página
}

// Update
if($_GET){
  $id = $_GET['id'];
  $sql_search = 'SELECT * FROM color WHERE id=?';
  $connect_search = $pdo->prepare($sql_search);  
  $connect_search->execute(array($id));
  $result_search = $connect_search->fetch();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="row">
    <div class="col-6">
    
    <?php
     foreach($result as $dato):

    ?>
    <div class="alert alert-<?php echo $dato['nombre'] ?>">
        <?php echo $dato['nombre'] ?>
        <?php echo $dato['descripcion'] ?>

        <a href="index.php?id=<?php echo $dato['id'] ?>" class=" btn float-right">Edit</a>
        <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class=" btn float-right">Delete</a>
    </div>

    <?php
        endforeach
    ?>
    </div>
    <div class="col-6">
    <?php if(!$_GET):  ?>
    <h2>Agregar Elementos</h2>
    <form method="POST">
    <input type="text" class="form-control" name="nombre">
    <input type="text" class="form-control mt-3" name="descripcion">
    <button class="btn btn-primary mt-3">Agregar</button>
    </form>
    <?php endif  ?>

    <?php if($_GET):  ?>
    <h2>Editar Elementos</h2>
    <form method="GET" action="edit.php">
    <input type="text" class="form-control" name="nombre" value="<?php echo $result_search['nombre'] ?>">
    <input type="text" class="form-control mt-3" name="descripcion" value="<?php echo $result_search['descripcion'] ?>">
    <input type="hidden" name="id" value="<?php echo $result_search['id'] ?>" >
    <button class="btn btn-info mt-3">Actualizar</button>
    </form>
    <?php endif  ?>

    </div>
    </div>
    </div>
</body>
</html>

<?php

//cerramos conexión

$pdo = null;
$connect= null;
?>