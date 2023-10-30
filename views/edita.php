<?php
require_once("../config.php");
require_once BASE_URL . "/conecta.php";
require_once BASE_URL . "/template/base.php";
require_once BASE_URL . "/models/Contact.php";
require_once BASE_URL . "/models/ContactService.php";

$contact = new Contact();

$item = $contact->getById($conn, $_GET['id']);

if($item == null): ?>
	<h1>Registro não encontrado</h1>
<?php else: ?>
<body>
	<div id="quadrado" class="animate__animated animate__zoomIn">
		<h1>Editar dados</h1>
		<form id="formulario" action="../controllers/itemController.php<?= (isset($_GET['id']) && $_GET['id'] != null) ? '?flag=edit' : '?flag=insert'; ?>" method="POST" onsubmit="return validaEdicao()">
			<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
			<label for="name">Nome:</label>
			<input type="text" id="name" name="name" value="<?= $item->getName() ?>">
			<label for="laboratory">Laboratório:</label>
			<input type="text" id="laboratory" name="laboratory" value="<?= $item->getLaboratory() ?>">
			<label for="data">Data:</label>
			<input type="date" id="data" name="data" value="<?= $item->getDate() ?>">
			<label for="quantity">Quantidade:</label>
			<input type="number" id="quantity" name="quantity" value="<?= $item->getQuantity() ?>" min="0" required>
			<label for="reagent">Reagente:</label>
			<input type="text" id="reagent" name="reagent" value="<?= $item->getReagent() ?>">
			<input type="submit" value="Salvar">
			<a id="cancelar" href="../index.php">Cancelar</a>
		</form>
	</div>

<?php endif; ?>