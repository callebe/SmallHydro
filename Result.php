<!DOCTYPE html>
<html lang="en">

<head>
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
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	
<!-- Menu Superior -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
			<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand page-scroll" href="index.html">
			Project Your Small Hydro </a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
			<ul class="nav navbar-nav">
				<li>
				<a href="index.html">Home</a>
				</li>
				<li>
				<a href="ProjectNow.php">Project Now</a>
				</li>
				<li>
				<a href="InvolvedTheory.html">Involved Theory</a>
				</li>
				<li>
				<a href="Contact.html">Contact</a>
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
					<h1 class="brand-heading">Projec Tool</h1>
					<p> </p>
					<a href="#about" class="btn btn-circle page-scroll">
						<i class="fa fa-angle-double-down animated"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</header>

<!-- Funções PHP Principais --!>
<!-- Criação da Função Q(t) -->
<?php
	if($_SESSION['TypeQt'] == "Function"){
		// diretório onde encontra-se o arquivo
		$filename = "FlowRateFunction.php";
		// verifica se existe o arquivo
		if(file_exists($filename)){
			$script = file_get_contents($filename);
		} 
		else {
			$script = "";
		}
		//Adciona um novo texto
		$s = "<?php \n function FlowRateFunction(\$t) {\n \$R = ".$_POST["Qt"]."; \n return \$R; }\n ?>";
		//Escrevendo
		$file = @fopen($filename, "w+");
		@fwrite($file, $s);
		@fclose($file);	
   }
?>

<!-- Calculos -->
<?php
	//Função de Calculo do Caldal em função do tempo
	include 'FlowRateFunction.php';

    session_start(); # Deve ser a primeira linha do arquivo


	//Trazendo variaveis de Forms para o cálculo
	$Hb = $_SESSION['Hb'];
	$t = 365*$_SESSION['t']/100;
	$pHidrMax = ($_SESSION['pHidrMax'])/100;
	$hCheiaMax = ($_SESSION['hCheiaMax']);
	$ng = ($_SESSION['ng'])/100;
	$nTrafo = ($_SESSION['nTrafo'])/100;
	$pDiv = ($_SESSION['pDiv'])/100;
	$Qn = ($_SESSION['Qn']);
	$Qr = ($_SESSION['Qr']);
	$length = floor(100/$_SESSION["t"])+1;
	$timePercent = array($length);
	$time = array($length);
	$timePercent[0] = 0;
	$time[0] = 0;

	
	for ($i=1; $i<($length); $i++){
		$time[$i] = $time[$i-1]+$t;
		$timePercent[$i] = $timePercent[$i-1]+$_SESSION["t"];
	}

	
	if($_SESSION['TypeQt'] == "Function"){
    	for ($i=0; $i<($length); $i++){
			$Qi[$i] = FlowRateFunction($time[$i]);
		}
    	
    }else{
     	$Qi = $_POST["Qi"];
    }

    //echo "Hb = ".$Hb." t=".$t." pHidrMax = ".$pHidrMax." hCheiaMax = ".$hCheiaMax." ng = ".$ng." nTrafo = ".$nTrafo." pDiv = ".$pDiv." Qn = ".$Qn." Qr = ".$Qr." Type Turbine = ".$_SESSION['TypeTurbine']." TypeQt = ".$_SESSION['TypeQt']." <br>";

	//Selecionando variáveis com base no tipo de Turbina
	switch ($_SESSION['TypeTurbine']) {
		case 'Helix':
			$alpha = 1.25;
			$beta = 1; 
			$qui = 1.13;
			$delta = 0.905;
			break;

		case 'Kaplan':
			$alpha = 3.5;
			$beta = 1.333; 
			$qui = 6;
			$delta = 0.905;
			break;
		
		case 'Francis':
			$alpha = 1.25;
			$beta = 0.919; 			
			break;

		case 'Pelton1':
			$alpha = 1.31+0.25*1;
			$beta = pow(0.662+0.001*1,-1); 
			$qui = 5.6+0.4*1;
			$delta = 0.864;
			break;

		case 'Pelton2':
			$alpha = 1.31+0.25*2;
			$beta = pow(0.662+0.001*2,-1); 
			$qui = 5.6+0.4*2;
			$delta = 0.864;
			break;

		default:
			$alpha = 1;
			$beta = 1; 
			$qui = 1;
			$delta = 1;
			break;
	}

	$hHidr = array($length);
	$hCheia = array($length);
	$P = array($length);
	$Qdisponivel = array($length);
	$Qusado = array($length);
	$Etotal = 0;

	for ($i=0; $i<($length); $i++){
		$Qdisponivel[$i] =  max($Qi[$i]-$Qr, 0);
		$Qusado[$i] =  min($Qdisponivel[$i], $Qn);
		$hHidr[$i] = $Hb*$pHidrMax*pow($Qusado[$i]/$Qn,2);
		$Qrevised = max($Qi[$i]-$Qn,0);
		$hCheia[$i] = $hCheiaMax*pow($Qrevised/($Qi[0]-$Qn),2);
		if (($_SESSION['TypeTurbine']) =='Francis'){
			$beta = 1.1173*pow($Hb-$hHidr[$i],0.025);
  			$qui = 3.94-11.7*pow($Hb-$hHidr[$i],-0.5);
        }
		$nt = max(1-$alpha*pow(abs(1-$beta*$Qusado[$i]/$Qn),$qui)*$delta,0);
		$P[$i] = 9810*$Qusado[$i]*($Hb-($hHidr[$i]+$hCheia[$i]))*$nt*$ng*$nTrafo*(1-$pDiv)/(1000);
		if($i > 0){
			$Etotal += ($P[$i-1]+P[i])/2*5/100*8760*(1-4/100);
		}
		
		//echo "Qi = ".$Qi[$i]." Qdisponivel = ".$Qdisponivel[$i]." Qusado = ".$Qusado[$i]." Qn = ".$Qn." hHidr = ".$hHidr[$i]." hCheia = ".$hCheia[$i]." P".$P[$i]." E".$Etotal." <br>";
	}

	if (($_SESSION['TypeTurbine']) =='Francis'){
	 	$QdisponivelN =  max($Qn-$Qr, 0);
	 	$QusadoN =  min($QdisponivelN, $Qn);
	 	$hHidrN = $Hb*$pHidrMax*pow($QusadoN/$Qn,2);
		$beta = 1.1173*pow($Hb-$hHidrN,0.025);
 		$qui = 3.94-11.7*pow($Hb-$hHidrN,-0.5);
    }
	$ntN = max(1-$alpha*pow(abs(1-$beta),$qui)*$delta,0);
	$hHidrN = $Hb*$pHidrMax;
	$Pn = 9810/1000*$Qn*($Hb-$hHidrN)*$ntN*$ng*$nTrafo*(1-$pDiv);
