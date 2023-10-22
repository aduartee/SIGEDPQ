<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/edita.css"> 
	<link rel="shortcut icon" href="imagens/favicon_crud.png" type="image/x-icon"/>
    <title>Crud Arthur</title>
</head>
<body>
	<?php
		include 'conecta.php';
		include 'base.php';

        //valor do Id que foi capturado por meio do "$_GET" está sendo jogado para uma variavel, isso indica qual registro deve ser excluido
		$id = $_GET['id'];

        //Faz um select de todos os elementos da tabela pessoa que o id seja igual ao id que foi passado acima
		$query = $conn->query("SELECT * FROM pessoas WHERE id='$id'");
        //Atribui para dentro da variavel uma linha da tabela em forma de array
		$row = $query->fetch_assoc();
	?>

	<div id="quadrado" class="animate__animated animate__zoomIn"> 
		<h1>Editar Tabela</h1>
		<form id="formulario" action="atualiza.php" method="POST" onsubmit="return validaEdicao()">
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- Cria um input do tipo escondido para armazenar o Id do campo que está sendo editado -->
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required> <!--  Cria um input para realizar a troca do nome-->
			<br><br>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required> <!--  Cria um input para realizar a troca do email-->
			<br><br>
			<label for="telefone">Telefone:</label>
			<input type="text" id="telefone" name="telefone" value="<?php echo $row['telefone']; ?>" required> <!--  Cria um input para realizar a troca do telefone-->
			<br><br>
			<label for="esporte_preferido">Esporte Preferido:</label>
			<select id="esporte_preferido" name="esporte_preferido" required> <!--  Cria um input para realizar a troca do esporte preferido-->
				<option value="">Selecione uma opção</option>
				<option value="futebol" <?php if($row['esporte_preferido'] == 'futebol') echo 'selected'; ?>>Futebol</option> Futebol</option> <!-- Caso o esporte preferido seja futebol irá mostrar para edição o campo futebol -->
				<option value="volei" <?php if($row['esporte_preferido'] == 'volei') echo 'selected'; ?>>Vôlei</option> <!-- Caso o esporte preferido seja volei irá mostrar para edição o campo volei -->
				<option value="basquete" <?php if($row['esporte_preferido'] == 'basquete') echo 'selected'; ?>>Basquete</option> <!-- Caso o esporte preferido seja basquete irá mostrar para edição o campo basquete -->
				<option value="natacao" <?php if($row['esporte_preferido'] == 'natacao') echo 'selected'; ?>>Natação</option> <!-- Caso o esporte preferido seja natação irá mostrar para edição o campo natação -->
			</select>
			<br><br>
			<label for="cor_preferida">Cor Preferida:</label></br>
			<input type="checkbox" id="cor_preferida1" name="cor_preferida[]" value="vermelho" <?php if(strpos($row['cor_preferida'], 'vermelho') !== false) echo 'checked'; ?>> <!-- pega a variavel que armazena a cor, e com a função "strpos" procura a string vermelho,
																																													caso o vemelho não seja encontrado, é retornado um false. Se o resultado da função for
																																													diferente de false quer dizer que a string vermelho foi encontrada, logo a caixa do checkbox
																																													já é inicializada marcada -->
			<label for="cor_preferida3">Vermelho</label>
			<input type="checkbox" id="cor_preferida2" name="cor_preferida[]" value="azul" <?php if(strpos($row['cor_preferida'], 'azul') !== false) echo 'checked'; ?>> <!-- pega a variavel que armazena a cor, e com a função "strpos" procura a string azul,
																																													caso o azul não seja encontrado, é retornado um false. Se o resultado da função for
																																													diferente de false quer dizer que a string vermelho foi encontrada, logo a caixa do checkbox
																																													já é inicializada marcada -->
			<label for="cor_preferida2">Azul</label>
			<input type="checkbox" id="cor_preferida3" name="cor_preferida[]" value="verde" <?php if(strpos($row['cor_preferida'], 'verde') !== false) echo 'checked'; ?>> <!-- pega a variavel que armazena a cor, e com a função "strpos" procura a string verde,
																																													caso o verde não seja encontrado, é retornado um false. Se o resultado da função for
																																													diferente de false quer dizer que a string vermelho foi encontrada, logo a caixa do checkbox
																																													já é inicializada marcada -->
			<label for="cor_preferida3">Verde</label>
			<br><br>
			
			<input type="submit" value="Salvar">
			<a id="cancelar" href="index.php">Cancelar</a>

		</form>
	</div>
	<footer> 
		<script src="js/validaEdicao.js"></script>
	</footer>
</body>
</html>