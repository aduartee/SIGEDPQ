<?php
require_once "../conecta.php";
require_once "../template/base.php";
require_once "../models/Contact.php";
require_once "../models/ContactService.php";

print_r($_GET);
$contact = new Contact();
$id_item = $_GET['id'];
$contact->getById($conn, $id_item);
?>

<body>
	<div id="quadrado" class="animate__animated animate__zoomIn">
		<h1>Editar dados</h1>
		<form id="formulario" action="atualiza.php" method="POST" onsubmit="return validaEdicao()">
			<input type="hidden" name="id" value="<?= (isset($contact->name) ? $contact->id : "") ?>">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" value="<?= (isset($contact->name) ? $contact->name : "") ?>" required>
			<label for="email">Laboratório:</label>
			<input type="text" id="laboratory" name="laboratory" value="<?php echo $row['email']; ?>" required> 
			<label for="telefone">Telefone:</label>
			<input type="text" id="telefone" name="telefone" value="<?php echo $row['telefone']; ?>" required> 
			<label for="cor_preferida">Cor Preferida:</label></br>
			<input type="checkbox" id="cor_preferida1" name="cor_preferida[]" value="vermelho" <?php if (strpos($row['cor_preferida'], 'vermelho') !== false) echo 'checked'; ?>> 
			<label for="cor_preferida3">Vermelho</label>
			<input type="checkbox" id="cor_preferida2" name="cor_preferida[]" value="azul" <?php if (strpos($row['cor_preferida'], 'azul') !== false) echo 'checked'; ?>> <!-- pega a variavel que armazena a cor, e com a função "strpos" procura a string azul,
																																													caso o azul não seja encontrado, é retornado um false. Se o resultado da função for
																																													diferente de false quer dizer que a string vermelho foi encontrada, logo a caixa do checkbox
																																													já é inicializada marcada -->
			<label for="cor_preferida2">Azul</label>
			<input type="checkbox" id="cor_preferida3" name="cor_preferida[]" value="verde" <?php if (strpos($row['cor_preferida'], 'verde') !== false) echo 'checked'; ?>> <!-- pega a variavel que armazena a cor, e com a função "strpos" procura a string verde,
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