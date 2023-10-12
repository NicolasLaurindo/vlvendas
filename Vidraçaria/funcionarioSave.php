<?php include('protect.php'); ?>

<?php
    include_once('conexao.php');
    
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $endereco = $_POST['endereco'];
        $funcao = $_POST['funcao'];
        
        $sqlUpdate = "UPDATE funcionarios
        SET nome='$nome', cpf='$cpf', telefone='$telefone', cidade='$cidade', bairro='$bairro', endereco='$endereco', funcao='$funcao'
        WHERE id=$id";
        
        $result = $conexao->query($sqlUpdate);
        print_r($result);
    }
    
    header('Location: funcionarios.php');
    exit; // É recomendável adicionar um 'exit' após o redirecionamento para evitar que o código continue a ser executado
?>