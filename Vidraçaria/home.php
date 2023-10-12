<?php include('protect.php'); ?>

<?php

include_once('conexao.php');

if (isset($_POST['tarefa'])) {
    $tarefa = filter_input(INPUT_POST, 'tarefa', FILTER_SANITIZE_STRING);
    $query = "INSERT INTO tarefas (descricao, concluida) VALUES (:descricao, 0)";
    $stm = $pdo->prepare($query);
    $stm->bindParam(':descricao', $tarefa);
    $stm->execute();

	header('Location: home.php');
}

if (isset($_GET['excluir'])) {
	$id = filter_input(INPUT_GET, 'excluir', FILTER_SANITIZE_STRING);
	$query = "DELETE FROM tarefas WHERE id=:id";
	$stm = $pdo->prepare($query);
    $stm->bindParam('id', $id);
    $stm->execute();

	header('Location: home.php');
}

if (isset($_GET['concluir'])) {
	$id = filter_input(INPUT_GET, 'concluir', FILTER_SANITIZE_STRING);
	$query = "UPDATE tarefas SET concluida=1 WHERE id=:id";
	$stm = $pdo->prepare($query);
    $stm->bindParam('id', $id);
    $stm->execute();

	header('Location: home.php');
}

if (isset($_GET['reabrir'])) {
	$id = filter_input(INPUT_GET, 'reabrir', FILTER_SANITIZE_STRING);
	$query = "UPDATE tarefas SET concluida=0 WHERE id=:id";
	$stm = $pdo->prepare($query);
    $stm->bindParam('id', $id);
    $stm->execute();

	header('Location: home.php');
}

	$query = "SELECT id, descricao, concluida FROM tarefas";
	$result = $conexao->query($query);

// Verificar se a consulta teve sucesso
if ($result) {
    $lista = [];
    while ($row = $result->fetch_assoc()) {
        $lista[] = $row;
    }
} else {
    die("Erro na consulta: " . $conexao->error);
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- CSS -->
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
	--vermelhoescuro: #c0392b;
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
	color: var(--dark-grey);
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




#content main .box-info {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
	grid-gap: 24px;
	margin-top: 36px;
}
#content main .box-info li {
	padding: 24px;
	background: var(--preto);
	border-radius: 20px;
	display: flex;
	align-items: center;
	grid-gap: 24px;
}
#content main .box-info li .bx {
	width: 80px;
	height: 80px;
	border-radius: 10px;
	font-size: 36px;
	display: flex;
	justify-content: center;
	align-items: center;
}
#content main .box-info li.orcamento-box .bx {
    background: #3498db;
	color: #2980b9;
}
#content main .box-info li.financeiro-box .bx {
    background: #2e7d32;
	color: #1b5e20;
}
#content main .box-info li.estoque-box .bx {
    background: #8d6e63;
	color: #6d4c41;
}
#content main .box-info li.agenda-box .bx {
	background: #e57373;
	color: #d32f2f;
}
#content main .box-info li.tabela-box .bx {
    background: #4caf50;
	color: #388e3c;
}
#content main .box-info li.calculadora-box .bx {
    background: #c0c0c0;
	color: #808080;
}
#content main .box-info li.projeto-box .bx {
    background: #9c27b0;
	color: #7b1fa2;
}
#content main .box-info li.pedido-box .bx {
    background: #1976d2;
	color: #0d47a1;
}
#content main .box-info li .text h3 {
	font-size: 24px;
	font-weight: 600;
	color: var(--branco);
}
#content main .box-info li .text p {
	color: var(--branco);	
}
.side-menu-link {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 10px 20px;
    background-color: var(--preto);
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.side-menu-link:hover {
    background-color: var(--preto);
}

.side-menu-link i {
    font-size: 24px;
    color: var(--branco);
}

.side-menu-link .text {
    margin-left: 15px;
    color: var(--branco);
}

.side-menu-link .text h3 {
    font-size: 18px;
    margin-bottom: 4px;
}

.side-menu-link .text p {
    font-size: 14px;
}






#content main .table-data {
	display: flex;
	flex-wrap: wrap;
	grid-gap: 24px;
	margin-top: 24px;
	width: 100%;
	color: var(--branco);
}
#content main .table-data > div {
	border-radius: 20px;
	background: var(--preto);
	padding: 24px;
	overflow-x: auto;
}
#content main .table-data .head {
	display: flex;
	align-items: center;
	grid-gap: 16px;
	margin-bottom: 24px;
}
#content main .table-data .head h3 {
	margin-right: auto;
	font-size: 24px;
	font-weight: 600;
}
#content main .table-data .head .bx {
	cursor: pointer;
}

