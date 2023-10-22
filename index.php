<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/index.css"> 
	<link rel="shortcut icon" href="imagens/favicon_crud.png" type="image/x-icon" />
    <title>Crud Arthur</title>
</head>
<body>
	<h1>Tabela de registros</h1>
	<!-- linka para a pagina onde ocorre se insere os dados -->
	<a href="adiciona.php">Insira os dados</a>
	<br><br>
	<table>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Email</th>
				<th>Telefone</th>
				<th>Esporte Preferido</th>
				<th>Cor Preferida</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php
				//Aqui está sendo chamado o arquivo de conexão o banco atraves da função include
				include 'conecta.php';
				//Colocando dentro de uma variavel a consulta que é realizada no banco de dados, esse consulta pega todos os campos da tabela "pessoa"
				$query = $conn->query("SELECT * FROM pessoas");
				//realizando um loop que percorre todos os dados da tabela, a função "fetch_assoc" retorna um array que contém os registros
				while($row = $query->fetch_assoc()) {
			?>
			<tr>
				<!-- loop vai percorrendo e printando na tela o nome na primeira coluna,  email na segunda, telefone na terceira, esporte na quarta e cor na quinta  -->
				<td><?php echo $row['nome']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['telefone']; ?></td>
				<td><?php echo $row['esporte_preferido']; ?></td>
				<td><?php echo $row['cor_preferida']; ?></td>
				<td>
					<!-- ao clicar remove ou edita essa tabela, linkando para os arquivos "edita.php" e "remove.php" -->
					<a href="edita.php?id=<?php echo $row['id']; ?>">Editar</a>
					<a href="remover.php?id=<?php echo $row['id']; ?>">Remover</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
</html>