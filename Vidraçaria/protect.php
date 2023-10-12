<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    echo "
    <!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>Página Restrita</title>
        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css\">
        <link href='https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Quicksand:wght@600&display=swap' rel='stylesheet'>
        <style>
            :root {
                --quicksand: 'Quicksand', sans-serif;
                --bebas: 'Bebas Neue', sans-serif;
                
                --preto: #000000;
                --cinzaescuro: #333333;
                --dark-grey: #AAAAAA;
                --branco: #fff;
                --red: #DB504A;
                --azulclaro: #3498db;
                --azulclaroclaro: #7fc4e8;
                
                /* Outras variáveis de cor aqui */
            }

            /* Restante do seu CSS aqui */
            
            /* Seção de login */
            body {
              font-family: var(--quicksand), sans-serif;
              background-color: #000;
              background-image: url('assets/imgs/background.jpg');
              background-size: cover;
              background-repeat: no-repeat;
              background-attachment: fixed;
              overflow-x: hidden;
              margin: 0;
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
          }

          .container {
              position: relative;
              padding: 15px;
              background-color: var(--preto);
              border-radius: 10px;
              box-shadow: 5px 5px 8px rgba(0, 0, 0, 0.336);
              max-width: 300px;
              color: var(--branco);
          }

          .icon {
              position: absolute;
              top: 15px;
              right: 15px;
              font-size: 24px;
              color: var(--branco);
          }

          .logo {
              position: absolute;
              top: 15px;
              left: 15px;
              width: 60px;
              height: auto;
          }

          .container p {
              margin-top: 30px; /* Ajustar esta margem para dar espaço abaixo da logo */
          }

          .container a {
              display: inline-block;
              margin-top: 10px;
              padding: 8px 20px;
              background-color: var(--azulclaro);
              color: var(--branco);
              border-radius: 5px;
              text-decoration: none;
              font-weight: bold;
              transition: background-color 0.3s ease;
          }

          .container a:hover {
              background-color: var(--azulclaroclaro);
          }

        </style>
    </head>
    <body>
        <div class=\"container\">
            <div class=\"icon\">
                <i class=\"fas fa-lock\"></i>
            </div>
            <img src=\"assets/imgs/logo.png\" alt=\"Logo\" class=\"logo\">
            <br><br>
            <p>Ops! Parece que esta página é restrita apenas a funcionários autorizados. Pedimos desculpas, mas o acesso é limitado a membros da equipe que possuem as atribuições específicas.</p>
            <p>Por favor, faça o login para acessar o sistema. Se você é um funcionário, certifique-se de inserir suas credenciais corretas para continuar.</p>
            <p><a href=\"login.php\">Entrar</a></p>
        </div>
    </body>
    </html>";
    exit;
}
?>
<!-- O restante do seu código continua aqui -->
