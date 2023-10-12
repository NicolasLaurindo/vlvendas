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
    $id = $_POST["id"];
    $tipo = $_POST["tipo"];
    $descricao = $_POST["descricao"];
    $valor = $_POST["valor"];

    $sql = "UPDATE registros SET tipo = '$tipo', descricao = '$descricao', valor = $valor WHERE id = $id";

    if ($mysqli->query($sql) === true) {
        header("Location: financeiro.php"); // Redireciona para a página principal
        exit();
    } else {
        echo "Erro ao atualizar registro: " . $mysqli->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM registros WHERE id = $id");

    if ($result->num_rows === 1) {
        $registro = $result->fetch_assoc();
    } else {
        echo "Registro não encontrado.";
        exit();
    }
} else {
    echo "ID do registro não fornecido.";
    exit();
}

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
							<a href="#">Editar</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="financeiro.php">Voltar</a>
						</li>
					</ul>
				</div>
			</div>
<br>
<div class="container">
    <h2>Editar Registro</h2>
    <form id="editar-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?= $registro['id'] ?>">
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo">
            <option value="Dinheiro" <?= $registro['tipo'] === 'Dinheiro' ? 'selected' : '' ?>>Dinheiro</option>
            <option value="Cartão" <?= $registro['tipo'] === 'Cartão' ? 'selected' : '' ?>>Cartão</option>
            <option value="Cheque" <?= $registro['tipo'] === 'Cheque' ? 'selected' : '' ?>>Cheque</option>
        </select>
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required value="<?= $registro['descricao'] ?>">
        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" step="0.01" required value="<?= $registro['valor'] ?>">
        <button type="submit">Salvar Alterações</button>
    </form>
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

</body>
</html>
