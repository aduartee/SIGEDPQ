<?php 
    //Chamando o arquivo de conexão o banco atraves da função include
    include 'conecta.php'; 

    //valor do Id que foi capturado por meio do "$_GET" está sendo jogado para uma variavel, isso indica qual registro deve ser excluido
    $id = $_GET['id'];

    //por meio do operador "->" estamos chamando o metodo query que faz parte do objeto conn
    //o metodo query está sendo utilizado para enviar uma consulta para o banco de dados
    //Esse codigo SQL está deletando um campo da tabela pessoa quando o id for igual ao id que foi capturado na URL
    $query = $conn->query("DELETE FROM pessoas WHERE id='$id'");

    // Condição que verifica se a consulta foi realizada
    if($query) {
        //Se houver sucesso na consulta ele vai redirecionar para a pagina incial
		header('Location: index.php');
	} else {
        // Se não, ele vai printar uma mensagem na tela falando que não deu certo
		echo "Erro ao excluir";
	}
?>