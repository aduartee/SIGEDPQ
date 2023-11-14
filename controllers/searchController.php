<?php
session_start();
require_once("../config.php");
require_once(BASE_URL . "/models/Contact.php");
require_once(BASE_URL . "/models/ContactService.php");
require_once(BASE_URL . "/conecta.php");


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['itemName'])) {
    $searchValue = $_POST['itemName'];

    $contactService = new ContactService($conn);
    $searchResults = $contactService->searchContacts($searchValue);

    header('Content-Type: application/json');
    echo json_encode($searchResults);
    exit;
}
