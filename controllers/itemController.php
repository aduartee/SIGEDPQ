<?php
session_start();
require_once("../config.php");
require_once(BASE_URL . "/models/Contact.php");
require_once(BASE_URL . "/models/ContactService.php");
require_once(BASE_URL . "/conecta.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_GET['flag'] == 'edit' || $_GET['flag'] == 'insert') {
	$id = $_POST["id"];
	$name = $_POST["name"];
	$itemName = $_POST["itemName"];
	$laboratory =  $_POST["laboratory"];
	$date = $_POST["data"];
	$date_sql = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
	$quantity =  $_POST["quantity"];
	$reagent =  $_POST["reagent"];
	$residueGroup =  $_POST["residueGroup"];
	$description = $_POST["description"];
	if (empty($_POST["pickupDate"])) {
		$pickupDate_sql = null;
	} else {
		$pickupDate = $_POST["pickupDate"];
		$pickupDate_sql = date('Y-m-d', strtotime(str_replace('/', '-', $pickupDate)));
	}

	$contact = new Contact();

	$contact->setId($id);
	$contact->setName($name);
	$contact->setItemName($itemName);
	$contact->setLaboratory($laboratory);
	$contact->setDate($date_sql);
	$contact->setPickupDate($pickupDate_sql);
	$contact->setQuantity($quantity);
	$contact->setReagent($reagent);
	$contact->setResidueGroup($residueGroup);
	$contact->setDescription($description);

	$contactService = new ContactService($conn);

	if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
		$uploadDir = '../images/itemImage/';
		$imagePath = $uploadDir . basename($_FILES['image']['name']);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
			$contact->setImagePath($imagePath);
			$contactService->updateImagePath($contact->getId(), $imagePath);
		} else {
			echo 'Erro ao mover o arquivo.';
		}
	} else {
		$existingItem = $contact->getById($conn, $contact->getId());
		if (!empty($existingItem)) {
			$contact->setImagePath($existingItem->getImagePath());
		}
	}


	$action = (isset($_GET['flag']) && $_GET['flag'] != '') ? $_GET['flag'] : '';

	$success = false;

	if ($action == 'insert') {
		$contactService->insertContacts($contact);
		$success = true;
	} else {
		$contactService->updateContacts($contact);
		$success = false;
	}

	//TOAST
	if ($success) {
		header('Location:../index.php?msg=insert');
	} else {
		header('Location:../index.php?msg=edit');
	}
} else {
	echo "Entrou no else do error";
	$contactService = new ContactService($conn);
	$id = $_POST['id'];

	if ($contactService->removeItem($id)) {
		http_response_code(200);
	} else {
		http_response_code(500);
	}
}
