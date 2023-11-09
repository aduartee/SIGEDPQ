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
		<div class="container">
			<div id="quadrado" class="animate__animated animate__zoomIn">
				<h1>Editar dados</h1>
				<div class="item-info">
					<div class="item-image">
						<h2 class="mb-3"><?= (!empty($item) && !empty($item->getItemName())) ? $item->getItemName() : ''; ?></h2>
						<!-- IMAGEM QUE O USARIO MANDA -->
						<img src="../images/itemExample.jpeg" alt="Item Image" class="img-fluid">
					</div>

					<div class="item-description">
					<form id="formulario" action="../controllers/itemController.php<?= (isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] != '') ? '?flag=edit' : '?flag=insert'; ?>" method="POST" onsubmit="return validaEdicao()" enctype="multipart/form-data">							<input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>">
							<div class="large-group">
								<div class="form-group">
									<label for="itemName">Nome do item:</label>
									<input type="text" id="itemName" name="itemName" class="form-control" required value="<?= (!empty($item) && !empty($item->getItemName())) ? $item->getItemName() : ''; ?>">
								</div>
								<div class="form-group">
									<label for="name">Nome do responsável:</label>
									<input type="text" id="name" name="name" class="form-control" required value="<?= (!empty($item) && !empty($item->getName())) ? $item->getName() : ''; ?>">
								</div>
								<div class="form-group">
									<label for="description">Descrição do item:</label>
									<textarea id="description" name="description" class="form-control" rows="2"><?= (!empty($item) && !empty($item->getDescription())) ? $item->getDescription() : ''; ?></textarea>
								</div>
								<div class="form-group">
									<label for="laboratory">Laboratório:</label>
									<input type="text" id="laboratory" name="laboratory" class="form-control" required value="<?= (!empty($item) && !empty($item->getLaboratory())) ? $item->getLaboratory() : ''; ?>">
								</div>
								<div class="form-group">
									<label for="image">Escolha uma imagem:</label>
									<input type="file" class="form-control" id="image" name="image" accept="image/*">
								</div>
								<div class="form-group">
									<label for="residueGroup">Grupo do resíduo:</label>
									<select name="residueGroup" id="residueGroup" class="form-control" required>
										<option value="soh" <?= (!empty($item) && $item->getResidueGroup() == "soh" ? "selected" : '') ?>>SOH (Solvente Orgânico Halogenado)
										</option>
										<option value="sonh" <?= (!empty($item) && $item->getResidueGroup() == "sonh" ? "selected" : '') ?>>SOñH (Solvente Orgânico Não Halogenado)
										</option>
										<option value="sopp" <?= (!empty($item) && $item->getResidueGroup() == "sopp" ? "selected" : '') ?>>SOPP (Solvente Orgânico Passível de Purificação)
										</option>
										<option value="aquaso" <?= (!empty($item) && $item->getResidueGroup() == "aquaso" ? "selected" : '') ?>>Aquoso sem cromo e sem cianeto
										</option>
										<option value="aquosocromo" <?= (!empty($item) && $item->getResidueGroup() == "aquosocromo" ? "selected" : '') ?>>Aquoso com cromo
										</option>
										<option value="aquosocianeto" <?= (!empty($item) && $item->getResidueGroup() == "aquosocianeto" ? "selected" : '') ?>>Aquoso com cianeto
										</option>
										<option value="solido" <?= (!empty($item) && $item->getResidueGroup() == "solido" ? "selected" : '') ?>>Sólido</option>
									</select>
								</div>
							</div>
							<div class="d-flex flex-row">
								<div class="form-group space-items small-group">
									<label for="data">Data:</label>
									<input type="text" id="data" name="data" class="form-control" required value="<?= !empty($item) && !empty($item->getDate()) ? date('d/m/Y', strtotime($item->getDate())) : date('d/m/Y') ?>">
								</div>
								<div class="form-group space-items small-group">
									<label for="pickupDate">Data de coleta:</label>
									<input type="text" id="pickupDate" name="pickupDate" class="form-control" required value="<?= !empty($item) && !empty($item->getPickupDate()) ? date('d/m/Y', strtotime($item->getPickupDate())) : '' ?>">
								</div>
								<div class="form-group space-items tiny-group">
									<label for="quantity">Quantidade:</label>
									<input type="number" id="quantity" name="quantity" class="form-control" required value="<?= (!empty($item) && !empty($item->getQuantity())) ? $item->getQuantity() : ''; ?>" min="0" required>
								</div>
								<div class="form-group space-items tiny-group">
									<label for="reagent">Reagente:</label>
									<input type="text" id="reagent" name="reagent" class="form-control" required value="<?= (!empty($item) && !empty($item->getReagent())) ? $item->getReagent() : ''; ?>">
								</div>
							</div>
							<input type="submit" class="btn btn-primary" value="Salvar">
							<a id="cancelar" href="../index.php" class="btn btn-secondary">Cancelar</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		</form>
	<?php endif; ?>
	<script src="../js/datepicker.js"></script>