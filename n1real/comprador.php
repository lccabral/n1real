<?php 
//error_reporting(0);

session_start();


if((!isset($_SESSION['usuario']) == true) && (!isset($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
  
    echo"<script language='javascript' type='text/javascript'>
        setTimeout(function(){location.href='index.php'} , 0);
	</script>";
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Namo1real Compradores</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	
	
	<script>
	function excluir(id)
	{
		$.ajax({
  		url: 'excluir_pessoa.php',
  		data: {
				id: id 
		},
  		type: "POST",
  		cache: false
  		});
		setTimeout(function(){ location.href='comprador.php'} , 1000);
	}

	function sair()
	{
		$.ajax({
  					url: 'sair.php',
  					cache: false
  				})

  				.done(function( html ) {
  	  				$( "#resultados" ).append(html); // Ou qualquer outra comando com o resultado que é 'html'
  				});
				setTimeout(function(){ location.href='index.php'} , 1000);
	}

	function filtrar_id() {
		var vid = document.getElementById('entrada_id').value;
		vid = vid.trim();


		if(vid != "") {
			$(".table .corpo").each(function() {
				if ($(this).find('td').eq(0).text().trim() == vid) {
					$(this).show();
				} else
				{
					$(this).hide();
				}
			});
		}else {
			$(".table .corpo").each(function() {
				$(this).show();
			});
		}
	}

	function filtrar_nome() {
		var vnome = document.getElementById('entrada_nome').value;
		vnome = vnome.toUpperCase();
		vnome = vnome.trim();

		var vnome_aux = "";

		if(vnome != "") {
			$(".table .corpo").each(function() {
				vnome_aux = $(this).find('td').eq(1).text();
				vnome_aux = vnome_aux.trim();
				if (vnome_aux.includes(vnome)) {
					$(this).show();
				} else
				{
					$(this).hide();
				}
			});
		}else {
			$(".table .corpo").each(function() {
				$(this).show();
			});
		}
	}
	</script>
	
</head>
<body>
    		<nav class="navbar navbar-default navbar-static-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">
							<?php
							echo $_SESSION['usuario'];
							?>
						</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">			
						<ul class="nav navbar-nav navbar-right">
							<li><a onclick="sair();" style="cursor:pointer;">Sair</a></li>
					</div>
				</nav>
				<div class="container-fluid">
					<div class="col col-md-3">			
						<div class="panel-group" id="accordion">
						  <div class="panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								Venda</a>
							  </h4>
							</div>
							<div id="collapse1" class="panel-collapse collapse">
								<ul class="list-group">
									<a href="cadastro.php"><li class="list-group-item"></span>Cadastrar</li></a>
								</ul>
							</div>
						  </div>
						  <div class="panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
								Controle</a>
							  </h4>
							</div>
							<div id="collapse2" class="panel-collapse collapse in">
								<ul class="list-group">
									<a href="match.php"><li class="list-group-item">Matchs</li></a>
									<a style="cursor:pointer;"><li class="list-group-item">Compradores</li></a>
								</ul>
							</div>
						  </div>
						</div> 
					</div>
					
					<div class="col col-md-9">
						<div class="row">
							<div class="input-group col col-md-9">
							
								<span class="input-group-btn">
									<button class="btn btn-secondary" onclick="filtrar_id();" name="filtrar_id" aria-label="">Filtrar</button>
								</span>
								<input type="text" class="form-control" id="entrada_id" placeholder="ID" aria-label=""/>
							
							</div>
						<br>
							<div class="input-group col col-md-9">
							
								<span class="input-group-btn">
									<button class="btn btn-secondary" onclick="filtrar_nome();" name="filtrar_nome" aria-label="">Filtrar</button>
								</span>
								<input type="text" class="form-control" id="entrada_nome" placeholder="Nome" aria-label="">
							
							</div>

						<br>

							<div class="col col-md-9">
								<table class="table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Pessoa</th>
											<th>Turma</th>
											<th>Idade</th>
											<th  colspan='2'>Telefone</th>
										</tr>
									</thead>
									<tbody>
<?php
$servername = "localhost";
$username = "id9872328_417namo1real";
$password = "417comissaonamo";
$dbname = "id9872328_namo1real";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, nome, turma, idade, telefone FROM pessoa;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {

		$id = $row["id"];
		$nome = $row["nome"];
		$turma = $row["turma"];
		$idade = $row["idade"];
		$telefone = $row["telefone"];			


	echo
	"
	<tr class='corpo'>
		<td scope='row'>
		".$id."
		</td>

		<td>
			".$nome."
		</td>
		
		<td>
			".$turma."
		</td>
		
		<td>
			".$idade."
		</td>

		<td>
			".$telefone."
		</td>

		<td style='cursor:pointer; text-align:center;' data-toggle='modal' data-target='#modal".$id."d'>
			X
		</td>

		<!-- Modal".$id."d -->
			<div class='modal fade' id='modal".$id."d' tabindex='-1' role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
				<div class='modal-dialog' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
						<h5 class='modal-title'>Alerta de exclusão</h5>
						<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
						</div>
					<div class='modal-body'>
						<div class='container-fluid'>
							Você tem certeza que deseja excluir o(a) comprador(a) com id nº ".$id."?
						</div>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
						<button type='button' onclick='excluir(".$id.");' class='btn btn-primary'>Sim</button>
					</div>
					</div>
				</div>
			</div>
	</tr>
	";
}
}
$conn->close();

?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
					

</body>
</html>
