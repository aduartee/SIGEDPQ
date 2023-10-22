<?php
    //Chamando o arquivo de conexão o banco atraves da função include
	include 'conecta.php';

    //Atribui os dados do formulario a variaveis 
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
	$esporte_preferido = $_POST['esporte_preferido'];
	$cor_preferida = implode(", ", $_POST['cor_preferida']); //a função "implode" transforma tudo em uma unica string e sepera elas por virgula

    //Faz um update dos dados na tabela, pega as variaveis definidas acima e coloca elas como novos dados para o banco de dados
    //WHERE define que a atualização só vai ser aplicada nos dados que possuirem um id igual ao valor da variável $id.
	$query = $conn->query("UPDATE pessoas SET nome='$nome', email='$email', telefone='$telefone', esporte_preferido='$esporte_preferido', cor_preferida='$cor_preferida' WHERE id='$id'");

    //Caso a consulta for bem sucedida, manda o usuario para a tela index.php
	if($query) {
		header('Location: index.php');
    //Caso não, exibe uma mensagem de erro
	} else {
		echo "Erro ao atualizar registro.";
	}
?>