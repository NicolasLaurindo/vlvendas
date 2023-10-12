<?php

require 'assets/dompdf/vendor/autoload.php'; // Carregue a biblioteca dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// Configuração do dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isFontSubsettingEnabled', true);

$dompdf = new Dompdf($options);

// Seu código para gerar o conteúdo do PDF a partir do banco de dados
$orcamentoId = $_GET['id'];

// Consulte o banco de dados para recuperar os detalhes do orçamento com base no $orcamentoId
// Substitua as seguintes variáveis com os dados reais do seu banco de dados
$cnpj = "15.508.367/0001-98";
$endereco = "RUA ALBERT SABIN N°65 - TERRA DOS IPÊS | PINDAMONHANGABA-SP";
$telefone = "(12)3641-2659/(12)98171-1143";
$cliente = "(12) 3456-7890";
$data = date('d/m/Y');
$quantidade = 5;
$valorUnidade = 10.00;
$valorTotal = $quantidade * $valorUnidade;
$imagemPath = 'assets/imgs/logoEscrita.png';

// HTML para o conteúdo do PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Orçamento</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css">
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            position: relative;
        }
        .inicio {
            max-width: 45%;
            text-align: right;
        }
        .imagem {
            max-width: 45%;
            text-align: left;
        }
        .imagem img {
            max-width: 100%;
        }
        .top-left {
            position: absolute;
            top: 0;
            left: 0;
        }
        .top-right {
            position: absolute;
            top: 0;
            right: 0;
        }
        .separador-a {
            clear: both;
            border-top: 2px solid #000;
            margin-top: 150px;
        }
        .separador-b {
            clear: both;
            border-top: 2px solid #000;
            margin-top: 100px;
        }
        .titulo {
            font-weight: bold; /* Torna o texto em negrito */
            text-transform: uppercase; /* Converte o texto para letras maiúsculas */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-left imagem">
            <img src="' . $imagemPath . '" />
        </div>
        <div class="top-right inicio">
            <p><span class="titulo">CNPJ: </span>' . $cnpj . '</p>
            <p><span class="titulo">ENDEREÇO: </span>' . $endereco . '</p>
            <p><i class="bx bxl-whatsapp"></i> ' . $telefone . '</p>
        </div>
    </div>

<div class="separador-a"></div>

            <p><span class="titulo">CLIENTE: </span>' . $cliente . '</p>
            <p><span class="titulo">DATA: </span>' . $data . '</p>

<div class="separador-b"></div>

    <p>Quantidade: ' . $quantidade . '</p>
    <p>Valor Unitário: R$ ' . number_format($valorUnidade, 2) . '</p>
    <p>Valor Total: R$ ' . number_format($valorTotal, 2) . '</p>
</body>
</html>
';

$dompdf->loadHtml($html);

// Renderiza o PDF
$dompdf->render();

// Saída do PDF (pode ser exibido no navegador ou salvo em um arquivo)
$dompdf->stream("orcamento.pdf", array("Attachment" => false));
?>