?>

<!-- Seção do Conteúdo -->
<section id="about">
	<div class="container text-center">
		<div class="container text-center col-lg-10 col-lg-offset-1 col-md-13 col-md-offset-5 col-md-6">
			<h3><br> <br> <br> Results <br></h3>
		</div>
		<br><br><br>
		<table style="width:30%" align="center" class="table">
			<tbody>
				<tr>
					<th align="left">Total Year Energy: </th>
					<th align="rigth"><?php 
						if($Etotal<1000){
							echo "".number_format($Etotal, 3)." kWh";
						}
						else{
							echo "".number_format($Etotal/1000, 3)." MWh";
						} ?>		
					</th>
				</tr>
				<tr>
					<th align="left">Nominal Power:</th>
					<th align="rigth"><?php echo "".number_format($Pn, 3)." kWh"; ?></th>
				</tr>
			<tbody>
		</table>
		<br><br><br>
		<h3><br> <br> <br> Graphics <br></h3>
		<br><br><br>
		<div class="container text-center">
			</canvas><canvas id="FlowDurationCurveDuringTheYear"></canvas>
			<script type="text/javascript">
				var ctx = document.getElementById('FlowDurationCurveDuringTheYear').getContext('2d');
				new Chart(document.getElementById("FlowDurationCurveDuringTheYear"),{
					type: 'line',
					data: {
						labels: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$timePercent[$i].", ";
							} ?>],
						datasets: [{ 
							data: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$Qi[$i].", ";
							} ?>],
							label: "Flow Duration",
							borderColor: "#3e95cd",
							fill: false
						}, { 
							data: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$Qdisponivel[$i].", ";
							} ?>],
							label: "Available Flow Rate",
							borderColor: "#8e5ea2",
							fill: false
						}, { 
							data: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$Qusado[$i].", ";
							} ?>],
							label: "Used Flow Rate",
							borderColor: "#3cba9f",
							fill: false
						}]
					},
					options: {
						responsive: true,
						title: {
							display: true,
							text: 'Flow Duration Curve During the Year'
						},
						scales: {
	                    xAxes: [{
	                        display: true,
	                        scaleLabel: {
	                            display: true,
	                            labelString: 'Percent of Years (%)'
	                        }
	                    }],
	                    yAxes: [{
	                        display: true,
	                        scaleLabel: {
	                            display: true,
	                            labelString: 'm³/s'
	                        }
	                    }]
	                	}
					}
				});
			</script>
		</div>
		<br><br><br>
		<div class="container text-center">
			</canvas><canvas id="Loss Heights"></canvas>
			<script type="text/javascript">
				var ctx = document.getElementById('Loss Heights').getContext('2d');
				new Chart(document.getElementById("Loss Heights"),{
					type: 'line',
					data: {
						labels: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$timePercent[$i].", ";
							} ?>],
						datasets: [{ 
							data: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$hHidr[$i].", ";
							} ?>],
							label: "Hydraulic Losses",
							borderColor: "#3e95cd",
							fill: false
						}, { 
							data: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$hCheia[$i].", ";
							} ?>],
							label: "Full Flow Losses",
							borderColor: "#8e5ea2",
							fill: false
						}]
					},
					options: {
						responsive: true,
						title: {
							display: true,
							text: 'Loss Heights'
						},
						scales: {
	                    xAxes: [{
	                        display: true,
	                        scaleLabel: {
	                            display: true,
	                            labelString: 'Percent of Years (%)'
	                        }
	                    }],
	                    yAxes: [{
	                        display: true,
	                        scaleLabel: {
	                            display: true,
	                            labelString: 'Altitude (m)'
	                        }
	                    }]
	                	}
					}
				});
			</script>
		</div>
		<br><br><br>
		<div class="container text-center">
			</canvas><canvas id="AvailableElectricPower"></canvas>
			<script type="text/javascript">
				var ctx = document.getElementById('AvailableElectricPower').getContext('2d');
				new Chart(document.getElementById("AvailableElectricPower"),{
					type: 'line',
					data: {
						labels: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$timePercent[$i].", ";
							} ?>],
						datasets: [{ 
							data: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$P[$i].", ";
							} ?>],
							label: "Available Power",
							borderColor: "#3e95cd",
							fill: false
						}, { 
							data: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$Qusado[$i].", ";
							} ?>],
							label: "Used Flow",
							borderColor: "#8e5ea2",
							fill: false
						}]
					},
					options: {
						responsive: true,
						title: {
							display: true,
							text: 'Available Electric Power'
						},
						scales: {
	                    xAxes: [{
	                        display: true,
	                        scaleLabel: {
	                            display: true,
	                            labelString: 'Percent of Years (%)'
	                        }
	                    }],
	                    yAxes: [{
	                        display: true,
	                        scaleLabel: {
	                            display: true,
	                            labelString: 'Power (kW)'
	                        }
	                    }]
	                	}
					}
				});
			</script>
		</div>
		<br> <br><br>
		<div class="container text-center">
			</canvas><canvas id="AvailableElectricPower"></canvas>
			<script type="text/javascript">
				var ctx = document.getElementById('AvailableElectricPower').getContext('2d');
				new Chart(document.getElementById("AvailableElectricPower"),{
					type: 'line',
					data: {
						labels: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$timePercent[$i].", ";
							} ?>],

						datasets: [{ 
							label: "Available Power",
							borderColor: "#3e95cd",
							fill: false,
							data: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$P[$i].", ";
							} ?>], 
							yAxisID: "y-axis-1",
        					},{ 
        					label: "Used Flow Rate",
							borderColor: "#8e5ea2",
							fill: false,	
							data: [<?php 
							for ($i=0; $i<($length); $i++){
								echo "".$Qusado[$i].", ";
							} ?>],
							yAxisID: "y-axis-2"
							
						}]
					},
					options: {
						responsive: true,
						title: {
							display: true,
							text: 'Available Electric Power'
						},
						scales: {
	                    xAxes: [{
	                        display: true,
	                        scaleLabel: {
	                            display: true,
	                            labelString: 'Percent of Years (%)'
	                        }
	                    }],
	                    yAxes: [{
	                    	type: "linear",
	                        display: true,
	                        position: "left",
	                        id: "y-axis-1",
	                        scaleLabel: {
	                            display: true,
	                            labelString: 'Power (kW)'
	                        }
	                    },{
	                    	gridLines: {drawOnChartArea: false,},	
	                    	type: "linear",
							display: true,
							position: "right",
							id: "y-axis-2",
							scaleLabel: {
								display: true,
								labelString: 'm^3/s'
							}

	                    }]
	                	}
					}
				});
			</script>
		</div>
		<br> <br> <br>
	</div>
</section>

<!-- Rodapé -->
<footer>
	<div class="container text-center">
		<p class="credits">
			Copyright &copy; S. B.<br/>
		</p>
	</div>
</footer>

<!-- Includes -->
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