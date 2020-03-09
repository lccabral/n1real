<?php
	session_start();
?>

<!doctype html>

<html lang="en">

	<head>

		<!-- Required meta tags -->

		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

		<script src="https://www.google.com/recaptcha/api.js" async defer></script>



		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="css/bootstrap.min.css">



		<title>Namo1Real</title>

		

		<style>

			body {

				font-family: "Lato", sans-serif;

			}



			.main-head{

				height: 150px;

				background: #FFF;

			   

			}



			.sidenav {

				height: 100%;

				background-image: linear-gradient(-90deg, #DD3D31,#e60000);

				overflow-x: hidden;

				padding-top: 20px;

			}





			.main {

				padding: 0px 10px;

			}



			@media screen and (max-height: 450px) {

				.sidenav {padding-top: 15px;}

			}



			@media screen and (max-width: 450px) {

				.login-form{

					margin-top: 10%;

				}



				.register-form{

					margin-top: 10%;

				}

			}



			@media screen and (min-width: 768px){

				.main{

					margin-left: 40%; 

				}



				.sidenav{

					width: 40%;

					position: fixed;

					z-index: 1;

					top: 0;

					left: 0;

				}



				.login-form{

					margin-top: 80%;

				}



				.register-form{

					margin-top: 20%;

				}

			}





			.login-main-text{

				margin-top: 20%;

				padding: 60px;

				color: #fff;

			}



			.login-main-text h2{

				font-weight: 300;

			}



			.btn-black{

				background-color: #000 !important;

				color: #fff;

			}

		</style>

		

	</head>

	<body>

  

		<!-- Optional JavaScript -->

		<!-- jQuery first, then Popper.js, then Bootstrap JS -->

		<script src="js/jquery.min.js"></script>

		<script src="js/popper.min.js"></script>

		<script src="js/bootstrap.min.js"></script>

		

		<!-- inicio site -->

		

				<div class="sidenav">

					 <div class="login-main-text">

						<h1>Namorado de 1 real</h1><br><h3>Página de entrada</h3>

						<p>Insira usuário e senha</p>

					 </div>

				  </div>

				  <div class="main">

					 <div class="col-md-6 col-sm-12">

						<div class="login-form">

						   <form action="index.php" method="POST">

							  <div class="form-group">

								 <label>Usuário</label>

								 <input type="text" class="form-control" name="usuario" placeholder="Usuário">

							  </div>

							  <div class="form-group">

								 <label>Senha</label>

								 <input type="password" class="form-control" name="senha" placeholder="Senha">

							  </div>

							  <div class="form-group">
								<div class="g-recaptcha" data-sitekey="6LcX8acUAAAAALoYEU1IV3J5R2e00nm91lG4oS4L"></div>
							  </div>

							  <button type="submit" class="btn" name="entrar" style="background-color:#DD3D31; color:white;">Entrar</button>

						   </form>

						</div>

					 </div>

				  </div>

		<!-- fim site -->



		<?php

			if ($_POST){

				$usuario = preg_replace('/[^[:alpha:]_]/', '',$_POST['usuario']);

				$senha = preg_replace('/[^[:alpha:]_]/', '',$_POST['senha']);

				$entrar = $_POST['entrar'];

				$secretKey = "6LcX8acUAAAAAN2oerhVAMWdDhMPfFnASBlxUmhj";
				$responseKey = $_POST["g-recaptcha-response"];
				$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$responseKey;


				$connection = mysqli_connect('localhost','id9872328_417namo1real','417comissaonamo','id9872328_namo1real');

				mysqli_set_charset($connection, 'utf8');

				$response = file_get_contents($url);
				$response = json_decode($response);


				if($response->success) {

					if (isset($entrar)) {



						$sql = mysqli_query($connection, "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'");
					

						if (mysqli_num_rows($sql) <= 0){

							

							echo"<script language='javascript' type='text/javascript'>

									setTimeout(function(){location.href='index.php'} , 0);

								</script>";

							die();

						

						}else{

							

							$_SESSION['usuario'] = $usuario;

							$_SESSION['senha'] = $senha;

							

							echo"<script language='javascript' type='text/javascript'>

									setTimeout(function(){location.href='cadastro.php'} , 0);

								</script>";

						

						}

					}

				} else{
					echo "<script>alert('CAPTCHA inválido!');</script>";
				}
					
			}

		?>

		

	</body>

</html>