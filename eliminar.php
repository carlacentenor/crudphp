<?php

include_once 'connection.php';
$id = $_GET['id'];
$sql_delete = 'DELETE FROM color WHERE id=?';
$sentence_delete= $pdo->prepare($sql_delete);
$sentence_delete->execute(array($id));
//cerramos conexión

$pdo = null;
$sentence_delete= null;
header('location:index.php');
?>