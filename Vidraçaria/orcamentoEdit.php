<?php
include('protect.php');
$usuario = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';

$conn = new mysqli($host, $usuario, $senha, $database);

// Verificar se o ID do orçamento foi fornecido via parâmetro GET
if (!isset($_GET['id'])) {
    header("Location: orcamentos.php");
    exit();
}

$idOrcamento = $_GET['id'];

// Consultar o banco de dados para recuperar informações do orçamento
$sqlOrcamento = "SELECT * FROM orcamentos WHERE id = $idOrcamento";
$resultOrcamento = $conn->query($sqlOrcamento);

if ($resultOrcamento->num_rows === 0) {
    header("Location: orcamentos.php");
    exit();
}

$rowOrcamento = $resultOrcamento->fetch_assoc();
$statusAtual = isset($rowOrcamento['status']) ? $rowOrcamento['status'] : '';

$statusOptions = ['Pendente', 'Aprovado', 'Recusado'];

// Atualização do orçamento
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtenha os dados atualizados do formulário
    $quantidade = $_POST["quantidade"];
    $valorUnidade = $_POST["valor_unidade"];
    $status = $_POST["status"];

    // Realize as operações de atualização no banco de dados
    $sqlUpdate = "UPDATE orcamentos SET quantidade = $quantidade, valorUnidade = $valorUnidade, status = '$status' WHERE id = $idOrcamento";

    if ($conn->query($sqlUpdate) === TRUE) {
        header("Location: orcamentos.php");
        exit();
    } else {
        echo "Erro ao atualizar o orçamento: " . $conn->error;
    }
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
<title>Vidraçaria Lucas ◈ Orçamentos</title>
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
    --azulclaro: #3498db;
    --azulclaroclaro: #7fc4e8;
    --azulceleste: #00bcd4;
    --azulcelesteclaro: #8ed4dd;
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

    form {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        background-color: var(--preto);
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #007bff;
    }

    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #444;
        border-radius: 4px;
        background-color: #333;
        color: #fff;
    }

    select {
        appearance: none;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" fill="%23fff"><path d="M0 0l5 5 5-5z"/></svg>');
        background-repeat: no-repeat;
        background-size: 10px 6px;
        background-position: right 10px center;
        padding-right: 30px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
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
					<h1>Orçamentos</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Editar</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="orcamentos.php">Voltar</a>
						</li>
					</ul>
				</div>
			</div>
<br><br>

    <form method="POST">
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" value="<?php echo $rowOrcamento['quantidade']; ?>" required>
        <br>
        <label for="valor_unidade">Valor por Unidade:</label>
        <input type="number" name="valor_unidade" value="<?php echo $rowOrcamento['valorUnidade']; ?>" required>
        <br>
        <label for="status">Status do Orçamento:</label>
        <select name="status" id="status">
    <?php foreach ($statusOptions as $statusOption) : ?>
        <option value="<?php echo $statusOption; ?>" <?php if ($statusOption === $statusAtual) echo "selected"; ?>><?php echo $statusOption; ?></option>
    <?php endforeach; ?>
</select>
        <br>
        <button type="submit">Salvar Alterações</button>
    </form>
    <!-- ... outros elementos do body ... -->
</body>
</html>
