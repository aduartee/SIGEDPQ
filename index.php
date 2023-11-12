<?php
session_start();
require_once "models/Contact.php";
require_once "models/ContactService.php";
require_once "conecta.php";
$contactService = new ContactService($conn);
$contacts = $contactService->getAllContacts();
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
		<button class="btn btn-primary" onclick="window.location.href = 'views/edita.php?action=insert'">Insira os dados<i class="fa-solid fa-plus ms-2"></i></button>
		<!-- Adicione outros botões de ação conforme necessário -->
	</div>
	<div class="container-table">
		<table class="table">
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
					<th class="text-center">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($contacts as $contact) :  ?>
					<tr class="color-change " data-id="<?= $contact->getId(); ?>">
						<td class="text-center"><?= $contact->getId(); ?></td>
						<td class="text-center"><?= $contact->getItemName(); ?></td>
						<td class="text-center"><?= $contact->getName(); ?></td>
						<td class="text-center"><?= $contact->getLaboratory(); ?></td>
						<td class="text-center"><?= $contactService->formatData($contact->getDate()); ?></td>
						<td class="text-center"><?= $contactService->formatData($contact->getPickupDate()); ?></td>
						<td class="text-center"><?= $contact->getQuantity(); ?></td>
						<td class="text-center"><?= $contact->getReagent(); ?></td>
						<td class="text-center"><?= $contactService->filterResidueGroup($contact->getResidueGroup()) ?></td>
						<td>
							<button onclick="window.location.href='views/edita.php?id=<?= $contact->getId(); ?>'" class="btn btn-primary btnEdit">Editar<i class="fa-solid fa-pen-to-square ms-2"></i></button>
							<button class="btn btn-danger btnEdit ms-4" data-toggle="modal" onclick="removeItem(<?= $contact->getId() ?>)">Remover<i class="fa-solid fa-trash-can ms-2"></i></button>
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
	if (isset($_SESSION['operation_result'])) { ?>
		var result = "<?= $_SESSION['operation_result']; ?>";
		if (result === 'insert') {
			Swal.fire("Sucesso", "Inserção concluída com sucesso!", "success");
		} else if (result === 'edit') {
			Swal.fire("Sucesso", "Edição concluída com sucesso!", "success");
		}
		delete $_SESSION['operation_result'];
	<?php } ?>
</script>
</body>