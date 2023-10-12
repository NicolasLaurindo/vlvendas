<?php include('protect.php'); ?>

<?php
    include_once('conexao.php');
    
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $fornecedor = $_POST['fornecedor'];
        $empresa = $_POST['empresa'];
        $cnpj = $_POST['cnpj'];
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $contato = $_POST['contato'];
        
        $sqlUpdate = "UPDATE fornecedores 
        SET fornecedor='$fornecedor', empresa='$empresa', cnpj='$cnpj', cidade='$cidade', bairro='$bairro', endereco='$endereco', telefone='$telefone', contato='$contato'
        WHERE id=$id";
        
        $result = $conexao->query($sqlUpdate);
        print_r($result);
    }
    
    header('Location: fornecedores.php');
    exit; // É recomendável adicionar um 'exit' após o redirecionamento para evitar que o código continue a ser executado
?>