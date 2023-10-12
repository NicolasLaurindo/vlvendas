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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["tipo"])) { // Formulário de Registros
        $tipo = $_POST["tipo"];
        $descricao = $_POST["descricao"];
        $valor = $_POST["valor"];

        $sql = "INSERT INTO registros (data, tipo, descricao, valor) VALUES (CURDATE(), '$tipo', '$descricao', $valor)";

        if ($mysqli->query($sql) === true) {
            echo "Registro inserido com sucesso!";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Erro ao inserir registro: " . $mysqli->error;
        }
    } elseif (isset($_POST["categoria"])) { // Formulário de Gastos
        $categoriaGasto = $_POST["categoria"];
        $descricaoGasto = $_POST["descricao-gasto"];
        $valorGasto = $_POST["valor-gasto"];

        $sqlGasto = "INSERT INTO gastos (data, categoria, descricao, valor) VALUES (CURDATE(), '$categoriaGasto', '$descricaoGasto', $valorGasto)";
        echo "SQL: $sqlGasto";
        if ($mysqli->query($sqlGasto) === true) {
            echo "Gasto inserido com sucesso!";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Erro ao inserir gasto: " . $mysqli->error;
        }
    }
}

$gastos = [];

$resultGastos = $mysqli->query("SELECT * FROM gastos");
while ($rowGasto = $resultGastos->fetch_assoc()) {
    $gastos[] = $rowGasto;
}

$totalGastos = array_reduce($gastos, function ($carry, $gasto) {
    return $carry + $gasto['valor'];
}, 0);

$registros = [];

$resultRegistros = $mysqli->query("SELECT * FROM registros");
while ($rowRegistro = $resultRegistros->fetch_assoc()) {
    $registros[] = $rowRegistro;
}

$totalRegistros = array_reduce($registros, function ($carry, $registro) {
    return $carry + $registro['valor'];
}, 0);

$saldo = $totalRegistros - $totalGastos;

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<title>Vidraçaria Lucas ◈ Financeiro</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Quicksand:wght@600&display=swap');

* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

a {
	text-decoration: none;
}

li {
	list-style: none;
}

:root {
	--quicksand: 'Quicksand', sans-serif;
	--bebas: 'Bebas Neue', sans-serif;

	--preto: #000000;
    --cinzaescuro: #333333;
    --dark-grey: #AAAAAA;
    --branco: #fff;
    --red: #DB504A;

    /* ICONS */
    --azulescuro: #1a237e;
    --azulescuroclaro: #4d549b;
    --verdeesmeralda: #2ecc71;
    --verdeesmeraldaclaro: #87ca9e;
    --laranja: #f39c12;
    --laranjaclaro: #f7c877;
    --rosa: #e91e63; 
    --rosaclaro: #f17a9b;
    --roxo: #9b59b6; 
    --roxoclaro: #c49ec6;
    --vermelho: #e74c3c; 
    --vermelhoclaro: #ef9a8c;
    --amarelo: #f1c40f;
    --amareloclaro: #f8dc8e;
    --azulclaro: #3498db;
    --azulclaroclaro: #7fc4e8;
    --verdelimao: #c1e460; 
    --verdelimaoclaro: #e3eeb0;
    --azulceleste: #00bcd4;
    --azulcelesteclaro: #8ed4dd;
    --marrom: #795548; 
    --marromclaro: #ae9f94;
    --cinza: #95a5a6; 
    --cinzaclaro: #c4cdcf;
}

html {
	overflow-x: hidden;
}

body {
	background: var(--cinzaescuro);
	overflow-x: hidden;
    text-transform: uppercase;
}





