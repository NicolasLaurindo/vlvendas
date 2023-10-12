<?php include('protect.php'); ?>

<?php

// Conexão com o banco de dados
$usuario = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';

$conn = new mysqli($host, $usuario, $senha, $database);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Exclusão de imagem
if (isset($_GET['delete'])) {
    $idImagem = $_GET['delete'];

    // Obter o caminho da imagem para exclusão
    $sql = "SELECT caminho FROM imagens WHERE id = $idImagem";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $caminhoImagem = $row['caminho'];

        // Excluir a imagem do banco de dados
        $sql = "DELETE FROM imagens WHERE id = $idImagem";
        $conn->query($sql);

        // Excluir a imagem do sistema de arquivos
        if (file_exists($caminhoImagem)) {
            unlink($caminhoImagem);
        }
    }
}


       
// Consulta para recuperar as imagens do banco de dados
$sql = "SELECT * FROM imagens";
$result = $conn->query($sql);
$imagens = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imagens[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $descricao = $_POST["descricao"];
    $imagem = $_FILES["imagem"];

    if ($imagem["error"] === UPLOAD_ERR_OK) {
        // Create a unique name for the image to avoid conflicts
        $nomeImagem = uniqid() . '_' . $imagem["name"];
        $caminhoImagem = "assets/uploads/" . $nomeImagem;

        // Move the uploaded image to the destination directory
        if (move_uploaded_file($imagem["tmp_name"], $caminhoImagem)) {
            // Inserção da nova imagem no banco de dados
            $sql = "INSERT INTO imagens (descricao, caminho) VALUES ('$descricao', '$caminhoImagem')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['success'] = true;
            } else {
                $_SESSION['success'] = false;
            }

            header("Location: projetos.php");
            exit();
        } else {
            $_SESSION['success'] = false; // Image upload failed
        }
    }

    if(isset($_GET['search']) && !empty($_GET['search'])) {
        $searchQuery = $_GET['search'];
    
        // Modify the SQL query to filter images by description
        $sql = "SELECT * FROM imagens WHERE descricao LIKE '%$searchQuery%'";
        $result = $conn->query($sql);
        $imagens = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagens[] = $row;
            }
        }
    } else {
        // If no search query, retrieve all images
        $sql = "SELECT * FROM imagens";
        $result = $conn->query($sql);
        $imagens = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagens[] = $row;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<title>Vidraçaria Lucas ◈ Projetos</title>
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

/* Image Upload Form */
#content main form {
    margin-top: 20px;
}

#content main form label {
    display: block;
    margin-bottom: 8px;
    color: var(--branco);
}

.add-project-heading {
    font-size: 24px;
    color: var(--branco);
    margin-bottom: 16px;
}

#content main form input[type="text"] {
    display: block;
    width: 100%;
    height: 100px;
    padding: 8px;
    border: 1px solid var(--preto);
    border-radius: 5px;
    background-color: var(--preto);
    color: var(--branco);
    text-align: top;
}

.upload-icon-label {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.upload-icon-label i {
    font-size: 24px;
    margin-right: 8px;
    background-color: var(--azulclaro);
    color: var(--branco);
    border-radius: 50%; /* Make the icon circular */
    padding: 8px; /* Add some padding to create a circular button */
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.upload-icon-label i:hover {
    background-color: var(--azulclaroclaro);
}

/* Update the font size and spacing of the text next to the upload icon */
.upload-icon-label .text {
    font-size: 16px; /* Adjust the font size as needed */
    margin-left: 10px; /* Add some space between the icon and the text */
}

/* Style the upload icon and add a rounded blue background */
.upload-icon-label i {
    font-size: 24px;
    margin-right: 8px;
    padding: 8px;
    border-radius: 50%; /* Make the icon background rounded */
    background-color: var(--azulclaro); /* Set the background color to the blue shade */
    color: var(--branco); /* Set the text color to white */
    cursor: pointer;
}

.upload-icon-label input[type="file"] {
    position: absolute;
    left: -9999px;
    opacity: 0; /* Set opacity to 0 to hide the default text */
}

#content main form input[type="submit"] {
    margin-top: 10px;
    background-color: var(--azulclaro);
    color: var(--branco);
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#content main form input[type="submit"]:hover {
    background-color: var(--azulclaroclaro);
}

/* Image Display */
/* Image Display */
#content main div.image-container {
    margin-top: 20px;
    display: flex;
    align-items: center;
    background-color: var(--cinzaescuro); /* Set background color */
    padding: 10px; /* Add padding for spacing */
    border-radius: 4px; /* Rounded corners for the container */
}

