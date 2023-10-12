<?php
include('conexao.php');

if (isset($_POST['nome']) && isset($_POST['senha'])) {

    if (strlen($_POST['nome']) == 0 || strlen($_POST['senha']) == 0) {
        echo '<script>document.getElementById("geral-erro").textContent = "Preencha seus dados corretamente";</script>';
    } else {

        $nome = $mysqli->real_escape_string($_POST['nome']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE nome = '$nome' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: home.php");
        } else {
            echo "Falha ao logar! Nome ou senha incorretos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
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
	background-color: #000;
    background-image: url('assets/imgs/background.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
	overflow-x: hidden;
}

.container {
    width: 420px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    border-radius: 10px;
    background-color: var(--preto);
    color: var(--branco);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    text-align: center;
    font-family: var(--quicksand);
}

.logo {
        position: absolute;
        top: 0;
        left: 0;
        padding: 20px;
        width: 100px;
    }

.container h1 {
    font-size: 28px;
    margin-bottom: 20px;
}

.group {
  display: flex;
  line-height: 30px;
  align-items: center;
  position: relative;
  max-width: 100%;
}

.input {
  width: 100%;
  height: 45px;
  line-height: 30px;
  padding: 0 5rem;
  padding-left: 3rem;
  border: 2px solid transparent;
  border-radius: 10px;
  outline: none;
  background-color: var(--cinzaescuro);
  color: white;
  text-transform: uppercase;
  transition: .5s ease;
}

.input::placeholder {
  color: var(--branco);
}

.input:focus, input:hover {
  outline: none;
  border-color: rgba(52, 152, 219);
  background-color: var(--cinzaescuro);
  box-shadow: 0 0 0 5px rgb(127 196 232 / 30%);
}

.icon {
  position: absolute;
  left: 1rem;
  fill: none;
  width: 1rem;
  height: 1rem;
}

button {
    background-color: var(--azulceleste);
    border: none;
    padding: 15px;
    width: 100%;
    border-radius: 5px;
    color: var(--branco);
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: var(--azulcelesteclaro);
}

.mensagem-erro {
  color: var(--azulescuroclaro);
  position: absolute;
  font-weight: bold;
  margin-top: 10px;
  font-size: 11px;
}

@media screen and (max-width: 768px) {
    .container {
        width: 80%;
    }
}

    </style>
</head>
<body>
    <form action="" method="POST">
        <div class="container">
            <img src="assets/imgs/logo.png" alt="Logo da Empresa" class="logo">
            <h1>LOGIN</h1>
            <br><br>
            <div class="group">
            <input class="input" type="text" name="nome" placeholder="NOME">
            <i class="fa-solid fa-user icon"></i>
            </div>
            <br>
            <div class="group">
            <input class="input" type="password" name="senha" placeholder="SENHA">
            <i class="fa-solid fa-lock icon"></i>
            </div>
                <div class="erro" id="senha-erro"></div>
                    <?php if (isset($_POST['nome']) && isset($_POST['senha']) && (strlen($_POST['nome']) == 0 || strlen($_POST['senha']) == 0)): ?>
                        <div class="mensagem-erro">Preencha seus dados corretamente</div>
                    <?php endif; ?>
            <br><br>
            <button>ENTRAR</button>
        </div>
    </form>
</body>
</html>
