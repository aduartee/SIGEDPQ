<?php
require_once("../config.php");
require_once BASE_URL . "/conecta.php";
require_once BASE_URL . "/template/base.php";
require_once BASE_URL . "/models/Contact.php";
require_once BASE_URL . "/models/ContactService.php";

$contact = new Contact();

if (isset($_GET['id'])) $contact->getById($conn, $_GET['id']);
?>

<body>
	<div id="quadrado" class="animate__animated animate__zoomIn">
		<h1>Editar dados</h1>
		<form id="formulario" action="../controllers/itemController.php<?= isset($contact->id) ? '?flag=edit' : '?flag=insert'; ?>" method="POST" onsubmit="return validaEdicao()">
			<input type="hidden" name="id" value="<?= $contact->getId(); ?>">
			<label for="name">Nome:</label>
			<input type="text" id="name" name="name" value="<?= $contact->getName() ?>" required>
			<label for="laboratory">Laboratório:</label>
			<input type="text" id="laboratory" name="laboratory" value="<?= $contact->getLaboratory() ?>" required>
			<label for="data">Data:</label>
			<input type="date" id="data" name="data" value="<?= $contact->getDate() ?>" required>
			<label for="quantity">Quantidade:</label>
			<input type="number" id="quantity" name="quantity" value="<?= $contact->getQuantity() ?>" required>
			<label for="reagent">Reagente:</label>
			<input type="text" id="reagent" name="reagent" value="<?= $contact->getReagent() ?>" required>
			<input type="submit" value="Salvar">
			<a id="cancelar" href="../index.php">Cancelar</a>
		</form>
	</div>