<?php
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
    <title>Namo1real Cadastrar</title>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
	
	
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
</script>

<script>
$(document).ready(function(){
	
	$('#form_cadastro').validate({
        rules: {
            nome: { 
                required: true, 
                minlength: 2 
            },
            telefone: { 
                required: true, 
                minlength: 11,
                maxlength: 11
            },
            altura: {
                required: true,
                minlength: 3,
                maxlength: 3
            },
            idade: {
                required: true,
                minlength: 2,
                maxlength: 2
            },
            caracteristica: {
                required: true,
                maxlength: 4
            },
            paltura: {
                required: true
            },
            pidade: {
                required: true
            },
            pcaracteristica: {
                required: true,
                maxlength: 4
            },
            especifica: {
                minlength: 3
            }
        },
        messages: {
            nome: { required: 'Preencha o campo nome', minlength: 'Insira um nome de no mínimo 2 letras' },
            telefone: { required: 'Informe o telefone', minlength: 'Insira um número com 11 dígitos', maxlength: 'Insira um número com 11 dígitos'},
            altura: { required: 'Preencha o campo altura', minlength: 'Preencha uma altura de no mínimo 100cm', maxlength: 'Preencha uma altura de no máximo 999cm (?)'},
            idade: {required: 'Preencha o campo idade', minlength: 'Coloque uma idade de no mínimo 10 anos', maxlength: 'Coloque uma idade de no máximo 99 anos'},
            caracteristica: {required: 'Assinale ao menos uma característica', maxlength: 'Assinale no máximo 4 características'},
            paltura: {required: 'Assinale ao menos uma faixa de altura de interesse'},
            pidade: {required: 'Assinale ao menos uma faixa de idade de interesse'},
            pcaracteristica: {required: 'Assinale ao menos uma característica de interesse', maxlength: 'Assinale no máximo 4 características de interesse'},
            especifica: {minlength: 'Preencha com no mínimo 3 caracteres o campo de pessoas específicas'}
        },
        submitHandler: function( form ){

            var nome = document.getElementById("nome").value;
            var telefone = document.getElementById("telefone").value;
            var altura = document.getElementById("altura").value;
            var idade = document.getElementById("idade").value;
            var turma = document.getElementById("turma").options[document.getElementById("turma").selectedIndex].text;
            var genero = document.getElementById("genero").options[document.getElementById("genero").selectedIndex].value;
            
            var caracteristica = [];
            
            var checkboxes = document.querySelectorAll('input[name="caracteristica"]:checked');

            for (var i = 0; i < checkboxes.length; i++) {
            caracteristica.push(checkboxes[i].value)
            }
            
            var estilo = document.querySelector('input[name="estilo"]:checked').value;
            var vontade = document.querySelector('input[name="vontade"]:checked').value;	
            var pgenero = document.querySelector('input[name="pgenero"]:checked').value;
            
            var paltura = [];
            
            checkboxes = document.querySelectorAll('input[name="paltura"]:checked');
            for (var i = 0; i < checkboxes.length; i++) {
            paltura.push(checkboxes[i].value)
            }

            var pidade = [];
            
            checkboxes = document.querySelectorAll('input[name="pidade"]:checked');
            for (var i = 0; i < checkboxes.length; i++) {
            pidade.push(checkboxes[i].value)
            }

            var pcaracteristica = [];
            
            checkboxes = document.querySelectorAll('input[name="pcaracteristica"]:checked');
            for (var i = 0; i < checkboxes.length; i++) {
            pcaracteristica.push(checkboxes[i].value)
            }
            
            var especifica = document.getElementById("especifica").value;
            
            //alert(nome+","+telefone+","+altura+","+idade+","+turma+","+genero+","+caracteristica+","+estilo+","+vontade+","+pgenero+","+paltura+","+pidade+","+pcaracteristica+","+especifica);

            $.ajax({
            url: 'cadastro_adicionar.php',
            data: {
                    nome: nome,
                    telefone: telefone,
                    altura: altura,
                    idade: idade,
                    turma: turma,
                    genero: genero,
                    caracteristica: caracteristica.toString(),
                    estilo: estilo,
                    vontade: vontade,
                    pgenero: pgenero,
                    paltura: paltura.toString(),
                    pidade: pidade.toString(),
                    pcaracteristica: pcaracteristica.toString(),
                    especifica: especifica
            },
            type: "POST",
            cache: false
			});
			
			//setTimeout(function(){ location.href='cadastro.php'} , 0);

			$('#form_cadastro')[0].reset();
			$(window).scrollTop(0);
			$('#nome').focus();

            return false;
		},
		errorPlacement: function( label, element ) {
			if( element.attr( "name" ) === "caracteristica" || element.attr( "name" ) === "paltura" || element.attr( "name" ) === "pidade" || element.attr( "name" ) === "pcaracteristica" ) {
				element.parent().prepend(label, '<br>'); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
			} else {
			label.insertAfter( element ); // standard behaviour
		}
	}
    });
});
</script>

