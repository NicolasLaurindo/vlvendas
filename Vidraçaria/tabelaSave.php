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
        $desconto = $_POST['desconto'];
        
        $sqlUpdate = "UPDATE tabela 
        SET codigo='$codigo', descricao='$descricao', unidade='$unidade', valor='$valor', quantidade='$quantidade', desconto='$desconto'
        WHERE id=$id";
        
        $result = $conexao->query($sqlUpdate);
        print_r($result);
    }
    
    header('Location: tabela.php');
    exit; // É recomendável adicionar um 'exit' após o redirecionamento para evitar que o código continue a ser executado
?>