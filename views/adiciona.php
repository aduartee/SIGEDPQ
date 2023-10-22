<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/adiciona.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="shortcut icon" href="imagens/favicon_crud.png" type="image/x-icon" />
    <title>Crud Arthur</title>
</head>
<body>
    <?php
        include 'base.php';
    ?>
    <div id="quadrado" class="animate__animated animate__zoomIn"> 
        <h2 id="titulo"> Adicionando usuários </h2>
        <form id="formulario" method="POST" action="salvar.php" onsubmit="return validaFormulario()">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="ex: João" required>
                <br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
                <br><br>
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" placeholder="ex: DD98989828" required>
                <br><br>

                <label for="esporte_preferido">Esporte Preferido:</label>
                <select id="esporte_preferido" name="esporte_preferido" required>
                    <option value="">Escolha uma opção</option>
                    <option value="futebol">Futebol</option>
                    <option value="volei">Vôlei</option>
                    <option value="basquete">Basquete</option>
                    <option value="natacao">Natação</option>
                </select>
                <br><br>

                <label for="cor_preferida">Cor Preferida:</label></br>
                <input type="checkbox" id="cor_preferida1" name="cor_preferida[]" value="vermelho">
                <label for="cor_preferida1">Vermelho</label>
                <input type="checkbox" id="cor_preferida2" name="cor_preferida[]" value="azul">
                <label for="cor_preferida2">Azul</label>
                <input type="checkbox" id="cor_preferida3" name="cor_preferida[]" value="verde">
                <label for="cor_preferida3">Verde</label></br></br>
                
                <input type="submit" value="Inserir">
    </div>
    </form>
<footer>
    <script src="js/validaFormulario.js"></script>
</footer>
</body>
</html>