/* SIDEBAR */
#sidebar {
	position: fixed;
	top: 0;
	left: 0;
	width: 280px;
	height: 100%;
	background: var(--preto);
	z-index: 2000;
	font-family: var(--bebas);
	transition: .3s ease;
	overflow-x: hidden;
	scrollbar-width: none;
}
#sidebar::--webkit-scrollbar {
	display: none;
}
#sidebar.hide {
	width: 60px;
}
#sidebar .brand {
	font-size: 24px;
	font-weight: 700;
	height: 56px;
	display: flex;
	align-items: center;
	color: var(--azulclaro);
	position: sticky;
	top: 0;
	left: 0;
	background: var(--preto);
	z-index: 500;
	padding-bottom: 20px;
	box-sizing: content-box;
}
#sidebar .brand .bx {
	min-width: 60px;
	display: flex;
	justify-content: center;
}
.logo-img {
  width: 60px;
  height: auto;
}
#sidebar .side-menu {
	width: 100%;
	margin-top: 48px;
}
#sidebar .side-menu li {
	height: 48px;
	background: transparent;
	margin-left: 6px;
	border-radius: 48px 0 0 48px;
	padding: 4px;
}
#sidebar .side-menu li.active {
	background: var(--cinzaescuro);
	position: relative;
}
#sidebar .side-menu li.active::before {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	top: -40px;
	right: 0;
	box-shadow: 20px 20px 0 var(--cinzaescuro);
	z-index: -1;
}
#sidebar .side-menu li.active::after {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	bottom: -40px;
	right: 0;
	box-shadow: 20px -20px 0 var(--cinzaescuro);
	z-index: -1;
}
#sidebar .side-menu li a {
	width: 100%;
	height: 100%;
	background: var(--preto);
	display: flex;
	align-items: center;
	border-radius: 48px;
	font-size: 18px;
	color: var(--branco);
	white-space: nowrap;
	overflow-x: hidden;
	padding: 0 9px;
}
#sidebar .side-menu.top li.active a {
	color: var(--azulclaro);
}
#sidebar.hide .side-menu li a {
	width: calc(48px - (4px * 2));
	transition: width .3s ease;
}
#sidebar .side-menu li a.logout {
	color: var(--red);
}
#sidebar .side-menu.top li a:hover {
	color: var(--azulclaro);
}
#sidebar .side-menu li a .bx {
	min-width: calc(60px  - ((4px + 6px) * 2));
	display: flex;
	justify-content: center;
}
#sidebar .side-menu li a .text {
  	margin-left: 16px;
}
/* SIDEBAR */





/* CONTENT */
#content {
	position: relative;
	width: calc(100% - 280px);
	left: 280px;
	transition: .3s ease;
}
#sidebar.hide ~ #content {
	width: calc(100% - 60px);
	left: 60px;
}




/* NAVBAR */
#content nav {
	height: 56px;
	background: var(--preto);
	padding: 0 24px;
	display: flex;
	align-items: center;
	grid-gap: 24px;
	font-family: var(--bebas);
	position: sticky;
	top: 0;
	left: 0;
	z-index: 1000;
}
#content nav::before {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	bottom: -40px;
	left: 0;
	border-radius: 50%;
	box-shadow: -20px -20px 0 var(--preto);
}
#content nav a {
	color: var(--branco);
}
#content nav .bx.bx-menu {
	cursor: pointer;
	color: var(--branco);
}
#content nav .nav-link {
	font-size: 16px;
	transition: .3s ease;
}
#content nav .nav-link:hover {
	color: var(--azulclaro);
}
#content nav form {
	max-width: 400px;
	width: 100%;
	margin-right: auto;
}
/* NAVBAR */





/* MAIN */
#content main {
	width: 100%;
	padding: 36px 24px;
	font-family: var(--quicksand);
	max-height: calc(100vh - 56px);
	overflow-y: auto;
}
#content main .head-title {
	display: flex;
	align-items: center;
	justify-content: space-between;
	grid-gap: 16px;
	flex-wrap: wrap;
}
#content main .head-title .left h1 {
	font-size: 36px;
	font-weight: 600;
	margin-bottom: 10px;
	color: var(--branco);
}
#content main .head-title .left .breadcrumb {
	display: flex;
	align-items: center;
	grid-gap: 16px;
}
#content main .head-title .left .breadcrumb li {
	color: var(--branco);
}
#content main .head-title .left .breadcrumb li a {
	color: var(--dark-grey);
	pointer-events: none;
}
#content main .head-title .left .breadcrumb li a.active {
	color: var(--azulclaro);
	pointer-events: unset;
}

.card-container {
    display: flex;
    gap: 1rem; /* Espaçamento entre os cards */
    color: white;
}