#content main .table-data .order {
	flex-grow: 1;
	flex-basis: 500px;
}
#content main .table-data .order table {
	width: 100%;
	border-collapse: collapse;
}
#content main .table-data .order table th {
	padding-bottom: 12px;
	font-size: 13px;
	text-align: left;
	border-bottom: 1px solid var(--cinzaescuro);
}
#content main .table-data .order table td {
	padding: 16px 0;
}
#content main .table-data .order table tr td:first-child {
	display: flex;
	align-items: center;
	grid-gap: 12px;
	padding-left: 6px;
}
#content main .table-data .order table td img {
	width: 36px;
	height: 36px;
	border-radius: 50%;
	object-fit: cover;
}
#content main .table-data .order table tbody tr:hover {
	background: var(--cinzaescuro);
	border-radius: 5px;
}
#content main .table-data .order table tr td .status {
	font-size: 10px;
	padding: 6px 16px;
	color: var(--preto);
	border-radius: 20px;
	font-weight: 700;
}
#content main .table-data .order table tr td .status.aprovado {
	background: var(--verdeesmeralda);
}
#content main .table-data .order table tr td .status.pendente {
	background: var(--amarelo);
}
#content main .table-data .order table tr td .status.recusado {
	background: var(--vermelho);
}


.todo {
  position: relative;
  background-color: var(--preto);
  border-radius: 10px;
  padding: 20px;
  width: calc(40% - 20px);
}

.fa-plus {
  position: absolute;
  right: 18px; /* Ajuste este valor conforme necessário */
  top: 7%;
  transform: translateY(-50%);
  font-size: 16px;
  color: white;
  cursor: pointer;
}

#content main .todo h3 {
	margin-right: auto;
	font-size: 24px;
	font-weight: 600;
}

/* Estilo para o pop-up de fundo */
.popup {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.9); /* Fundo preto com transparência */
  z-index: 9999;
}

/* Estilo para o conteúdo do pop-up */
.popup-content {
  position: absolute;
  width: 300px;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: var(--preto); /* Utilizando sua variável de cor azul */
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
  color: var(--branco); /* Utilizando sua variável de cor branca para o texto */
}

/* Estilo para fechar o pop-up */
.popup-close {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 20px;
  color: var(--cinzaescuro); /* Utilizando sua variável de cor cinza para o ícone de fechar */
  cursor: pointer;
}

.usernamelabel {
    display: block;
    color: white;
    font-size: 14px;
    padding: 5px 5px;
}

.usernameField {
	display: block;
	width: 200px;
	height: 40px;
	background-color: #292929;
	border-radius: 30px;
	border: 2px solid #292929;
	padding: 0px 12px;
	outline: none;
	caret-color: var(--azulceleste);
	color: var(--azulceleste);
	font-size: 12px;
	transition-duration: .2s;
}

.usernameField:focus,
.usernameField:valid {
    border: 2px solid var(--azulceleste);
    transition-duration: .2s;
}

.todo .lista ul {
  list-style-type: none;
  padding: 0;
}

