<?php
require_once("../models/Contact.php");
require_once("../models/ContactService.php");
require_once("../conecta.php");



if ($_SERVER['REQUEST_METHOD'] == "POST") {
$name = $_POST["name"];
$laboratory =  $_POST["laboratory"];
$date = $_POST["data"];
$quantity =  $_POST["quantity"];
$reagent =  $_POST["reagent"];

$contact = new Contact();

$contact->setName($name);
$contact->setLaboratory($laboratory);
$contact->setDate($date);
$contact->setQuantity($quantity);
$contact->setReagent($reagent);

$contactService = new ContactService($conn);


$action = isset($_GET['flag']) ? $_GET['flag'] : '';

if($action == 'insert') { 
	$contactService->insertContacts($contact);
	$success = true;
} else {
	$contactService->updateContacts($contact);
	$sucess = false;
}

header('Loction: ../index.php');

//TOAST
if ($success) {
	echo '<script>
		Swal.fire("Sucesso", "Inserção concluída com sucesso!", "success")
			.then(function() {
				window.location.href = "../index.php";
			});
	</script>';
} else {
	echo '<script>
		Swal.fire("Erro", "Ocorreu um erro durante a inserção", "error");
	</script>';
}

}
