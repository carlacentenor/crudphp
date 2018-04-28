<?php
// Variables de conection
$link  = 'mysql:host=localhost;dbname=colores';
$user = 'root';
$pass = '';

try{
    $pdo = new PDO($link, $user, $pass);
    // echo 'conectado';
    // foreach($pdo->query('SELECT * FROM `color`') as $fila){
    //     print_r($fila);
    // }

}catch(PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>