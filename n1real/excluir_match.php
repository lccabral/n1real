<?php
		$numero = $_POST['numero'];

		$connection = mysqli_connect('localhost','id9872328_417namo1real','417comissaonamo','id9872328_namo1real');
		mysqli_set_charset($connection, 'utf8'); 
			

		$sql = "CALL Excluir_Combinacao('.$numero.');";
		$connection->query($sql);

		$connection->close();

?>