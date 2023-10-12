<!-- calculo.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Cálculo</title>
</head>
<body>
    <h1>Resultado do Cálculo</h1>
    
    <?php
    // Receber os dados do formulário
    $imagemId = $_POST['imagem'];
    $quantidade = $_POST['quantidade'];
    $valorUnidade = $_POST['valor_unidade'];
    
    // Aqui você deve buscar os dados da imagem no banco de dados com base no $imagemId
    
    // Calcular o valor total
    $valorTotal = $quantidade * $valorUnidade;
    
    // Exibir os resultados
    echo '<p>Imagem: ' . $imagem['descricao'] . '</p>';
    echo '<p>Quantidade: ' . $quantidade . '</p>';
    echo '<p>Valor por Unidade: R$ ' . $valorUnidade . '</p>';
    echo '<p>Valor Total: R$ ' . $valorTotal . '</p>';
    ?>
</body>
</html>