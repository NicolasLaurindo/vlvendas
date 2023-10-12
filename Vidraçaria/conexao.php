<?php

$usuario = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

$conexao = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Falha ao conectar ao banco de dados: " . $e->getMessage());
}
?>

