<?php
		$id = $_POST['id'];

		$connection = mysqli_connect('localhost','id9872328_417namo1real','417comissaonamo','id9872328_namo1real');
		mysqli_set_charset($connection, 'utf8'); 
			

		$sql = "CALL Excluir_Pessoa(".$id.");";
		$connection->query($sql);

		$connection->close();

?>