<?php
session_start();
require_once "models/Item.php";
require_once "models/ItemService.php";
require_once "conecta.php";
$itemService = new ItemService($conn);
$itens = $itemService->getAllContacts();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="shortcut icon" href="images/favicon-32x32.png" type="image/x-icon" />
	<!-- JQUERY -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- BOOTSTRAP -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="js/removeItem.js"></script>
	<script src="js/printTable.js"></script>
	<script src="js/searchItens.js"></script>
	<!-- BOXICONS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- TOAST -->
	<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.all.min.js "></script>
	<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.min.css " rel="stylesheet">
	<title>SIGEDPQ</title>
</head>

<body>
	<div class="container">
		<div class="image-container">
			<img src="images/quimica.jpg" alt="Descrição da imagem" width="200" height="400">
		</div>
		<div class="text-container">
			<h1 class="main-title">SISTEMA INFORMATIZADO<br>PARA GESTÃO DE ESTOQUE E DESCARTE<br>DE PRODUTOS QUÍMICOS</h1>
		</div>
	</div>

	<div class="action-bar">
		<div class="input-group ms-4">
			<input type="text" class="search-bar form-control" id="search" placeholder="Pesquisar por nome do item">
			<div class="input-group-append">
				<span class="input-group-text bg-transparent border-0">
					<i class="fas fa-search mt-1"></i>
				</span>
			</div>
		</div>

		<button class="print-btn btn btn-primary me-4" onclick="window.location.href = 'views/formItem.php?action=insert'">Insira os dados<i class="fa-solid fa-plus ms-2"></i></button>
		<button class="print-btn btn btn-primary me-2" onclick="printTable()">Imprimir<i class="fa-solid fa-print ms-2"></i></button>
	</div>
	<div class="container-table mt-5">
		<table class="table print-table" id="returnTable">
			<thead>
				<tr>
					<th class="text-center">Numero de controle</th>
					<th class="text-center">Nome do item</th>
					<th class="text-center">Nome do responsável</th>
					<th class="text-center">Laboratório</th>
					<th class="text-center">Data</th>
					<th class="text-center">Data da coleta</th>
					<th class="text-center">Quantidade</th>
					<th class="text-center">Reagente</th>
					<th class="text-center">Grupo do residuo</th>
					<th class="text-center actions-print">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($itens as $item) :  ?>
					<tr class="color-change " data-id="<?= $item->getId(); ?>">
						<td class="text-center"><?= $item->getId(); ?></td>
						<td class="text-center"><?= $item->getItemName(); ?></td>
						<td class="text-center"><?= $item->getName(); ?></td>
						<td class="text-center"><?= $itemService->filterLaboratory($item->getLaboratory()); ?></td>
						<td class="text-center"><?= $itemService->formatData($item->getDate()); ?></td>
						<td class="text-center"><?= (isset($item) && !empty($item->getPickupDate())) ? $itemService->formatData($item->getPickupDate()) : 'Não registrado'; ?></td>
						<td class="text-center"><?= $item->getQuantity(); ?></td>
						<td class="text-center"><?= $item->getReagent(); ?></td>
						<td class="text-center"><?= $itemService->filterResidueGroup($item->getResidueGroup()) ?></td>
						<td>
							<button onclick="window.location.href='views/formItem.php?id=<?= $item->getId(); ?>'" class="btn btn-primary btnEdit">Editar<i class="fa-solid fa-pen-to-square ms-2"></i></button>
							<button class="btn btn-danger btnEdit ms-4" data-toggle="modal" onclick="removeItem(<?= $item->getId() ?>)">Remover<i class="fa-solid fa-trash-can ms-2"></i></button>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	</table>

</html>
<script src="js/teste.js"></script>
<script>
	<?php
	if (isset($_GET['msg'])) { ?>
		var result = "<?= $_GET['msg'] ?>";
		if (result === 'insert') {
			Swal.fire("Sucesso", "Inserção concluída com sucesso!", "success");
		} else if (result === 'edit') {
			Swal.fire("Sucesso", "Edição concluída com sucesso!", "success");
		}
	<?php } ?>
</script>
</body>