<?php


$id = $_GET['id'];
$nombre = $_GET['nombre'];
$descripcion = $_GET['descripcion'];



include_once 'connection.php';

$sql_update = 'UPDATE color SET nombre=?,descripcion=? WHERE id=?';
$sentence_update = $pdo->prepare($sql_update);
$sentence_update->execute(array($nombre,$descripcion,$id));

//cerramos conexión

$pdo = null;
$sentence_update= null;
header('location:index.php'); // refrescar la página
?>