<style>
.error {
      color: red;
}
</style>
	
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
							<div id="collapse1" class="panel-collapse collapse in">
								<ul class="list-group">
									<a style="cursor:pointer;"><li class="list-group-item"></span>Cadastrar</li></a>
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
							<div id="collapse2" class="panel-collapse collapse">
								<ul class="list-group">
									<a href="match.php"><li class="list-group-item">Matchs</li></a>
									<a href="comprador.php"><li class="list-group-item">Compradores</li></a>
								</ul>
							</div>
						  </div>
						</div> 
					</div>
					
					<div class="col col-md-9">
						<div class="row">
							<div class="col col-md-9">
								<h3>Sobre a pessoa:</h3>
								
							<form action="" method="POST" id="form_cadastro" autocomplete="off">
                                <div class="form-group row">
                                    <label for="nome" class="col-md-4 col-form-label text-md-right">Nome</label>
                                    <div class="col-md-6">
                                        <input type="text" id="nome" class="form-control" name="nome"/>
                                    </div>
                                </div>
								
								<div class="form-group row">
                                    <label for="turma" class="col-md-4 col-form-label text-md-right">Turma</label>
                                    <div class="col-md-6">
                                        <select id="turma" class="form-control" name="turma">
																					<option value="117">117</option>
																					<option value="118">118</option>
																					<option value="147">147</option>
																					<option value="148">148</option>
																					<option value="149">149</option>
																					<option value="150">150</option>
																					<option value="217">217</option>
																					<option value="218">218</option>
																					<option value="219">219</option>
																					<option value="247">247</option>
																					<option value="248">248</option>
																					<option value="311">311</option>
																					<option value="317">317</option>
																					<option value="318">318</option>
																					<option value="347">347</option>
																					<option value="348">348</option>
																					<option value="417">417</option>
																					<option value="418">418</option>
																					<option value="447">447</option>
																				</select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="telefone" class="col-md-4 col-form-label text-md-right">Celular</label>
                                    <div class="col-md-6">
                                        <input type="text" id="telefone" class="form-control" name="telefone"/>
                                    </div>
                                </div>

								<div class="form-group row">
                                    <label for="genero" class="col-md-4 col-form-label text-md-right">Gênero</label>
                                    <div class="col-md-6">
                                        <select id="genero" class="form-control" name="genero">
											<option value="homem">Homem</option>
											<option value="mulher">Mulher</option>
											<option value="outro">Outro</option>
										</select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="altura" class="col-md-4 col-form-label text-md-right">Altura (cm)</label>
                                    <div class="col-md-6">
										<input type="text" id="altura" class="form-control" name="altura"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="idade" class="col-md-4 col-form-label text-md-right">Idade</label>
                                    <div class="col-md-6">
                                        <input type="text" id="idade" class="form-control" name="idade"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="caracteristica" class="col-md-4 col-form-label text-md-right">Ela é...</label>
                                    <div class="col-md-7">
									
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="inteligente">
										  <label class="custom-control-label">Inteligente</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="espontanea">
										  <label class="custom-control-label">Espontânea</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="carinhosa">
										  <label class="custom-control-label">Carinhosa</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="fitness">
										  <label class="custom-control-label">Fitness</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="comunicativa">
										  <label class="custom-control-label">Comunicativa</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="hiperativa">
										  <label class="custom-control-label">Hiperativa</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="criativa">
										  <label class="custom-control-label">Criativa</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="autentica">
										  <label class="custom-control-label">Autêntica</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="sincera">
										  <label class="custom-control-label">Sincera</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="engracada">
										  <label class="custom-control-label">Engraçada</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="romantica">
										  <label class="custom-control-label">Romântica</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="indecisa">
										  <label class="custom-control-label">Indecisa</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="tranquila">
										  <label class="custom-control-label">Tranquila</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="organizada">
										  <label class="custom-control-label">Organizada</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="caracteristica" value="debochada">
										  <label class="custom-control-label">Debochada</label>
										</div>
                                    </div>
                                </div>
								
								<div class="form-group row">
                                    <label for="estilo" class="col-md-4 col-form-label text-md-right">Ela gosta de...</label>
                                    <div class="col-md-7">
										<div>
										  <input type="radio" id="caseira" name="estilo" value="caseira" checked>
										  <label for="caseira">Ficar em casa</label>
										</div>

										<div>
										  <input type="radio" id="festeira" name="estilo" value="festeira">
										  <label for="festeira">Curtir muitas festas e socializar</label>
										</div>

										<div>
										  <input type="radio" id="estudante" name="estilo" value="estudante">
										  <label for="estudante">Estudar e ler</label>
										</div>
										
										<div>
										  <input type="radio" id="tudo" name="estilo" value="tudo">
										  <label for="tudo">Fazer um pouco de tudo</label>
										</div>
                                    </div>
                                </div>
								
								<div class="form-group row">
                                    <label for="vontade" class="col-md-4 col-form-label text-md-right">Ela está querendo...</label>
                                    <div class="col-md-7">
										<div>
										  <input type="radio" id="beijos" name="vontade" value="beijos"
												 checked>
										  <label for="beijos">Só beijar</label>
										</div>

										<div>
										  <input type="radio" id="algoserio" name="vontade" value="algoserio">
										  <label for="algoserio">Algo sério</label>
										</div>

										<div>
										  <input type="radio" id="amizade" name="vontade" value="amizade">
										  <label for="amizade">Amizade</label>
										</div>
										
										<div>
										  <input type="radio" id="qualquer" name="vontade" value="qualquer">
										  <label for="qualquer">Qualquer coisa</label>
										</div>
                                    </div>
                                </div>
								<br>
								<h3>Sobre a procura:</h3>
								
								<div class="form-group row">
                                    <label for="pgenero" class="col-md-4 col-form-label text-md-right">Gênero</label>
                                    <div class="col-md-7">
										<div>
										  <input type="radio" name="pgenero" value="homem"
												 checked>
										  <label for="phomem">Homem</label>
										</div>

										<div>
										  <input type="radio" name="pgenero" value="mulher">
										  <label for="pmulher">Mulher</label>
										</div>

										<div>
										  <input type="radio" name="pgenero" value="humano">
										  <label for="phumano">Humano</label>
										</div>
                                    </div>
                                </div>
								
								<div class="form-group row">
                                    <label for="paltura" class="col-md-4 col-form-label text-md-right">Altura</label>
                                    <div class="col-md-7">
										<div>
										  <input type="checkbox" name="paltura" value="qualquer">
										  <label>Qualquer</label>
										</div>
										
										<div>
										  <input type="checkbox" name="paltura" value="150>a">
										  <label>Menos de 1,50</label>
										</div>
										
										<div>
										  <input type="checkbox" name="paltura" value="150<a<160">
										  <label>Entre 1,50 e 1,59</label>
										</div>
										
										<div>
										  <input type="checkbox" name="paltura" value="160=<a<170">
										  <label>Entre 1,60 e 1,69</label>
										</div>
										
										<div>
										  <input type="checkbox" name="paltura" value="170=<a<180">
										  <label>Entre 1,70 e 1,79</label>
										</div>
										
										<div>
										  <input type="checkbox" name="paltura" value="180=<a<190">
										  <label>Entre 1,80 e 1,89</label>
										</div>
										
										<div>
										  <input type="checkbox" name="paltura" value="190=<a">
										  <label>Mais de 1,90</label>
										</div>
                                    </div>
                                </div>
								
								<div class="form-group row">
                                    <label for="pidade" class="col-md-4 col-form-label text-md-right">Idade</label>
                                    <div class="col-md-7">
										<div>
										  <input type="checkbox" name="pidade" value="qualquer">
										  <label>Qualquer</label>
										</div>
										
										<div>
										  <input type="checkbox" name="pidade" value="14 - 15">
										  <label>Entre 14 e 15</label>
										</div>
										
										<div>
										  <input type="checkbox" name="pidade" value="16 - 17">
										  <label>Entre 16 e 17</label>
										</div>
										
										<div>
										  <input type="checkbox" name="pidade" value="18 - 19">
										  <label>Entre 18 e 19</label>
										</div>
										
										<div>
										  <input type="checkbox" name="pidade" value="20+">
										  <label>Maior de 20</label>
										</div>
                                    </div>
									</div>
									
									<div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Ela busca uma pessoa...</label>
                    <div class="col-md-7">
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="inteligente">
										  <label class="custom-control-label">Inteligente</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="espontanea">
										  <label class="custom-control-label">Espontânea</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="carinhosa">
										  <label class="custom-control-label">Carinhosa</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="fitness">
										  <label class="custom-control-label">Fitness</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="comunicativa">
										  <label class="custom-control-label">Comunicativa</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="hiperativa">
										  <label class="custom-control-label">Hiperativa</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="criativa">
										  <label class="custom-control-label">Criativa</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="autentica">
										  <label class="custom-control-label">Autêntica</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="sincera">
										  <label class="custom-control-label">Sincera</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="engracada">
										  <label class="custom-control-label">Engraçada</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="romantica">
										  <label class="custom-control-label">Romântica</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="indecisa">
										  <label class="custom-control-label">Indecisa</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="tranquila">
										  <label class="custom-control-label">Tranquila</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="organizada">
										  <label class="custom-control-label">Organizada</label>
										</div>
										
										<div class="custom-control custom-checkbox">
										  <input type="checkbox" class="custom-control-input" name="pcaracteristica" value="debochada">
										  <label class="custom-control-label">Debochada</label>
										</div>
										</div>
										</div>
								
								<div class="form-group row">
                                    <label for="especifica" class="col-md-4 col-form-label text-md-right">Pessoas específicas (separar entre vírgulas)</label>
                                    <div class="col-md-6">
                                        <input type="text" id="especifica" class="form-control" name="especifica">
                                    </div>
                                </div>
								
								

                                    <div class="row-fluid offset-md-4">
                                        <button type="submit" for="form_cadastro" class="btn btn-lg">Cadastrar</button>
                                    </div>
                                </div>
                            </form>
								
								
							</div>
						</div>
					</div>
				</div>
</body>
</html>
