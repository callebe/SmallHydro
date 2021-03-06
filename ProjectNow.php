<?php
	session_start(); //esse comando deve estar na primeira linha
	//você também poderá ativar o buffer usando o comando ob_start que evita alguns erros
	ob_start(); //ob_start — Ativa o buffer de saída
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="img/favicon.ico"/>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Project Tool</title>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="css/theme.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<script>
		function myFunction(){
			document.getElementById('Hb').value = "6.35";
			document.getElementById('t').value = "5";
			document.getElementById('pHidrMax').value = "4";
			document.getElementById('hCheiaMax').value = "6.1";
			document.getElementById('ng').value = "95";
			document.getElementById('nTrafo').value = "99";
			document.getElementById('pDiv').value = "2";
			document.getElementById('Qn').value = "11.25";
			document.getElementById('Qr').value = "1";
			document.getElementById('pInd').value = "4";
		}
	</script>
	<script>
		function myFunctionA(){
			document.getElementById('Qi').value = "25*exp(-t/100)";
		}
	</script>
	<script>
		function myFunctionB(){
			document.getElementById('Qi[0]').value = "25";
			document.getElementById('Qi[1]').value = "20.829";
			document.getElementById('Qi[2]').value = "17.354";
			document.getElementById('Qi[3]').value = "14.459";
			document.getElementById('Qi[4]').value = "12.047";
			document.getElementById('Qi[5]').value = "10.037";
			document.getElementById('Qi[6]').value = "8.363";
			document.getElementById('Qi[7]').value = "6.968";
			document.getElementById('Qi[8]').value = "5.805";
			document.getElementById('Qi[9]').value = "4.837";
			document.getElementById('Qi[10]').value = "4.030";
			document.getElementById('Qi[11]').value = "3.358";
			document.getElementById('Qi[12]').value = "2.797";
			document.getElementById('Qi[13]').value = "2.331";
			document.getElementById('Qi[14]').value = "2.331";
			document.getElementById('Qi[15]').value = "1.618";
			document.getElementById('Qi[16]').value = "1.348";
			document.getElementById('Qi[17]').value = "1.123";
			document.getElementById('Qi[18]').value = "0.936";
			document.getElementById('Qi[19]').value = "0.779";
			document.getElementById('Qi[20]').value = "0.649";
		}
	</script>
	<script>
		function myFunctionC(){
			//document.getElementById('hFun').value = "2500";
			document.getElementById('invUni').value = "1200";
			document.getElementById('txAt').value = "7";
			document.getElementById('venEner').value = "75";
			document.getElementById('encManu').value = "1.5";
			document.getElementById('anos').value = "20";
		}
	</script>
	<script>
		window.location.href='#ancora';
	</script>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	
<!-- Menus -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
			<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand page-scroll" href="index.php">
			Project Your Small Hydro </a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
			<ul class="nav navbar-nav">
				<li>
				<a href="index.php">Home</a>
				</li>
				<li>
				<a href="ProjectNow.php">Project Now</a>
				</li>
				<li>
				<a href="ContactUs.php">Contact</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
</nav>

<!-- Cabeçalho -->
<header class="intro2">
	
	<div class="intro2-body">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<h1 class="brand-heading">Projec Tool </h1>
					<p> </p>
					<a href="#about" class="btn btn-circle page-scroll">
						<i class="fa fa-angle-double-down animated"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</header>


