<?php
		$nome = strtoupper($_POST['nome']);
  		$telefone = $_POST['telefone'];
		$altura = $_POST['altura'];
		$idade = $_POST['idade'];
		$turma = $_POST['turma'];
		$genero = $_POST['genero'];
		$caracteristica = $_POST['caracteristica'];
		$estilo = $_POST['estilo'];
		$vontade = $_POST['vontade'];
		
		$pgenero = $_POST['pgenero'];
		$paltura = $_POST['paltura'];
		$pidade = $_POST['pidade'];
		$pcaracteristica = $_POST['pcaracteristica'];
		$especifica = strtoupper($_REQUEST['especifica']);

		$connection = mysqli_connect('localhost','id9872328_417namo1real','417comissaonamo','id9872328_namo1real');
		mysqli_set_charset($connection, 'utf8'); 
			


if($nome != "" || $nome != NULL){
    $sql = "CALL Adicionar_Cadastro('$nome', '$telefone', '$altura', '$idade', '$turma', '$genero', '$caracteristica', '$estilo', '$vontade', '$pgenero', '$paltura', '$pidade', '$pcaracteristica', '$especifica');";
	$connection->query($sql);
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();

?>