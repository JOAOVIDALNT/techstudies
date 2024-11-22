<?php

$host = "localhost";
$db = "testando";
$user = "root";
$pass = "";

$conn = mysqli_connect($host, $user, $pass, $db);

if($conn->connect_errno) {
   die("Falha na conexão com o banco de dados");
}