.todo .lista li {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 10px;
  background-color: var(--preto);
  border-radius: 5px;
  padding: 10px;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.todo .lista li:hover {
  background-color: var(--cinzaescuro);
}

.todo .lista li:last-child {
  border-bottom: none;
}

.todo .lista li.concluida {
  text-decoration: line-through;
  color: var(--dark-grey);
}

.todo .lista li a {
  margin-left: 10px;
  color: var(--azulescuro);
  text-decoration: none;
  transition: color 0.3s ease;
}


.todo .lista li .fa-trash {
    background-color: #e74c3c; /* Vermelho */
    color: white;
    border-radius: 50%;
    padding: 15px;
    font-size: 15px;
    width: 10px;
    height: 10px;
    margin: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s, color 0.3s;
}

/* Estilo para o ícone de círculo (aqui assume que você está usando FontAwesome) */
.todo .lista li .fa-circle {
  color: var(--verdeesmeralda);
  transition: color 0.3s ease, transform 0.2s ease;
}

/* Estilo para o ícone de círculo check (aqui assume que você está usando FontAwesome) */
.todo .lista li .fa-circle-check {
  color: var(--verdeesmeralda);
  transform: scale(0);
  transition: color 0.3s ease, transform 0.2s ease;
  border-radius: 50%; /* Adicionado para tornar o fundo circular */
  background-color: var(--verdeesmeralda); /* Adicionado para a cor de fundo */
  padding: 3px; /* Adicionado para ajustar o espaço ao redor do ícone */
}

/* Animação para mostrar o ícone de círculo check */
.todo .lista li.concluida .fa-circle-check {
  transform: scale(1);
  color: var(--verdeesmeralda);
  animation: splash-12 0.6s ease forwards;
}

/* Animação customizada */
@keyframes splash-12 {
  40% {
    background: #008000; /* Alterado para verde esmeralda */
    box-shadow: 0 -18px 0 -8px #008000, 16px -8px 0 -8px #008000, 16px 8px 0 -8px #008000, 0 18px 0 -8px #008000, -16px 8px 0 -8px #008000, -16px -8px 0 -8px #008000;
  }

  100% {
    background: #008000; /* Alterado para verde esmeralda */
    box-shadow: 0 -36px 0 -10px transparent, 32px -16px 0 -10px transparent, 32px 16px 0 -10px transparent, 0 36px 0 -10px transparent, -32px 16px 0 -10px transparent, -32px -16px 0 -10px transparent;
  }
}

/* MAIN */
/* CONTENT */









@media screen and (max-width: 768px) {
	#sidebar {
		width: 200px;
	}

	#content {
		width: calc(100% - 60px);
		left: 200px;
	}

	#content nav .nav-link {
		display: none;
	}
}






@media screen and (max-width: 576px) {
	#content nav form .form-input input {
		display: none;
	}

	#content nav form .form-input button {
		width: auto;
		height: auto;
		background: transparent;
		border-radius: none;
		color: var(--branco);
	}

	#content nav form.show .form-input input {
		display: block;
		width: 100%;
	}
	#content nav form.show .form-input button {
		width: 36px;
		height: 100%;
		border-radius: 0 36px 36px 0;
		color: var(--preto);
		background: var(--vermelho);
	}

	#content nav form.show ~ .notification,
	#content nav form.show ~ .profile {
		display: none;
	}

	#content main .box-info {
		grid-template-columns: 1fr;
	}

	#content main .table-data .head {
		min-width: 420px;
	}
	#content main .table-data .order table {
		min-width: 420px;
	}
	#content main .table-data .todo .todo-list {
		min-width: 420px;
	}
}
    </style>

	<title>Vidraçaria Lucas ◈ Home</title>
