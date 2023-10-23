<?php
$username = "root";
$password = "";
try {
	$conn = new PDO('mysql:host=localhost;dbname=sistema_liberato', $username, $password);
} catch (PDOException $e) {
	echo "Erro na conexão" . $e->getMessage();
}
