<?php
include 'conecta.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$esporte_preferido = $_POST['esporte_preferido'];
$cor_preferida = implode(", ", $_POST['cor_preferida']); 

$query = $conn->prepare("INSERT INTO pessoas (nome, email, telefone, esporte_preferido, cor_preferida) VALUES (?, ?, ?, ?, ?)");

$query->bind_param("sssss", $nome, $email, $telefone, $esporte_preferido, $cor_preferida);

if ($query->execute()) {
    header('Location: index.php');
} else {
    echo "Erro ao adicionar novo registro.";
}

$query->close();
$conn->close();
?>