.card {
    flex: 1;
    min-width: 300px;
    max-width: calc(33.33% - 20px); /* 3 cards in a row with spacing */
    border: 1px solid var(--preto);
    background-color: var(--preto);
    padding: 20px;
    margin: 10px;
    border-radius: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
}

.title {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}

.title-text {
    flex: 1;
}

.icon {
    position: relative;
    padding: 0.5rem;
    width: 2.5rem; /* Aumenta o tamanho do fundo */
    height: 2.5rem; /* Aumenta o tamanho do fundo */
    border-radius: 50%; /* Torna o fundo circular */
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon i {
    font-size: 1.5rem; /* Define o tamanho do ícone */
}

.fa-cash-register,
.fa-hand-holding-dollar,
.fa-piggy-bank {
    display: inline-block;
    padding: 0.5rem; /* Ajuste o espaçamento conforme necessário */
    border-radius: 50%; /* Torna o background circular */
    font-size: 1.5rem; /* Ajuste o tamanho do ícone conforme necessário */
    color: #fff; /* Cor do ícone */
}

.fa-cash-register {
    background-color: var(--verdeesmeralda); /* Cor para Registros */
}

.fa-hand-holding-dollar {
    background-color: var(--vermelho); /* Cor para Gastos */
}

.fa-piggy-bank {
    background-color: var(--amarelo); /* Cor para Saldo */
}

.sort-icon {
    position: absolute;
    top: 10px;
    right: 10px;
}

.fa-sort-up {
    color: var(--verdeesmeralda);
    font-size: 30px;
}

.fa-sort-down {
    color: var(--vermelho);
    font-size: 30px;
}

.fa-sort {
    color: var(--amarelo);
    font-size: 30px;
}

.title-text {
    margin-left: 0.5rem;
    color: var(--dark-grey);
    font-size: 18px;
}

.data {
    margin-top: 1rem;
    margin-bottom: 1rem;
    color: white;
    font-size: 2.25rem;
    line-height: 2.5rem;
    font-weight: 700;
    text-align: left;
}

#registros table,
#gastos table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 24px;
    background-color: var(--preto);
    border-radius: 20px;
    overflow: hidden;
    color: var(--branco);
    margin-bottom: 24px;
    border: 20px solid var(--preto); /* Adiciona uma borda à tabela */
}

#registros th,
#gastos th {
    padding: 16px;
    font-size: 16px;
    border-bottom: 1px solid var(--cinzaescuro);
    text-align: left;
}

#registros td,
#gastos td {
    padding: 16px;
    font-size: 14px;
    text-align: left;
}

#registros th {
    font-weight: 600;
    color: var(--azulclaro);
    background-color: var(--preto);
    position: relative; /* Adiciona posição relativa ao título */
}

#registros th::after {
    content: '';
    display: block;
    width: 100%;
    height: 2px;
    background-color: var(--cinzaescuro);
    position: absolute;
    bottom: 0;
    left: 0;
    transform: scaleX(0); /* Inicialmente esconde a linha */
    transition: transform 0.3s ease; /* Adiciona transição suave */
}

#registros th.tipo-col,
#gastos th.categoria-col {
    width: 20%;
    color: var(--azulclaro);
}

#registros th.descricao-col,
#gastos th.descricao-col {
    width: 50%;
    padding-left: 16px;
    color: var(--azulclaro);
}

#registros th.valor-col,
#gastos th.valor-col {
    width: 30%;
    text-align: right;
    padding-right: 280px;
    color: var(--azulclaro);
}

#registros tbody tr:hover,
#gastos tbody tr:hover {
    background: var(--cinzaescuro);
}

#registros tbody tr:hover td:last-child,
#gastos tbody tr:hover td:last-child {
    border-radius: 0 10px 10px 0;
}
.actions-col .buttons-container {
    display: flex;
    gap: 5px; /* Add spacing between buttons */
}

.actions-col a {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px 10px;
    color: white;
    border-radius: 50%;
    text-decoration: none;
    background-color: transparent;
    border: 1px solid transparent;
    transition: background-color 0.3s, border-color 0.3s;
}

.actions-col a.btn-editar {
    background-color: #3498db;
    border-color: #3498db;
}

