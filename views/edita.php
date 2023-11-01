<?php
require_once("../config.php");
require_once BASE_URL . "/conecta.php";
require_once BASE_URL . "/template/base.php";
require_once BASE_URL . "/models/Contact.php";
require_once BASE_URL . "/models/ContactService.php";

$contact = new Contact();

$item = (isset($_GET['id']) && $_GET['id'] != '') ? $contact->getById($conn, $_GET['id']) : '';

if($item == null && $_GET['action'] != "insert"): ?>
	<h1>Registro não encontrado</h1>
<?php else: ?>
<body>
	<div id="quadrado" class="animate__animated animate__zoomIn">
		<h1>Editar dados</h1>
		<form id="formulario" action="../controllers/itemController.php<?= (isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] != '') ? '?flag=edit' : '?flag=insert'; ?>" method="POST" onsubmit="return validaEdicao()">
			<input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>">
			<label for="name">Nome:</label>
			<input type="text" id="name" name="name" value="<?= (!empty($item) && !empty($item->getName())) ? $item->getName() : ''; ?>">
			<label for="laboratory">Laboratório:</label>
			<input type="text" id="laboratory" name="laboratory" value="<?= (!empty($item) && !empty($item->getLaboratory())) ? $item->getLaboratory()  : ''; ?>">
			<label for="data">Data:</label>
			<input type="date" id="data" name="data" value="<?= !empty($item) && !empty($item->getDate()) ? $item->getDate() : '' ?>">
			<label for="quantity">Quantidade:</label>
			<input type="number" id="quantity" name="quantity" value="<?= (!empty($item) && !empty($item->getQuantity())) ? $item->getQuantity() : ''; ?>" min="0" required>
			<label for="reagent">Reagente:</label>
			<input type="text" id="reagent" name="reagent" value="<?= (!empty($item) && !empty($item->getReagent())) ? $item->getReagent() : '' ?>">
			<input type="submit" value="Salvar">
			<a id="cancelar" href="../index.php">Cancelar</a>
		</form>
	</div>

<?php endif; ?>