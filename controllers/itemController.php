<?php
session_start();
require_once("../config.php");
require_once(BASE_URL . "/models/item.php");
require_once(BASE_URL . "/models/ItemService.php");
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
	if (empty($_POST["pickupDate"]) || !isset($_POST["pickupDate"])) {
		$pickupDate_sql = null;
	} else {
		$pickupDate = $_POST["pickupDate"];
		$pickupDate_sql = date('Y-m-d', strtotime(str_replace('/', '-', $pickupDate)));
	}

	$item = new StockItem();

	$item->setId($id);
	$item->setName($name);
	$item->setItemName($itemName);
	$item->setLaboratory($laboratory);
	$item->setDate($date_sql);
	$item->setPickupDate($pickupDate_sql);
	$item->setQuantity($quantity);
	$item->setReagent($reagent);
	$item->setResidueGroup($residueGroup);
	$item->setDescription($description);

	$itemService = new ItemService($conn);

	if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
		$uploadDir = '../images/itemImage/';
		$imagePath = $uploadDir . basename($_FILES['image']['name']);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
			$item->setImagePath($imagePath);
			$itemService->updateImagePath($item->getId(), $imagePath);
		} else {
			echo 'Erro ao mover o arquivo.';
		}
	} else {
		$existingItem = $item->getById($conn, $item->getId());
		if (!empty($existingItem)) {
			$item->setImagePath($existingItem->getImagePath());
		}
	}


	$action = (isset($_GET['flag']) && $_GET['flag'] != '') ? $_GET['flag'] : '';

	$success = false;

	if ($action == 'insert') {
		$itemService->insertContacts($item);
		$success = true;
	} else {
		$itemService->updateContacts($item);
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
	$itemService = new ItemService($conn);
	$id = $_POST['id'];

	if ($itemService->removeItem($id)) {
		http_response_code(200);
	} else {
		http_response_code(500);
	}
}
