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

// Consulta para recuperar as imagens do banco de dados
$sql = "SELECT * FROM imagens";
$result = $conn->query($sql);
$imagens = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imagens[] = $row;
    }
}

$imagemDescricao = "";
$quantidade = "";
$valorUnidade = "";
$valorTotal = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $clienteId = $_POST['cliente'];
    
    // Inicializa um array para armazenar os detalhes das imagens
    $imagensDetalhes = [];

    // Itera pelos campos de imagem para coletar seus valores
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'imagem_') === 0) {
            $i = substr($key, strlen('imagem_'));
            $imagemId = $value;
            $quantidade = $_POST['quantidade_' . $i];
            $valorUnidade = $_POST['valor_unidade_' . $i];

            // Faça o que for necessário com esses valores
            // Por exemplo, você pode calcular o valor total para cada imagem e armazená-lo em um banco de dados
            $valorTotal = $quantidade * $valorUnidade;

            // Aqui você pode armazenar os detalhes da imagem em um array
            $imagensDetalhes[] = [
                'imagemId' => $imagemId,
                'quantidade' => $quantidade,
                'valorUnidade' => $valorUnidade,
                'valorTotal' => $valorTotal,
            ];
        }
    }
    // Inserir os dados na tabela de orçamentos
    $insertQuery = "INSERT INTO orcamentos (imagemId, clienteId, quantidade, valorUnidade, valorTotal) VALUES ('$imagemId', '$clienteId', '$quantidade', '$valorUnidade', '$valorTotal')";
    if ($conn->query($insertQuery) === TRUE) {
        // Redirecionar para a página de listagem de orçamentos
        header("Location: orcamentos.php");
        exit(); // Certifique-se de sair do script após o redirecionamento
    } else {
        echo "Erro ao salvar orçamento: " . $conn->error;
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
    flex-basis: 100%;
}

#content main .table-data .order table {
    width: 100%;
    border-collapse: collapse;
    table-layout: auto;
}

#content main .table-data .order table th,
#content main .table-data .order table td {
    padding: 12px 10px;
    font-size: 14px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: normal;
    border-bottom: 1px solid var(--cinzaescuro);
}

#content main .table-data .order table th:first-child,
#content main .table-data .order table td:first-child {
    min-width: 150px;
}

#content main .table-data .order table td:last-child {
    text-align: center;
}

#content main .table-data table th {
    color: var(--azulclaro);
    padding: 12px 10px;
    text-align: left;
    background-color: var(--preto);
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

#content main .table-data .order table td .fa-pen {
    background-color: #3498db; /* Azul */
    color: white;
    border-radius: 50%;
    padding: 15px;
    font-size: 24px;
    width: 40px;
    height: 40px;
    margin: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s, color 0.3s;
}

#content main .table-data .order table td .fa-trash-can {
    background-color: #e74c3c; /* Vermelho */
    color: white;
    border-radius: 50%;
    padding: 15px;
    font-size: 24px;
    width: 40px;
    height: 40px;
    margin: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s, color 0.3s;
}

#content main .table-data .order table td .fa-file-pdf {
    background-color: #f39c12; /* Laranja amarelado */
    color: white;
    border-radius: 50%;
    padding: 15px;
    font-size: 24px;
    width: 40px;
    height: 40px;
    margin: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s, color 0.3s;
}

    form {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        background-color: var(--preto);
        border-radius: 20px;
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

    <form method="POST">
    <label for="cliente">Cliente:</label>
    <select name="cliente" id="cliente">
        <?php
        // Consulta para recuperar os clientes do banco de dados
        $sqlClientes = "SELECT * FROM clientes";
        $resultClientes = $conn->query($sqlClientes);

        if ($resultClientes->num_rows > 0) {
            while ($rowCliente = $resultClientes->fetch_assoc()) {
                echo "<option value='" . $rowCliente['id'] . "'>" . $rowCliente['nome'] . "</option>";
            }
        }
        ?>
    </select>
    <br>
    <div id="imagens-container">
    <!-- O conteúdo será adicionado dinamicamente aqui -->
  </div>
  <button type="button" id="adicionar-imagem">Adicionar Imagem</button>

<?php
// Gere as opções do select com PHP com base nos dados do servidor
$options = '';
foreach ($imagens as $imagem) {
    $options .= "<option value='{$imagem['id']}'>{$imagem['descricao']}</option>";
}
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("imagens-container");
    const addButton = document.getElementById("adicionar-imagem");
    
    let i = 0; // Um índice inicial

    addButton.addEventListener("click", function () {
        createNewFields(i);
        i++; // Incrementa o índice para a próxima entrada de imagem
    });

    function createNewFields(index) {
        const newImageDiv = document.createElement("div");

        newImageDiv.innerHTML = `
            <label for="imagem_${index}">Imagem:</label>
            <select name="imagem_${index}" id="imagem_${index}">
                <?php echo $options; ?>
            </select>

            <label for="quantidade_${index}">Quantidade:</label>
            <input type="number" name="quantidade_${index}" required>

            <label for="valor_unidade_${index}">Valor por Unidade:</label>
            <input type="number" name="valor_unidade_${index}" required>
        `;

        container.appendChild(newImageDiv);
    }
});
</script>
    <button type="submit">Calcular e Salvar Orçamento</button>
