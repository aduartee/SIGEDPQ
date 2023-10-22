<?php
	// Parametros para fazer a conexão com o banco
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "crud_arthur";

	// Parte responsavel pela conexão com o banco de dados
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Joga uma mensagem de erro caso a conexão não de certo
	if ($conn->connect_error) {
	    die("Erro na conexão: " . $conn->connect_error);
	}
?>