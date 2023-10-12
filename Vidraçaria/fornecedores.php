<?php include('protect.php'); ?>

<?php

include_once('conexao.php');

if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM fornecedores WHERE id LIKE '%$data%' or fornecedor LIKE '%$data%' or empresa LIKE '%$data%' ORDER BY id DESC";
    }
    else
    {

$sql = "SELECT * FROM fornecedores ORDER BY id DESC";
    }
$result = $conexao->query($sql);

// print_r($result);

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
	text-transform: uppercase;
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



.button {
  position: relative;
  width: 150px;
  height: 35px;
  cursor: pointer;
  display: flex;
  align-items: center;
  border: 1px solid var(--azulclaro);
  background-color: var(--azulclaro);
  border-radius: 20px;
}

.button, .button__icon, .button__text {
  transition: all 0.3s;
}

.button .button__text {
  transform: translateX(30px);
  color: #fff;
  font-weight: 600;
}

.button .button__icon {
  position: absolute;
  transform: translateX(115px);
  height: 100%;
  width: 35px;
  background-color: var(--azulclaroclaro);
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 20px;
}

.button .svg {
  width: 30px;
  stroke: #fff;
}

.button:hover {
  background: var(--azulclaroclaro);
}

.button:hover .button__text {
  color: transparent;
}

.button:hover .button__icon {
  width: 148px;
  transform: translateX(0);
}

.button:active .button__icon {
  background-color: var(--azulclaroclaro);
}

.button:active {
  border: 1px solid var(--azulclaroclaro);
}
.search-box {
    display: flex;
    align-items: center;
    height: 36px;
}

.search-box .search-txt {
    flex-grow: 1;
    padding: 0 16px;
    height: 100%;
    border: none;
    background: var(--cinzaescuro);
    border-radius: 36px 0 0 36px;
    outline: none;
    width: 100%;
    color: var(--branco);
}

.search-box .search-btn {
    width: 36px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: var(--azulclaro);
    color: var(--branco);
    font-size: 18px;
    border: none;
    outline: none;
    border-radius: 0 36px 36px 0;
    cursor: pointer;
	margin-left: -5px;
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
	font-size: 16px;
	text-align: left;
	border-bottom: 1px solid var(--cinzaescuro);
}
#content main .table-data .order table td {
	padding: 16px 0;
	font-size: 13px;
}
#content main .table-data .order table tr td:first-child {
	display: flex;
	align-items: center;
	grid-gap: 12px;
	padding-left: 6px;
	margin-top: 8px;
}
#content main .table-data .order table tbody tr:hover {
    background: var(--cinzaescuro);
}
#content main .table-data .order table tbody tr:hover td:first-child {
    border-radius: 10px 0 0 10px;
}

#content main .table-data .order table tbody tr:hover td:last-child {
    border-radius: 0 10px 10px 0;
}
.table-data table th {
    color: var(--azulclaro);
}




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

	<title>Vidraçaria Lucas ◈ Fornecedores</title>
</head>
<body>


	<!-- SIDEBAR -->
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
			<li  class="active">
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
					<h1>Fornecedores</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Lista</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="home.php">Voltar</a>
						</li>
					</ul>
				</div>
			</div>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Lista de Fornecedores</h3>	
						<a href="fornecedorAd">					
							<button type="button" class="button">
  								<span class="button__text">Adicionar</span>
  								<span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
							</button>
						</a>
							<div class="search-box">
        						<input class="search-txt" type="text" id="pesquisar" placeholder="Pesquisar">
            			<button class="search-btn" onclick="searchData()">
                			<i class="fa-solid fa-magnifying-glass"></i>
            			</button>
    				</div>
					</div>
					<table>
						<thead>
							<tr>
                                <th scope="col">Fornecedor de</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">CNPJ</th>
                                <th scope="col">Cidade</th>
                                <th scope="col">Bairro</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Contatos Vendedor</th>
                                <th scope="col"></th>
                			</tr>
						</thead>
						<tbody>
						<?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr class='new-record'>";
                        echo "<td>".$user_data['fornecedor']."</td>";
                        echo "<td>".$user_data['empresa']."</td>";
                        echo "<td>".$user_data['cnpj']."</td>";
                        echo "<td>".$user_data['cidade']."</td>";
                        echo "<td>".$user_data['bairro']."</td>";
                        echo "<td>".$user_data['endereco']."</td>";
                        echo "<td>".$user_data['telefone']."</td>";
                        echo "<td>".$user_data['contato']."</td>";
                        echo "<td>
							<a class='btn btn-primary' href='fornecedorEdit.php?id=".$user_data['id']."'>
								<i class='fa-solid fa-pen' style='background-color: #3498db; color: white; border-radius: 50%; padding: 10px;'></i>
							</a>
								<span style='margin-right: 10px;'></span>
							<a class='btn btn-danger' href='fornecedorDel.php?id=".$user_data['id']."'>
								<i class='fa-solid fa-trash-can' style='background-color: #e74c3c; color: white; border-radius: 50%; padding: 10px;'></i>
							</a>
						</span>
                        </td>";
                        echo"</tr>";
                    }
            			?>
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
        window.location = 'fornecedores.php?search='+search.value;
    }
    </script>
</body>
</html>