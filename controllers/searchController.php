<?php
session_start();
require_once("../config.php");
require_once(BASE_URL . "/models/Item.php");
require_once(BASE_URL . "/models/ItemService.php");
require_once(BASE_URL . "/conecta.php");


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['itemName'])) {
    $searchValue = $_POST['itemName'];

    $itemService = new ItemService($conn);
    $searchResults = $itemService->searchContacts($searchValue);

    header('Content-Type: application/json');
    echo json_encode($searchResults);
    exit;
}