#content main div.image-container img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 4px;
    margin-right: 16px;
}

#content main div.image-container p {
    color: var(--branco);
    flex: 1;
    margin: 0; /* Reset margin to remove default spacing */
}

#content main div.image-container a {
    color: var(--azulclaro);
    text-decoration: none;
    margin-left: auto;
}

#content main div.image-container a:hover {
    text-decoration: underline;
}
.delete-icon {
    margin-right: 10px;
}

.delete-icon i {
    background-color: #e74c3c;
    color: white;
    border-radius: 50%;
    padding: 10px;
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
    table-layout: fixed;
}

#content main .table-data .order table th,
#content main .table-data .order table td {
    padding: 10px 8px;
    font-size: 13px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    border-bottom: 1px solid var(--cinzaescuro);
}

#content main .table-data .order table th:first-child,
#content main .table-data .order table td:first-child {
    width: 100px;
}

#content main .table-data .order table td:last-child {
    width: 100px;
    text-align: center;
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
    padding: 10px 8px;
    text-align: left;
    background-color: var(--preto);
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
					<h1>Projetos</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Adicionar</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="home.php">Voltar</a>
						</li>
					</ul>
				</div>
			</div>
<br><br>
            <h2 class="add-project-heading">Adicionar Projeto</h2>

<?php
// Exibir mensagem de sucesso, se necessário
if (isset($_SESSION['success'])) {
    if ($_SESSION['success']) {
        echo '<p style="color: green;">Imagem adicionada com sucesso!</p>';
    } else {
        echo '<p style="color: red;">Erro ao adicionar a imagem.</p>';
    }
    unset($_SESSION['success']);
}
?>

<form method="POST" enctype="multipart/form-data">
    <label for="descricao">Descrição:</label>
    <input type="text" name="descricao" required>
    <br>

    <div class="upload-icon-label">
    <i class="fa fa-upload"></i>
    <!-- The input will be visually hidden but still functional -->
    <input id="upload-input" type="file" name="imagem" accept="image/*" required>
    </div>

    <input type="submit" value="Enviar Imagem">
</form>

<div class="table-data">
    <div class="order">
        <div class="head">
            <h1>Lista de Projetos</h1>
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
                    <th scope="col">Croqui</th>
                    <th scope="col">Descrição</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($imagens as $imagem) {
                    echo '<tr>'; // Start a new table row for each image
                    
                    echo '<td><img src="' . $imagem['caminho'] . '" alt="' . $imagem['descricao'] . '" width="100" height="100"></td>';
                    echo '<td>' . $imagem['descricao'] . '</td>';
                    echo '<td><a class="delete-icon" href="?delete=' . $imagem['id'] . '"><i class="fa-solid fa-trash"></i></a></td>';
                    
                    echo '</tr>'; // Close the table row
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

    <script>
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
        window.location = 'projetos.php?search='+search.value;
    }
    </script>

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
        document.addEventListener("DOMContentLoaded", function() {
    // Trigger the file input when the icon is clicked
    document.querySelector('.upload-icon-label i').addEventListener('click', function() {
        document.querySelector('#upload-input').click();
    });

    // Display the selected file name
    document.querySelector('#upload-input').addEventListener('change', function() {
        var fileName = this.value.split('\\').pop();
        document.querySelector('.upload-icon-label i').textContent = fileName;
    });
});
    </script>
</body>
</html>

