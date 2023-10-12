<?php include('protect.php'); ?>

<?php
    include_once('conexao.php');
    
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $codigo = $_POST['codigo'];
        $descricao = $_POST['descricao'];
        $unidade = $_POST['unidade'];
        $valor = $_POST['valor'];
        $quantidade = $_POST['quantidade'];
        
        $sqlUpdate = "UPDATE estoque 
        SET codigo='$codigo', descricao='$descricao', unidade='$unidade', valor='$valor', quantidade='$quantidade'
        WHERE id=$id";
        
        $result = $conexao->query($sqlUpdate);
        print_r($result);
    }
    
    header('Location: estoque.php');
    exit; // É recomendável adicionar um 'exit' após o redirecionamento para evitar que o código continue a ser executado
?>