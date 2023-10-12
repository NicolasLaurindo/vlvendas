<?php include('protect.php'); ?>

<?php
$usuario = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM gastos WHERE id = $id";

    if ($mysqli->query($sql) === true) {
        header("Location: financeiro.php"); // Redireciona para a página principal
        exit();
    } else {
        echo "Erro ao apagar gasto: " . $mysqli->error;
    }
} else {
    echo "ID do gastos não fornecido.";
    exit();
}

$mysqli->close();
?>