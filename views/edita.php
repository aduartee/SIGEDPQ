<?php
require_once("../config.php");
require_once BASE_URL . "/conecta.php";
require_once BASE_URL . "/template/base.php";
require_once BASE_URL . "/models/Contact.php";
require_once BASE_URL . "/models/ContactService.php";

$contact = new Contact();

$item = (isset($_GET['id']) && $_GET['id'] != '') ? $contact->getById($conn, $_GET['id']) : '';

if ($item == null && $_GET['action'] != "insert") : ?>
	<h1>Registro não encontrado</h1>
<?php else : ?>

	<body>
		<div id="quadrado" class="animate__animated animate__zoomIn">
			<h1>Editar dados</h1>
			<form id="formulario" action="../controllers/itemController.php<?= (isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] != '') ? '?flag=edit' : '?flag=insert'; ?>" method="POST" onsubmit="return validaEdicao()">
				<input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>">
				<label for="name">Nome do responsável:</label>
				<input type="text" id="name" name="name" required value="<?= (!empty($item) && !empty($item->getName())) ? $item->getName() : ''; ?>">
				<label for="laboratory">Laboratório:</label>
				<input type="text" id="laboratory" name="laboratory" required value="<?= (!empty($item) && !empty($item->getLaboratory())) ? $item->getLaboratory()  : ''; ?>">
				<label for="data">Data:</label>
				<input type="text" id="data" name="data" required value="<?= !empty($item) && !empty($item->getDate()) ? date('d/m/Y', strtotime($item->getDate())) : date('d/m/Y') ?>">
				<label for="pickupDate">Data de coleta:</label>
				<input type="text" id="pickupDate" name="pickupDate" required value="<?= !empty($item) && !empty($item->getPickupDate()) ? date('d/m/Y', strtotime($item->getPickupDate())) : '' ?>">
				<label for="quantity">Quantidade:<label>
				<input type="number" id="quantity" name="quantity" required value="<?= (!empty($item) && !empty($item->getQuantity())) ? $item->getQuantity() : ''; ?>" min="0" required>
				<label for="reagent">Reagente:</label>
				<input type="text" id="reagent" name="reagent" required value="<?= (!empty($item) && !empty($item->getReagent())) ? $item->getReagent() : '' ?>">
				<label for="residueGroup">Grupo do resíduo:</label>
				<select name="residueGroup" required id="residueGroup">
					<option value="soh" <?= (!empty($item) && $item->getResidueGroup() == "soh" ? "selected" : '') ?>>SOH (Solvente Orgânico Halogenado)</option>
					<option value="sonh" <?= (!empty($item) && $item->getResidueGroup() == "sonh" ? "selected" : '') ?>>SOñH (Solvente Orgânico Não Halogenado)</option>
					<option value="sopp" <?= (!empty($item) && $item->getResidueGroup() == "sopp" ? "selected" : '') ?>>SOPP (Solvente Orgânico Passível de Purificação)</option>
					<option value="aquaso" <?= (!empty($item) && $item->getResidueGroup() == "aquaso" ? "selected" : '') ?>>Aquoso sem cromo e sem cianeto</option>
					<option value="aquosocromo" <?= (!empty($item) && $item->getResidueGroup() == "aquosocromo" ? "selected" : '') ?>>Aquoso com cromo</option>
					<option value="aquosocianeto" <?= (!empty($item) && $item->getResidueGroup() == "aquosocianeto" ? "selected" : '') ?>>Aquoso com cianeto</option>
					<option value="solido" <?= (!empty($item) && $item->getResidueGroup() == "solido" ? "selected" : '') ?>>Sólido</option>
				</select>
				<input type="submit" value="Salvar">
				<a id="cancelar" href="../index.php">Cancelar</a>
			</form>
		</div>
	<?php endif; ?>
	<script src="../js/datepicker.js"></script>