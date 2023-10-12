<?php include('protect.php'); ?>

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
.calculadora {
    background-color: var(--preto);
    color: var(--branco);
	flex-grow: 1;
    width: 81%;
	padding: 36px 24px;
	font-family: var(--quicksand);
	max-height: calc(100vh - 56px);
	overflow-y: auto;
    border-radius: 20px;
        }
.botao {
    width: 50px;
    height: 50px;
    font-size: 25px;
    cursor: pointer;
    margin: 3px;
    background-color: rgb(31,31,31);
    border: none;
    color: #fff;
}
.botao:hover {
background-color: black;
}
#resultado {
    background-color: var(--cinzaescuro);
    width: 225px;
    height: 40px;
    margin: 5px;
    font-size: 25px;
    color: var(--branco);
    text-align: right;
    padding: 5px;
}
.calculator {
    background-color: var(--preto);
	color: var(--branco);
    border-radius: 20px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
	box-sizing: border-box;
    margin-left: 2%;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid var(--preto);
    border-radius: 5px;
	background-color: var(--cinzaescuro);
	color: var(--branco);
}

button {
    padding: 10px 20px;
    background-color: var(--azulclaro);
    color: var(--branco);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}
button:hover {
    background-color: var(--azulclaroclaro);
}

#result {
    font-weight: bold;
    margin-top: 20px;
}
.input-group {
    display: flex;
    justify-content: space-between;
    margin-bottom: 16px;
	cursor: pointer;
}

.input-group-row {
    flex-grow: 1;
    flex-basis: calc(50% - 12px); /* Ajuste conforme necessário */
    display: flex;
    flex-direction: column;
	margin-right: 12px;
	position: relative;
}
.input-box {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid var(--dark-grey);
    border-radius: 5px;
    position: absolute; /* Adicione essa linha */
    left: 0; /* Adicione essa linha */
	background-color: var(--cinzaescuro);
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
#content main .box-info li:nth-child(1) .bx {
	background: var(--verdelimaoclaro);
	color: var(--verdelimao);
}
#content main .box-info li:nth-child(2) .bx {
	background: var(--azulescuroclaro);
	color: var(--azulescuro);
}
#content main .box-info li:nth-child(3) .bx {
	background: var(--laranjaclaro);
	color: var(--laranja);
}
#content main .box-info li:nth-child(4) .bx {
	background: var(--rosaclaro);
	color: var(--rosa);
}
#content main .box-info li:nth-child(5) .bx {
	background: var(--roxoclaro);
	color: var(--roxo);
}
#content main .box-info li.estoque-box .bx {
    background: var(--rosaclaro);
	color: var(--rosa);
}
#content main .box-info li.agenda-box .bx {
    background: var(--marromclaro);
	color: var(--marrom);
}
#content main .box-info li.tabela-box .bx {
    background: var(--azulclaroclaro);
	color: var(--azulclaro);
}
#content main .box-info li.calculadora-box .bx {
    background: var(--azulescuroclaro);
	color: var(--azulescuro);
}
#content main .box-info li:nth-child(6) .bx {
	background: var(--amareloclaro);
	color: var(--amarelo);
}
#content main .box-info li:nth-child(7) .bx {
	background: var(--cinzaclaro);
	color: var(--cinza);
}
#content main .box-info li:nth-child(8) .bx {
	background: var(--verdeesmeraldaclaro);
	color: var(--verdeesmeralda);
}
#content main .box-info li:nth-child(10) .bx {
	background: var(--azulcelesteclaro);
	color: var(--azulceleste);
}
#content main .box-info li:nth-child(12) .bx {
	background: var(--cinzaclaro);
	color: var(--cinza);
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
}
#content main .table-data .order table tr td .status {
	font-size: 10px;
	padding: 6px 16px;
	color: var(--preto);
	border-radius: 20px;
	font-weight: 700;
}
#content main .table-data .order table tr td .status.completed {
	background: var(--verdeesmeralda);
}
#content main .table-data .order table tr td .status.process {
	background: var(--amarelo);
}
#content main .table-data .order table tr td .status.pending {
	background: var(--vermelho);
}