<!-- Conteúdo -->
<section id="about">
	<div class="container text-center col-lg-10 col-lg-offset-1 col-md-13 col-md-offset-5 col-md-6">
		<?php
			//Se for a primeira etapa do processo
 			if(empty($_POST["Hb"]) & empty($_POST["Qi"]) & empty($_POST["hFun"])){
 				//Printa a explicação
 				$data = file_get_contents("Explanation.php");
				echo $data;
 				//Printa o formulário
 				$data = file_get_contents("InitialForm.php");
				echo $data;
 			}
 			else{
 				//Se for a segunda etapa do processo
 				if(empty($_POST["Qi"]) & empty($_POST["hFun"])){
 					//Printa a explicação
 					$data = file_get_contents("Explanation.php");
					echo $data;
					//Guarda Variáveis
 					$_SESSION['Hb'] = $_POST["Hb"];
					$_SESSION['t'] = $_POST["t"];
					$_SESSION['pHidrMax'] = $_POST["pHidrMax"];
					$_SESSION['hCheiaMax'] = $_POST["hCheiaMax"];
					$_SESSION['ng'] = $_POST["ng"];
					$_SESSION['nTrafo'] = $_POST["nTrafo"];
					$_SESSION['pDiv'] = $_POST["pDiv"];
					$_SESSION['Qn'] = $_POST["Qn"];
					$_SESSION['Qr'] = $_POST["Qr"];
					$_SESSION['TypeTurbine'] = $_POST["TypeTurbine"];
					$_SESSION['TypeQt'] = $_POST["TypeQt"];
					$_SESSION['pInd'] = $_POST["pInd"];
					//Se Qt for da forma discreta
 					if($_POST["TypeQt"] == "Discrete"){
 						//Printa o formulário do Qt Discreto
 						$data = file_get_contents("ProcessQtTableA.php");
						echo $data;
						for ($i = 0 ; $i<100/($_SESSION['t'])+1; $i++){
							echo "<tr><th align=\"left\">The Flow Rate In t= ".$i*($_SESSION['t'])."%: </th><th align=\"rigth\"><input type=\"number\" class=\"form-control\" name=\"Qi[$i]\" id=\"Qi[$i]\" placeholder=\"Q($i)\" size=10 min=\"0\" max=\"1000000\" step=0.001 required></th></tr>";
						}
						$data = file_get_contents("ProcessQtTableB.php");
						echo $data;	
 					}
 					//Senão
 					else{
 						//Printa o formulário do Qt em forma de equação
 						$data = file_get_contents("ProcessQtEquation.php");
						echo $data;
 					}
 				}
 				else{
 					//Se for a terceira etapa do processo
 					if(empty($_POST["hFun"])){
						// Tratamento das Varíáveis recebidas no processo anterior
						// Se Qt for discreto
						if($_SESSION['TypeQt'] == "Discrete"){
							//Associa o valor de Qi
							$_SESSION["Qi"] = $_POST["Qi"];
							//Printa o Processo financial 
							$data = file_get_contents("FinantialProcess.php");
							echo $data;
						}
						// Se Qt for em forma de equação
						else{
							//Adicionando $ na variável t
							$QiAux = str_replace("t", "\$t", $_POST["Qi"]);
							$QiAux1 = str_replace("euler", "M_E", $QiAux);
							$Qi = str_replace("pi", "M_PI", $QiAux1);
							// diretório onde encontra-se o arquivo
							$filename = "FlowRateFunction.php";
							//Aguarda até liberar o arquivo
							//while(file_exists($filename)){}		
							$s = "<?php \n function FlowRateFunction(\$t) {\n \$R = ".$Qi."; \n return \$R; }\n ?>";
							//Escrevendo
							$file = @fopen($filename, "w+");
							@fwrite($file, $s);
							@fclose($file);	
							//Verifica se há erros na equação
							include 'FlowRateFunction.php';
							FlowRateFunction(1);
							$erro = error_get_last();
							if(empty($erro)){
								//Calcula os Pontos de Qi
								$_SESSION['Qi'][0]  = FlowRateFunction(($_SESSION["t"])*365*(0.01)/100);
								for ($i = 1 ; $i<(floor(100/$_SESSION["t"])+1); $i++){
									$aux = FlowRateFunction(($_SESSION["t"])*365*$i/100);
									if($aux == INF){
										$aux = 1000000;
									}
									$_SESSION['Qi'][$i] = $aux; 
								}
								//Printa o Processo financial 
								$data = file_get_contents("FinantialProcess.php");
								echo $data;
							} 
							else{
								echo "<script> alert(\"".$erro[message]."\"); </script>";
								//Printa o formulário do Qt em forma de equação
		 						$data = file_get_contents("ProcessQtEquation.php");
								echo $data;
							}
							//Exclui o Arquivo Criado Anteriormente
							unlink('FlowRateFunction.php');  //Deleta Arquivo
						}
 					}
 				}
 			}
		?>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>	
	</div>
</section>

<!-- Rodapé -->
<footer>
	<div class="container text-center">
		<p class="credits">
			Copyright S. B.&copy; <br/>
		</p>
	</div>
</footer>

<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- Plugin JavaScript -->
<script src="js/jquery.easing.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/theme.js"></script>
</body>
</html>