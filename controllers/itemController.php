<?php
session_start();
require_once("../config.php");
require_once(BASE_URL . "/models/Contact.php");
require_once(BASE_URL . "/models/ContactService.php");
require_once(BASE_URL . "/conecta.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['remove'] != 'remove') {
	$id = $_POST["id"];
	$name = $_POST["name"];
	$laboratory =  $_POST["laboratory"];
	$date = $_POST["data"];
	$date_sql = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
	$pickupDate = $_POST["pickupDate"];
	$pickupDate_sql = date('Y-m-d', strtotime(str_replace('/', '-', $pickupDate)));
	$quantity =  $_POST["quantity"];
	$reagent =  $_POST["reagent"];
	$residueGroup =  $_POST["residueGroup"];

	$contact = new Contact();

	$contact->setId($id);
	$contact->setName($name);
	$contact->setLaboratory($laboratory);
	$contact->setDate($date_sql);
	$contact->setPickupDate($pickupDate_sql);
	$contact->setQuantity($quantity);
	$contact->setReagent($reagent);
	$contact->setResidueGroup($residueGroup);

	$contactService = new ContactService($conn);


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
		$_SESSION['operation_result'] = 'insert';
		header('Location:../index.php');
	} else {
		$_SESSION['operation_result'] = 'edit';
		header('Location:../index.php');
	}
} else {
    $contactService = new ContactService($conn);
    $id = $_POST['id'];
    
    if ($contactService->removeItem($id)) {
        http_response_code(200); 
    } else {
        http_response_code(500); 
    }
}