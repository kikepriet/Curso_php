<?php

$dbHost = 'localhost';
$dbName = 'cursophp';
$dbUser = 'root';
$dbpass = '';

//metemos el código en try catch para que nos lance una advertencia en vez de error
try{
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", "$dbUser", "$dbpass");
    //configuramos que los errores se muestren como mensaje
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e){
    echo $e->getMessage();
}
    
?>