</form>

<div class="table-data">
    <div class="order">
        <div class="head">
            <h1>Lista de Orçamentos</h1>
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
                    <th scope="col">Cliente</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor Individual</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta para recuperar os orçamentos do banco de dados
                $sql = "SELECT orcamentos.*, clientes.nome AS cliente_nome, clientes.cpf AS cliente_cpf, clientes.telefone AS cliente_telefone, clientes.endereco AS cliente_endereco, imagens.descricao AS imagem_descricao, imagens.caminho AS imagem_caminho FROM Orcamentos JOIN imagens ON Orcamentos.imagemId = imagens.id JOIN clientes ON Orcamentos.clienteId = clientes.id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='assets/uploads/" . $row['imagem_caminho'] . "'></td>";
                        echo "<td>" . $row['imagem_descricao'] . "</td>";
                        echo "<td>" . $row['cliente_nome'] . "</td>";
                        echo "<td>" . $row['cliente_cpf'] . "</td>";
                        echo "<td>" . $row['cliente_telefone'] . "</td>";
                        echo "<td>" . $row['cliente_endereco'] . "</td>";
                        echo "<td>" . $row['quantidade'] . "</td>";
                        echo "<td>R$ " . $row['valorUnidade'] . "</td>";
                        echo "<td>R$ " . $row['valorTotal'] . "</td>";
                        echo "<td>
                        <div class='button-container'>
                            <a class='btn btn-primary' href='orcamentoEdit.php?id=".$row['id']."'>
                                <i class='fa-solid fa-pen'></i>
                            </a>
                            <a class='btn btn-danger' href='orcamentoDel.php?id=".$row['id']."'>
                                <i class='fa-solid fa-trash-can'></i>
                            </a>
                            <a class='btn btn-danger' href='gerarPdf.php?id=".$row['id']."'>
                                <i class='fas fa-file-pdf'></i>
                            </a>
                        </div>
                    </td>";
        }
    } else {
        echo "<tr><td colspan='11'>Nenhum orçamento encontrado.</td></tr>";
    }    
    ?>
            </tbody>
        </table>
    </div>
</div>

    <!-- ... Outros elementos do corpo da página ... -->

    <!-- Scripts -->
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
        window.location = 'orcamentos.php?search='+search.value;
    }
    </script>
    <script>
        // Atualizar os totais quando a quantidade ou valor individual mudar
        const quantidades = document.querySelectorAll('input[name="quantidade[]"]');
        const valoresIndividuais = document.querySelectorAll('input[name="valor_individual[]"]');
        const totais = document.querySelectorAll('.total');

        function updateTotals() {
            for (let i = 0; i < quantidades.length; i++) {
                const quantidade = parseInt(quantidades[i].value);
                const valorIndividual = parseFloat(valoresIndividuais[i].value);
                const total = quantidade * valorIndividual;
                totais[i].textContent = total.toFixed(2);
            }
        }

        quantidades.forEach(input => input.addEventListener('input', updateTotals));
        valoresIndividuais.forEach(input => input.addEventListener('input', updateTotals));
    </script>
    <script>
        // SEARCH
// Select the search input element using its class name
var searchInput = document.querySelector('.search-txt');
var searchButton = document.querySelector('.search-btn');

// Add an event listener for the "Enter" key press
searchInput.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        searchData();
    }
});

// Add an event listener for the search button click
searchButton.addEventListener("click", function() {
    searchData();
});

// Function to handle search and redirection
function searchData() {
    var searchQuery = searchInput.value.trim(); // Trim whitespace

    // Redirect to the search results page with the search query as a parameter
    window.location = 'projetos.php?search=' + encodeURIComponent(searchQuery);
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

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
