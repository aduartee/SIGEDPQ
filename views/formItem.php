<?php
require_once("../config.php");
require_once BASE_URL . "/conecta.php";
require_once BASE_URL . "/template/base.php";
require_once BASE_URL . "/models/Item.php";
require_once BASE_URL . "/models/ItemService.php";

$itemService = new ItemService(SUPABASE_URL, SUPABASE_KEY);

$item = (isset($_GET['id']) && $_GET['id'] != '') ? $itemService->getItemById($_GET['id']) : '';

if ($item == null && $_GET['action'] != "insert") : ?>
	<h1>Registro não encontrado</h1>
<?php else : ?>

	<body>
		<div class="container">
			<div id="quadrado" class="animate__animated animate__zoomIn">
				<h1><?= isset($_GET['action']) && $_GET['action'] == 'insert' ? 'Inserir dados' : 'Editar Dados' ?></h1>
				<div class="item-info">
					<div class="item-image">
						<h2><?= (!empty($item)) && !empty($item->getItemName()) ? $item->getItemName() : ''; ?></h2>
						<div class="<?= (!empty($item)) && !empty($item->getItemName()) ? 'line' : ''; ?>"></div>
						<img src="<?= !(empty($item)) && !(empty($item->getImagePath())) ? $item->getImagePath() : ''; ?>" alt="<?= !empty($item) && !empty($item->getItemName()) ? $item->getItemName() : '' ?>" class="img-fluid">
						<p id="description-info"></p>
					</div>

					<div class="item-description">
						<form id="formulario" action="../controllers/itemController.php<?= (isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] != '') ? '?flag=edit' : '?flag=insert'; ?>" method="POST"changeDescription.js enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>">
							<div class="large-group">
								<div class="form-group">
									<label for="itemName">Nome do item:</label>
									<input type="text" id="itemName" name="itemName" class="form-control" required value="<?= (!empty($item) && !empty($item->getItemName())) ? $item->getItemName() : ''; ?>">
								</div>
								<div class="form-group">
									<label for="name">Localização:</label>
									<input type="text" id="name" name="name" class="form-control" required value="<?= (!empty($item) && !empty($item->getLocation())) ? $item->getLocation() : ''; ?>">
								</div>
								<div class="form-group">
									<label for="description">Descrição do item:</label>
									<textarea id="description" name="description" class="form-control" rows="2"><?= (!empty($item) && !empty($item->getDescription())) ? $item->getDescription() : ''; ?></textarea>
								</div>
								<div class="form-group">
									<label for="laboratory">Laboratório:</label>
									<select name="laboratory" id="laboratory" class="form-control" required>
										<option value="lab1" <?= (!empty($item) && $item->getLaboratory() == "lab1" ? "selected" : '') ?>>Laboratório 1 (Processos Industriais)</option>
										<option value="lab2" <?= (!empty($item) && $item->getLaboratory() == "lab2" ? "selected" : '') ?>>Laboratório 2 (Química Inorgânica)</option>
										<option value="lab3" <?= (!empty($item) && $item->getLaboratory() == "lab3" ? "selected" : '') ?>>Laboratório 3 (Química Analítica e Orgânica)</option>
										<option value="lab4" <?= (!empty($item) && $item->getLaboratory() == "lab4" ? "selected" : '') ?>>Laboratório 4 (Processos Industriais)</option>
										<option value="lab5" <?= (!empty($item) && $item->getLaboratory() == "lab5" ? "selected" : '') ?>>Laboratório de Espectrofotometria</option>
										<option value="lab6" <?= (!empty($item) && $item->getLaboratory() == "lab6" ? "selected" : '') ?>>Laboratório de Potenciometria</option>
										<option value="lab7" <?= (!empty($item) && $item->getLaboratory() == "lab7" ? "selected" : '') ?>>Laboratório de Cromatografia</option>
										<option value="lab8" <?= (!empty($item) && $item->getLaboratory() == "lab8" ? "selected" : '') ?>>Laboratório de Microbiologia</option>
										<option value="lab9" <?= (!empty($item) && $item->getLaboratory() == "lab9" ? "selected" : '') ?>>Laboratório de Polímeros</option>
										<option value="lab10" <?= (!empty($item) && $item->getLaboratory() == "lab10" ? "selected" : '') ?>>Laboratório de Pesquisa</option>
										<option value="lab11" <?= (!empty($item) && $item->getLaboratory() == "lab11" ? "selected" : '') ?>>Laboratório de Preparo</option>
										<option value="salaCoor" <?= (!empty($item) && $item->getLaboratory() == "salaCoor" ? "selected" : '') ?>>Sala de Coordenação</option>
										<option value="sala101" <?= (!empty($item) && $item->getLaboratory() == "sala101" ? "selected" : '') ?>>Sala de Aula – 101</option>
										<option value="sala101A" <?= (!empty($item) && $item->getLaboratory() == "sala101A" ? "selected" : '') ?>>Sala de Professores – 101A</option>
										<option value="sala102" <?= (!empty($item) && $item->getLaboratory() == "sala102" ? "selected" : '') ?>>Sala de Professores – 102</option>
										<option value="sala104" <?= (!empty($item) && $item->getLaboratory() == "sala104" ? "selected" : '') ?>>Sala de Aula – 104</option>
										<option value="sala111" <?= (!empty($item) && $item->getLaboratory() == "sala111" ? "selected" : '') ?>>Sala de Aula – 111</option>
									</select>
								</div>
								<div class="form-group">
									<label for="image">Escolha uma imagem:</label>
									<input type="file" class="form-control" id="image" name="image" accept="image/*">
								</div>
								<div class="form-group">
									<label for="residueGroup">Grupo do resíduo:</label>
									<select name="residueGroup" id="residueGroup" class="form-control" required>
										<option value="soh" <?= (!empty($item) && $item->getResidueGroup() == "soh" ? "selected" : '') ?>>SOH (Solvente Orgânico Halogenado)</option>
										<option value="sonh" <?= (!empty($item) && $item->getResidueGroup() == "sonh" ? "selected" : '') ?>>SOñH (Solvente Orgânico Não Halogenado)</option>
										<option value="sopp" <?= (!empty($item) && $item->getResidueGroup() == "sopp" ? "selected" : '') ?>>SOPP (Solvente Orgânico Passível de Purificação)</option>
										<option value="aquaso" <?= (!empty($item) && $item->getResidueGroup() == "aquaso" ? "selected" : '') ?>>Aquoso sem cromo e sem cianeto</option>
										<option value="aquosocromo" <?= (!empty($item) && $item->getResidueGroup() == "aquosocromo" ? "selected" : '') ?>>Aquoso com cromo</option>
										<option value="aquosocianeto" <?= (!empty($item) && $item->getResidueGroup() == "aquosocianeto" ? "selected" : '') ?>>Aquoso com cianeto</option>
										<option value="solido" <?= (!empty($item) && $item->getResidueGroup() == "solido" ? "selected" : '') ?>>Sólido</option>
									</select>
								</div>
							</div>
							<div class="d-flex flex-row">
								<div class="form-group space-items small-group data1">
									<label for="data">Criado Em:</label>
									<input type="text" id="data" name="data" class="form-control" required value="<?= !empty($item) && !empty($item->getDate()) ? date('d/m/Y', strtotime($item->getDate())) : date('d/m/Y') ?>">
								</div>
							</div>
							<input type="submit" class="btn btn-success" value="Salvar">
							<a id="cancelar" href="../index.php" class="btn btn-secondary">Cancelar</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		</form>
	<?php endif; ?>
	<script src="../js/changeDescription.js"></script>
	<script src="../js/datepicker.js"></script>