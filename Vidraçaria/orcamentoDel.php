<?php include('protect.php'); ?>

<?php

    if(!empty($_GET['id']))
    {
        include_once('conexao.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM orcamentos WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM orcamentos WHERE id=$id";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: orcamentos.php');
    exit;
   
?>