.actions-col a.btn-excluir {
    background-color: #e74c3c;
    border-color: #e74c3c;
}

h2 {
    font-size: 24px;
    color: var(--azulclaro); /* Adjust the color as needed */
    margin-top: 20px;
    margin-bottom: 10px;
}

label {
    display: block;
    margin-top: 10px;
    font-size: 16px;
    color: var(--branco);
}

select, input[type="text"], input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid var(--cinzaescuro);
    border-radius: 10px;
    background-color: var(--preto);
    color: var(--branco);
    font-size: 14px;
}

button[type="submit"] {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: var(--azulclaro);
    color: var(--branco);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: var(--azulclaroclaro); /* Lighten the color on hover */
}
</style>
</head>

<body>
<section id="sidebar">
		<a href="#" class="brand">
            <img src="assets/imgs/logo.png" class="logo-img">
			<span class="text">Vidraçaria Lucas</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="home.php">
					<i class="fa-solid fa-house"></i>
					<span class="text">Home</span>
				</a>
			</li>
			<li>
				<a href="clientes.php">
					<i class="fa-solid fa-users"></i>
					<span class="text">Clientes</span>
				</a>
			</li>
			<li>
				<a href="produtos.php">
					<i class="fa-solid fa-boxes-stacked"></i>
					<span class="text">Produtos</span>
				</a>
			</li>
			<li>
				<a href="funcionarios.php">
					<i class="fa-solid fa-users-gear"></i>
					<span class="text">Funcionários</span>
				</a>
			</li>
			<li>
				<a href="fornecedores.php">
					<i class="fa-solid fa-truck-fast"></i>
					<span class="text">Fornecedores</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="logout.php" class="logout">
                    <span class="icon"><i class="fa-solid fa-person-through-window"></i></span>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Teste</a>
			<form action="#">
			</form>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Financeiro</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Controle</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="home.php">Voltar</a>
						</li>
					</ul>
				</div>
			</div>
    
    <form id="finance-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="container">
        <!-- Seus formulários e tabelas -->
        <br><br>
        <div class="card-container">
    <div class="card total">
        <div class="title">
            <span class="icon"><i class="fa-solid fa-cash-register"></i></span>
            <h2 class="title-text">Total Registros</h2>
            <i class="fas fa-sort-up sort-icon"></i>
        </div>
        <p class="data">R$<?= number_format($totalRegistros, 2) ?></p>
    </div>

    <div class="card total-gastos">
        <div class="title">
            <span class="icon"><i class="fa-solid fa-hand-holding-dollar"></i></span>
            <h2 class="title-text">Total Gastos</h2>
            <i class="fa-solid fa-sort-down"></i>
        </div>
        <p class="data">R$<?= number_format($totalGastos, 2) ?></p>
    </div>

    <div class="card saldo">
        <div class="title">
            <span class="icon"><i class="fa-solid fa-piggy-bank"></i></span>
            <h2 class="title-text">Saldo</h2>
            <i class="fa-solid fa-sort"></i>
        </div>
        <p class="data">R$<?= number_format($saldo, 2) ?></p>
    </div>
</div>
        <br>
    </div>
    <h2>Registros</h2>
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo">
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartão">Cartão</option>
            <option value="Cheque">Cheque</option>
        </select>
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required>
        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" step="0.01" required>
        <button type="submit" id="adicionar">Adicionar Registro</button>
    </form>
    <!-- Antes do loop foreach para mostrar os registros -->

<!-- ... -->

