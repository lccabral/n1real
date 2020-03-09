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
    <title>Namo1real Matchs</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	
	
<script>
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

	function excluir(numero)
	{
		$.ajax({
  		url: 'excluir_match.php',
  		data: {
				numero: numero 
		},
  		type: "POST",
  		cache: false
  		});
		setTimeout(function(){ location.href='match.php'} , 1000);
	}

	function filtrar_id() {
		var vid = document.getElementById('entrada_id').value;
		vid = vid.trim();
		
		var vid_aux1;
		var vid_aux2;
		
		if(vid != "") {

			$(".table .corpo").each(function() {

				vid_aux1 = $(this).find("td").eq(2).text();
				vid_aux1 = vid_aux1.trim();
				vid_aux2 = $(this).find("td").eq(4).text();
				vid_aux2 = vid_aux2.trim(); 

				
				
				if (vid == vid_aux1 || vid == vid_aux2) {
					$(this).show();
				} else
				{
					$(this).hide();
				}
			});
		} else {
			$(".table .corpo").each(function() {
				$(this).show();
			});
		}
	}

	function filtrar_nome() {
		var vnome = document.getElementById('entrada_nome').value;
		vnome = vnome.toUpperCase();
		vnome = vnome.trim();

		var vnome_aux1 = "";
		var vnome_aux2 = "";

		if(vnome != "") {
			$(".table .corpo").each(function() {
				vnome_aux1 = $(this).find('td').eq(1).text();
				vnome_aux2 = $(this).find('td').eq(3).text();
				vnome_aux1 = vnome_aux1.trim();
				vnome_aux2 = vnome_aux2.trim();
				
				if (vnome_aux1.includes(vnome) || vnome_aux2.includes(vnome)) {
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
									<a style="cursor:pointer;"><li class="list-group-item">Matchs</li></a>
									<a href="comprador.php"><li class="list-group-item">Compradores</li></a>
								</ul>
							</div>
						  </div>
						</div> 
					</div>
					
					<div class="col col-md-9">
						<div class="row">

							<div class="input-group col col-md-9">
							
								<span class="input-group-btn">
									<button class="btn btn-secondary"  onclick="filtrar_id();" name="filtrar_id" aria-label="">Filtrar</button>
								</span>
								<input type="text" class="form-control" id="entrada_id" placeholder="ID" aria-label=""/>
							
							</div>
						<br>
							<div class="input-group col col-md-9">
							
								<span class="input-group-btn">
									<button class="btn btn-secondary"  onclick="filtrar_nome();" name="filtrar_nome" aria-label="">Filtrar</button>
								</span>
								<input type="text" class="form-control" id="entrada_nome" placeholder="Nome" aria-label=""/>
							
							</div>

						<br>

							<div class="col col-md-9">
								<table class="table">
									<thead>
										<tr>
											<th>Nº</th>
											<th>Pessoa 1</th>
											<th>ID1</th>
											<th>Pessoa 2</th>
											<th>ID2</th>
											<th colspan='2'>Vontade</th>
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

$sql = "SELECT DISTINCT combina.numero, tab2.id AS id1, tab2.nome AS nome1, tab2.telefone AS telefone1, tab2.turma AS turma1, tab3.id AS id2, tab3.nome AS nome2, tab3.telefone AS telefone2, tab3.turma AS turma2, (CASE WHEN tab2.vontade = 'qualquer' THEN (CASE WHEN tab3.vontade = 'qualquer' THEN tab3.vontade ELSE tab3.vontade END) ELSE tab2.vontade END) AS vontade FROM combina INNER JOIN (SELECT id, nome, telefone, turma, vontade FROM pessoa) AS tab2 ON combina.id1 = tab2.id INNER JOIN (SELECT id, nome, telefone, turma, vontade FROM pessoa) AS tab3 ON (tab3.id <> tab2.id) AND (combina.id2 = tab3.id) ORDER BY combina.numero ASC;";


$result = $conn->query($sql);

if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}
else{
	// output data of each row
	
	while($row = $result->fetch_assoc()) {

			$numero = $row["numero"];
			$id1 = $row["id1"];
			$id2 = $row["id2"];
			$nome1 = $row["nome1"];
			$nome2 = $row["nome2"];
			$telefone1 = $row["telefone1"];
			$telefone2 = $row["telefone2"];
			$turma1 = $row["turma1"];
			$turma2 = $row["turma2"];
			$vontade = $row["vontade"];


        echo
        "
        <tr class='corpo'>
            <td scope='row'>".$numero."</td>
            <td style='cursor:pointer;' data-toggle='modal' data-target='#modal".$numero."a'>
				".$nome1."
			</td>

			<td style='cursor:pointer;' data-toggle='modal' data-target='#modal".$numero."a'>
				".$id1."
			</td>
			
			<td style='cursor:pointer;' data-toggle='modal' data-target='#modal".$numero."b'>
				".$nome2."
			</td>

			<td style='cursor:pointer;' data-toggle='modal' data-target='#modal".$numero."b'>
				".$id2."
			</td>
			
			<td style='cursor:pointer;' data-toggle='modal' data-target='#modal".$numero."c'>
				".$vontade."
			</td>

			<td style='cursor:pointer; text-align:center;' data-toggle='modal' data-target='#modal".$numero."d'>
				X
			</td>  
	</tr>

	<!-- Modal".$numero."a -->
			<div class='modal fade' id='modal".$numero."a' tabindex='-1' role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
				<div class='modal-dialog' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h5 class='modal-title'>".$nome1."</h5>
								<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
						</div>
						<div class='modal-body'>
							<h3>Nome: ".$nome1."</h3>
							<br>
							<h3>Telefone: ".$telefone1."</h3>
							<br>
							<h3>Turma: ".$turma1."</h3>
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal".$numero."b -->
			<div class='modal fade' id='modal".$numero."b' tabindex='-1' role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
				<div class='modal-dialog' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h5 class='modal-title'>".$nome2."</h5>
								<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
						</div>
						<div class='modal-body'>
							<h3>Nome: ".$nome2."</h3>
							<br>
							<h3>Telefone: ".$telefone2."</h3>
							<br>
							<h3>Turma: ".$turma2."</h3>
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal".$numero."c -->
			<div class='modal fade' id='modal".$numero."c' tabindex='-1' role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
				<div class='modal-dialog' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h5 class='modal-title'>Informações do match</h5>
								<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
						</div>
						<div class='modal-body'>
						<h3>".$nome1." e ".$nome2."</h3>
							<br>
						<h3>Contatos:</h3><br>
							<h4>".$nome1.": ".$telefone1."</h4><br>
							<h4>".$nome2.": ".$telefone2."</h4><br>
						<h3>Turmas:</h3><br>
							<h4>".$nome1.": ".$turma1."</h4><br>
							<h4>".$nome2.": ".$turma2."</h4><br>
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal".$numero."d -->
			<div class='modal fade' id='modal".$numero."d' tabindex='-1' role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
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
							Você tem certeza que deseja cancelar o match nº ".$numero."?
						</div>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
						<button type='button' onclick='excluir(\"".$numero."\");' class='btn btn-primary'>Sim</button>
					</div>
					</div>
				</div>
			</div>
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