#content main .table-data .todo {
	flex-grow: 1;
	flex-basis: 300px;
}
#content main .table-data .todo .todo-list {
	width: 100%;
}
#content main .table-data .todo .todo-list li {
	width: 100%;
	margin-bottom: 16px;
	background: var(--cinzaescuro);
	border-radius: 10px;
	padding: 14px 20px;
	display: flex;
	justify-content: space-between;
	align-items: center;
}
#content main .table-data .todo .todo-list li .bx {
	cursor: pointer;
}
#content main .table-data .todo .todo-list li.completed {
	border-left: 10px solid var(--verdeesmeralda);
}
#content main .table-data .todo .todo-list li.not-completed {
	border-left: 10px solid var(--amarelo);
}
#content main .table-data .todo .todo-list li:last-child {
	margin-bottom: 0;
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
					<h1>Calculadora</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Comum - M²</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="home.php">Voltar</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
        <div class="calculadora">
            <H1>Calculadora Comum</H1>
                <p id="resultado"></p>
            <table>
                <tr>
                    <td><button class="botao" onclick="clean()">C</button></td>
                    <td><button class="botao" onclick="back()"><</button></td>
                    <td><button class="botao" onclick="insert('/')">/</button></td>
                    <td><button class="botao" onclick="insert('*')">X</button></td>
                </tr>
                <tr>
                    <td><button class="botao" onclick="insert('7')">7</button></td>
                    <td><button class="botao" onclick="insert('8')">8</button></td>
                    <td><button class="botao" onclick="insert('9')">9</button></td>
                    <td><button class="botao" onclick="insert('-')">-</button></td>
                </tr>
                <tr>
                    <td><button class="botao" onclick="insert('4')">4</button></td>
                    <td><button class="botao" onclick="insert('5')">5</button></td>
                    <td><button class="botao" onclick="insert('6')">6</button></td>
                    <td><button class="botao" onclick="insert('+')">+</button></td>
                </tr>
                <tr>
                    <td><button class="botao" onclick="insert('1')">1</button></td>
                    <td><button class="botao" onclick="insert('2')">2</button></td>
                    <td><button class="botao" onclick="insert('3')">3</button></td>
                    <td rowspan="2"><button class="botao" style="height: 106px;" onclick="calcular()">=</button></td>
                </tr>
                <tr>
                    <td colspan="2"><button class="botao" style="width: 106px;" onclick="insert('0')">0</button></td>
                    <td><button class="botao" onclick="insert('.')">.</button></td>
                </tr>
            </table>
        </div>
    </div>
					<table>
						<tbody>
                        <div class="calculator">
    <h1>Calculadora M²</h1>
	<br><br><br>
    <div class="input-group">
        <div class="input-group-row">
            <label for="width">Largura:</label>
            <input type="number" id="width" step="0.01">
        </div>
        <div class="input-group-row">
            <label for="length">Comprimento:</label>
            <input type="number" id="length" step="0.01">
        </div>
    </div>
    <div class="input-group">
        <div class="input-group-row">
            <label for="quantity">Quantidade:</label>
            <input type="number" id="quantity">
        </div>
        <div class="input-group-row">
            <label for="valuePerM2">Valor por m²:</label>
            <input type="number" id="valuePerM2">
        </div>
    </div>
    <button id="calculate">Calcular</button>
    <div id="result">
        <p>Total: <span>0</span> m²</p>
        <p>Valor Total: <span>0</span></p>
    </div>
</div>
						</tbody>
					</table>
				</div>

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
})
    </script>

    <script>
function insert(num)
        {
            var numero = document.getElementById('resultado').innerHTML;
            document.getElementById('resultado').innerHTML = numero + num;
        }
        function clean()
        {
            document.getElementById('resultado').innerHTML = "";
        }
        function back()
        {
            var resultado = document.getElementById('resultado').innerHTML;
            document.getElementById('resultado').innerHTML = resultado.substring(0, resultado.length -1);
        }
        function calcular()
        {
            var resultado = document.getElementById('resultado').innerHTML;
            if(resultado)
            {
                document.getElementById('resultado').innerHTML = eval(resultado);
            }
            else
            {
                document.getElementById('resultado').innerHTML = "Nada..."
            }
        }
        </script>

        <script>
            document.getElementById("calculate").addEventListener("click", function () {
  const width = parseFloat(document.getElementById("width").value);
  const length = parseFloat(document.getElementById("length").value);
  const quantity = parseInt(document.getElementById("quantity").value);
  const valuePerM2 = parseFloat(document.getElementById("valuePerM2").value);
  
  if (!isNaN(width) && !isNaN(length) && !isNaN(quantity) && !isNaN(valuePerM2)) {
    const area = width * length;
    const totalArea = area * quantity;
    const totalValue = totalArea * valuePerM2;

    document.getElementById("result").innerHTML = `
      <p>Total: <span>${totalArea.toFixed(2)}</span> m²</p>
      <p>Valor Total: <span>${totalValue.toFixed(2)}</span></p>
    `;
  } else {
    document.getElementById("result").innerHTML = `
      <p>Total: <span>Valores inválidos</span></p>
      <p>Valor Total: <span>Valores inválidos</span></p>
    `;
  }
});

document.getElementById("addToHistory").addEventListener("click", function () {
  const historyList = document.querySelector("#history ul");
  const totalArea = parseFloat(document.querySelector("#result span:first-child").textContent);
  const totalValue = parseFloat(document.querySelector("#result span:last-child").textContent);

  if (!isNaN(totalArea) && !isNaN(totalValue)) {
    const historyItem = document.createElement("li");
    historyItem.innerHTML = `Área: ${totalArea.toFixed(2)} m² | Valor: R$ ${totalValue.toFixed(2)}`;
    historyList.appendChild(historyItem);
  }
});
        </script>
</body>
</html>