<div id="registros" class="registros">
    <table>
        <thead>
            <tr>
                <th class="tipo-col">Tipo</th>
                <th class="descricao-col">Descrição</th>
                <th class="valor-col">Valor</th>
                <th class="actions-col"></th>
            </tr>
        </thead>
        <tbody id="registros-body">
            <?php foreach ($registros as $registro) : ?>
                <tr class="new-record">
                    <td class="tipo-col"><?= $registro['tipo'] ?></td>
                    <td class="descricao-col"><?= $registro['descricao'] ?></td>
                    <td class="valor-col">R$<?= number_format($registro['valor'], 2) ?></td>
                    <td class="actions-col">
                        <div class="buttons-container">
                            <a href="financeiroEdit.php?id=<?= $registro['id'] ?>" class="btn-editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="financeiroDel.php?id=<?= $registro['id'] ?>" class="btn-excluir"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


    <!-- Tabela de Gastos -->
    <div id="gastos" class="gastos">
    <h2>Gastos</h2>
    <form id="gastos-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="categoria">Categoria:</label>
    <select id="categoria" name="categoria">
        <option value="Compras">Compras</option>
        <option value="Combustível">Combustível</option>
        <option value="Alimentação">Alimentação</option>
        <!-- Adicione mais categorias conforme necessário -->
    </select>
    <label for="descricao-gasto">Descrição:</label>
    <input type="text" id="descricao-gasto" name="descricao-gasto" required>
    <label for="valor-gasto">Valor:</label>
    <input type="number" id="valor-gasto" name="valor-gasto" step="0.01" required>
    <button type="submit" id="adicionar-gasto">Adicionar Gasto</button>
</form>
        <table>
            <thead>
                <tr>
                    <th class="categoria-col">Categoria</th>
                    <th class="descricao-col">Descrição</th>
                    <th class="valor-col">Valor</th>
                </tr>
            </thead>
                <tbody id="gastos-body">
                    <?php foreach ($gastos as $gasto) : ?>
                        <tr class="new-record">
                            <td class="categoria-col"><?= $gasto['categoria'] ?></td>
                            <td class="descricao-col"><?= $gasto['descricao'] ?></td>
                            <td class="valor-col">R$<?= number_format($gasto['valor'], 2) ?></td>
                            <td class="actions-col">
                                <div class="buttons-container">
                                    <a href="gastosEdit.php?id=<?= $gasto['id'] ?>" class="btn-editar"><i class="fa-solid fa-pen"></i></a>
                                    <a href="gastosDel.php?id=<?= $gasto['id'] ?>" class="btn-excluir"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
    </div>
</div>

<script>
        const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})




// SEARCH
const listItems = document.querySelectorAll('.navigation ul li');

listItems.forEach(item => {
    item.addEventListener('click', () => {
        listItems.forEach(li => {
            li.classList.remove('active');
        });
        item.classList.add('active');
    });
});

var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'produtos.php?search='+search.value;
    }
    </script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("finance-form");
    const registrosBody = document.getElementById("registros-body");
    const gastosForm = document.getElementById("gastos-form");
    const gastosBody = document.getElementById("gastos-body");
    const totalAmount = document.getElementById("total-amount");
    const totalGastosAmount = document.getElementById("total-gastos-amount");
    const adicionarButton = document.getElementById("adicionar");
    const adicionarGastoButton = document.getElementById("adicionar-gasto");

    let total = <?= $totalRegistros ?>;
    let totalGastos = <?= $totalGastos ?>;

    adicionarButton.addEventListener("click", () => {
        const tipo = form.tipo.value;
        const descricao = form.descricao.value;
        const valor = parseFloat(form.valor.value);

        const newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td class="tipo-col">${tipo}</td>
            <td class="descricao-col">${descricao}</td>
            <td class="valor-col">R$${valor.toFixed(2)}</td>
        `;

        registrosBody.appendChild(newRow);

        total += valor;
        totalAmount.textContent = `R$${total.toFixed(2)}`;
        
        // Atualiza o total de registros dinamicamente
        totalRegistros++;
        document.getElementById("total-amount").textContent = `R$${totalRegistros.toFixed(2)}`;

        form.reset();
    });

    adicionarGastoButton.addEventListener("click", () => {
        const categoria = gastosForm.categoria.value;
        const descricaoGasto = gastosForm["descricao-gasto"].value;
        const valorGasto = parseFloat(gastosForm["valor-gasto"].value);

        const newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td class="categoria-col">${categoria}</td>
            <td class="descricao-col">${descricaoGasto}</td>
            <td class="valor-col">R$${valorGasto.toFixed(2)}</td>
        `;

        gastosBody.appendChild(newRow);

        totalGastos += valorGasto;
        totalGastosAmount.textContent = `R$${totalGastos.toFixed(2)}`;

        gastosForm.reset();
    });
});
</script>
</body>
</html>