</head>
<body>

	<?php
        include_once('conexao.php'); // Certifique-se de que este arquivo possui a conexão $conexao

        $query = "SELECT orcamentos.id, clientes.nome AS nomeCliente, orcamentos.dataCriacao, orcamentos.status FROM orcamentos
                  INNER JOIN clientes ON orcamentos.clienteId = clientes.id
                  ORDER BY orcamentos.dataCriacao DESC
                  LIMIT 5";
        $result = $conexao->query($query);

        if (!$result) {
            die("Erro na consulta: " . $conexao->error);
        }
    ?>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
            <img src="assets/imgs/logo.png" class="logo-img">
			<span class="text">Vidraçaria Lucas</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
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
					<h1>Painel</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Painel</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
			<a href="orcamentos.php">
				<li class="orcamento-box">
                    <i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<p>Orçamentos</p>
					</span>
				</li>
			</a>
			<a href="calc.php">
				<li class="calculadora-box">
					<i class='bx bxs-calculator'></i>
					<span class="text">
						<p>Calculadora</p>
					</span>
				</li>
			</a>
			<a href="tabela.php">
                <li class="tabela-box">
                    <i class='bx bx-table' ></i>
					<span class="text">
						<p>Tabela de Preços</p>
					</span>
				</li>
			</a>
			<a href="agenda.php">
				<li class="agenda-box">
                    <i class='bx bxs-calendar-check'></i>
					<span class="text">
						<p>Agendar</p>
					</span>
				</li>
			</a>
			<a href="pedidos.php">
                <li class="pedido-box">
					<i class='bx bxs-shopping-bags'></i>
					<span class="text">
						<p>Pedidos</p>
					</span>
				</li>
			</a>
			<a href="estoque.php">
                <li class="estoque-box">
                    <i class='bx bxs-box'></i>
					<span class="text">
						<p>Estoque</p>
					</span>
				</li>
			</a>
			<a href="financeiro.php">
                <li class="financeiro-box">
                    <i class='bx bxs-wallet'></i>
					<span class="text">
						<p>Financeiro</p>
					</span>
				</li>
			</a>
			<a href="projetos.php">
				<li class="projeto-box">
                    <i class='bx bx-stats'></i>
					<span class="text">
						<p>Projetos</p>
					</span>
				</li>
			</a>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Orçamentos Recentes</h3>
					</div>
					<table>
						<thead>
							<tr>
							<th>Cliente</th>
							<th>Data de Registro</th>
							<th>Status</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . $row['nomeCliente'] . "</td>";
								echo "<td>" . date('d-m-Y', strtotime($row['dataCriacao'])) . "</td>";
								echo "<td><span class='status " . strtolower($row['status']) . "'>" . $row['status'] . "</span></td>";
								echo "</tr>";
							}
							$result->free();
						?>
						</tbody>
					</table>
				</div>

			<div class="todo">
				<h3>Lista de Tarefas</h3>
				<form method="POST">
				<i class="fa-solid fa-plus" id="openPopupButton"></i>
					<div id="popup" class="popup">
    				<div class="popup-content">
						<h3></h3>
							<div class="form__group field">
								<input type="text" id="novaTarefa" name="tarefa" class="form__field usernameField" placeholder="Nova Tarefa" required="">
								<label for="novaTarefa" class="form__label usernamelabel"></label>
							</div>
        		<button type="submit" id="adicionarTarefaButton" name="submit" id="submit">Incluir</button>
        		<button id="closePopupButton">Fechar</button>
    		</div>
		</div>
				</form>
				<div class="lista">
					<ul>
						<?php foreach($lista as $item): ?>
							<li <?=$item['concluida']?'class="concluida"':''?> >
								<?=$item['descricao']?>
								<?php if(!$item['concluida']): ?>
									<a href="?concluir=<?=$item['id']?>"><i class="fa-regular fa-circle"></i></a>
								<?php else: ?>
									<a href="?reabrir=<?=$item['id']?>"><i class="fa-solid fa-circle-check"></i></a>
								<?php endif; ?>
									<a href="?excluir=<?=$item['id']?>"><i class="fa-solid fa-trash"></i></a>
							</li>
						<?php endforeach; ?>
					</ul>
					</div>
				</div>
		
	</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

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
});

// Obtenha os botões e o pop-up
const openPopupButton = document.getElementById('openPopupButton');
const closePopupButton = document.getElementById('closePopupButton');
const adicionarTarefaButton = document.getElementById('adicionarTarefaButton');
const popup = document.getElementById('popup');
const novaTarefaInput = document.getElementById('novaTarefa');

// Abra o pop-up quando o botão "Mostrar Lista" for clicado
openPopupButton.addEventListener('click', () => {
    popup.style.display = 'block';
});

// Feche o pop-up quando o botão "Fechar" for clicado
closePopupButton.addEventListener('click', () => {
    popup.style.display = 'none';
});

// Adicione uma nova tarefa quando o botão "Incluir" for clicado
adicionarTarefaButton.addEventListener('click', () => {
    const novaTarefa = novaTarefaInput.value;
    // Aqui você pode processar a nova tarefa como quiser
    console.log(`Nova Tarefa: ${novaTarefa}`);
});
    </script>
</body>
</html>