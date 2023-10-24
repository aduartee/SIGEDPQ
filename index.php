<?php
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
	<link rel="shortcut icon" href="imagens/favicon_crud.png" type="image/x-icon" />
	<!-- JQUERY -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- BOOTSTRAP -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="js/removeItem.js"></script>
	<!-- BOXICONS -->
	<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
	<!-- TOAST -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@12/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@12/dist/sweetalert2.all.min.js"></script>
	<title>SIGEDPQ</title>
</head>

<body>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
					<button type="button" class="btn btn-primary" id="remove">Remover</button>
				</div>
			</div>
		</div>
	</div>

	<h2>SISTEMA INFORMATIZADO PARA GESTÃO DE ESTOQUE E DESCARTE DE PRODUTOS QUÍMICOS</h2>
	<button class="btn btn-primary" onclick="window.location.href = 'views/edita.php'">Insira os dados</button>
	<br><br>
	<table>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Laboratório</th>
				<th>Data</th>
				<th>Quantidade</th>
				<th>Reagente</th>
				<th>Ações</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php foreach ($contacts as $contact) :  ?>
					<td><?= $contact->getName(); ?></td>
					<td><?= $contact->getLaboratory(); ?></td>
					<td><?= $contact->getDate(); ?></td>
					<td><?= $contact->getQuantity(); ?></td>
					<td><?= $contact->getReagent(); ?></td>
					<td>
						<a href="views/edita.php?id=<?= $contact->getId(); ?>">Editar</a>
						<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="removeItem(<?= $contact->getId(); ?>)">Remover <box-icon name='trash' class="pt-1"></box-icon></button>
					</td>
				<?php endforeach; ?>
			</tr>
		</tbody>
	</table>
</body>

</html>