<?php
	session_start(); //esse comando deve estar na primeira linha
	//você também poderá ativar o buffer usando o comando ob_start que evita alguns erros
	ob_start(); //ob_start — Ativa o buffer de saída
	//Se o cliente acessar essa pagina sem preencher a anterior
	if(empty($_POST["invUni"])){
		header('Location:ProjectNow.php');  
	}
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
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
   	<script>
		window.location.href='#ancora';
	</script>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	
<!-- Menu Superior -->
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


<!-- Calculos -->
<?php
	//Função de Calculo do Caldal em função do tempo
	//include 'FlowRateFunction.php';

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
	$Qi = ($_SESSION["Qi"]);
	$pInd = ($_SESSION["pInd"])/100;
	$length = floor(100/$_SESSION["t"])+1;
	$timePercent = array($length);
	$time = array($length);
	$timePercent[0] = 0;
	$time[0] = 0;
	
	for ($i=1; $i<($length); $i++){
		$time[$i] = $time[$i-1]+$t;
		$timePercent[$i] = $timePercent[$i-1]+$_SESSION["t"];
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
			$delta = 0.919; 			
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
			$alpha = 3.5;
			$beta = 1.333; 
			$qui = 6;
			$delta = 0.905;
			break;
	}

	//Variáveis de simulação
	$hHidr = array($length);
	$hCheia = array($length);
	$P = array($length);
	$PDG = array($length); // DOIS GRUPOS
	$Qdisponivel = array($length);
	$Qusado = array($length);
	$Etotal = 0;
	$EtotalDG = 0; // DOIS GRUPOS
	$QusadoDG = array($length); // DOIS GRUPOS
	$hHidrDG = array($length); // DOIS GRUPOS
	$QrevisedDG = array($length); // DOIS GRUPOS
	$hCheiaDG = array($length); // DOIS GRUPOS

	//Cálulo da Potência, Caudais e Energia
	for ($i=0; $i<($length); $i++){
		$Qdisponivel[$i] =  max($Qi[$i]-$Qr, 0);
		$Qusado[$i] =  min($Qdisponivel[$i], $Qn);
		$QusadoDG[$i] =  min($Qdisponivel[$i], $Qn/2); // DOIS GRUPOS
		$hHidr[$i] = $Hb*$pHidrMax*pow($Qusado[$i]/$Qn,2);
		$hHidrDG[$i] = $Hb*$pHidrMax*pow($QusadoDG[$i]/($Qn/2),2); // DOIS GRUPOS
		$Qrevised = max($Qi[$i]-$Qn,0);
		$QrevisedDG = max($Qi[$i]-$Qn/2,0); // DOIS GRUPOS
		$hCheia[$i] = $hCheiaMax*pow($Qrevised/($Qi[0]-$Qn),2);
		$hCheiaDG[$i] = $hCheiaMax*pow($QrevisedDG/($Qi[0]-$Qn/2),2); // DOIS GRUPOS
		if (($_SESSION['TypeTurbine']) == 'Francis'){
			$beta = 1.1173*pow($Hb-$hHidr[$i],0.025);
			$betaDG = 1.1173*pow($Hb-$hHidrDG[$i],0.025); // DOIS GRUPOS
  			$qui = 3.94-11.7*pow($Hb-$hHidr[$i],-0.5);
  			$quiDG = 3.94-11.7*pow($Hb-$hHidrDG[$i],-0.5); // DOIS GRUPOS
        }
        else{
        	$betaDG = $beta;
        	$quiDG = $qui;
        }
		$nt = max((1-$alpha*pow(abs(1-$beta*$Qusado[$i]/$Qn),$qui))*$delta,0);
		$ntDG = max((1-$alpha*pow(abs(1-$betaDG*$QusadoDG[$i]/($Qn/2)),$quiDG))*$delta,0); // DOIS GRUPOS
		$P[$i] = max((9810/1000)*$Qusado[$i]*($Hb-($hHidr[$i]+$hCheia[$i]))*$nt*$ng*$nTrafo*(1-$pDiv),0);
		$PDG[$i] = max((9810/1000)*$QusadoDG[$i]*($Hb-($hHidrDG[$i]+$hCheiaDG[$i]))*$nt*$ng*$nTrafo*(1-$pDiv),0); // DOIS GRUPOS
		if($i > 0){
			$Etotal = $Etotal + ($P[$i-1]+$P[$i])/2;
			$EtotalDG = $EtotalDG + ($PDG[$i-1]+$PDG[$i])/2; // DOIS GRUPOS
		}		
		//echo "Qi = ".$Qi[$i]." Qdisponivel = ".$Qdisponivel[$i]." Qusado = ".$Qusado[$i]." Qn = ".$Qn." hHidr = ".$hHidr[$i]." hCheia = ".$hCheia[$i]." P".$P[$i]." E".$Etotal." <br>";
	}
	$Etotal = $Etotal*0.05*8760*(1-$pInd);
	$EtotalDG = $EtotalDG*0.05*8760*(1-$pInd); // DOIS GRUPOS
	
	//Cálculo da potência nominal
	if (($_SESSION['TypeTurbine']) == 'Francis'){
	 	$beta = 1.1173*pow($Hb*(1-$pHidrMax),0.025); //1,1823
 		$qui = 3.94-11.7*pow($Hb*(1-$pHidrMax),-0.5); //0,1638
    }
	$ntN = max((1-$alpha*pow(abs(1-$beta),$qui))*$delta,0);
	$hHidrN = $Hb*$pHidrMax;
	$Pn = 9810/1000*$Qn*($Hb-$hHidrN)*$ntN*$ng*$nTrafo*(1-$pDiv);
	$PnDG = 9810/1000*($Qn/2)*($Hb-$hHidrN)*$ntN*$ng*$nTrafo*(1-$pDiv); // DOIS GRUPOS

	// Análise econômica
	//$hFun = $_POST["hFun"]; //Horas de funcionamento AQUI
	$invUni = $_POST["invUni"]; //Investimento unitário ($/kW) AQUI
	$txAt = $_POST["txAt"]/100; //Taxa de atualização AQUI
	$venEner = $_POST["venEner"]; //Venda de energia em $/MWh AQUI
	$encManu = $_POST["encManu"]/100; //Encargos com manutenção AQUI 
	$anos = $_POST["anos"]; //Anos a considerar AQUI

	$invIni = max($Pn*$invUni,0.0001); //Investimento inical
	$invIniDG = max($PnDG*2*$invUni,0.0001); // DOIS GRUPOS
	//$receiAnu = $hFun*$Pn*$venEner/1000; //Receita anual
	$receiAnu = $Etotal*$venEner/1000; //Receita anual
	//$receiAnuDG = $hFun*$Pn*2*$venEner/1000; // DOIS GRUPOS
	$receiAnuDG = $EtotalDG*$venEner/1000; // DOIS GRUPOS
	$despInvAnu = $invIni*$encManu; //Manunenção anual
	$despInvAnuDG = $invIniDG*$encManu; // DOIS GRUPOS
	$fluxoMo = $receiAnu-$despInvAnu; //fluxo monetário
	$fluxoMoDG = $receiAnuDG-$despInvAnuDG; // DOIS GRUPOS
	
	$cashFlow = array($anos);
	$cashFlow[0] = -$invIni;
	$cashFlowAtu = array($anos);
	$cashFlowAtu[0] = -$invIni;
	$cashFlowAtAcu = array($anos);
	$cashFlowAtAcu[0] = -$invIni;

	// DOIS GRUPOS
	$cashFlowDG = array($anos);
	$cashFlowDG[0] = -$invIni;
	$cashFlowAtuDG = array($anos);
	$cashFlowAtuDG[0] = -$invIniDG;
	$cashFlowAtAcuDG = array($anos);
	$cashFlowAtAcuDG[0] = -$invIniDG;
	
	for($c = 1; $c <= $anos; $c++){
		$cashFlow[$c] = $fluxoMo;
	    $cashFlowAtu[$c] = $cashFlow[$c]/(pow(1+$txAt,$c));
	    $cashFlowAtAcu[$c] = $cashFlowAtAcu[$c-1]+$cashFlowAtu[$c];
	}

	// DOIS GRUPOS
	for($c = 1; $c <= $anos; $c++){
		$cashFlowDG[$c] = $fluxoMoDG;
	    $cashFlowAtuDG[$c] = $cashFlowDG[$c]/(pow(1+$txAt,$c));
	    $cashFlowAtAcuDG[$c] = $cashFlowAtAcuDG[$c-1]+$cashFlowAtuDG[$c];
	}
	
	//VAL
	$VAL = 0;
	for($c = 0; $c <= $anos; $c++){
		$VAL += $cashFlowAtu[$c];	
	}

	//VAL // DOIS GRUPOS
	$VALDG = 0;
	for($c = 0; $c <= $anos; $c++){
		$VALDG += $cashFlowAtuDG[$c];	
	}

	//TIR
	$TIRAnt =(($fluxoMo)/$invIni)*((pow(1+$txAt,$anos-1))/pow(1+$txAt,$anos));
	$VALCal = $VAL;
	$erro = 1;
	
	while (abs($erro) > 0.00001){
	   $TIR = (($fluxoMo)/$invIni)*((pow(1+$TIRAnt,$anos-1))/pow(1+$TIRAnt,$anos));
	   $erro = $TIR - $TIRAnt;
	   $TIRAnt = $TIR;
	}

	//TIR // DOIS GRUPOS
	$TIRAntDG =(($fluxoMoDG)/(2*$invIni))*((pow(1+$txAt,$anos-1))/pow(1+$txAt,$anos));
	$VALCalDG = $VALDG;
	$erro = 1;
	
	while (abs($erro) > 0.00001){
	   $TIRDG = (($fluxoMoDG)/(2*$invIni))*((pow(1+$TIRAntDG,$anos-1))/pow(1+$TIRAntDG,$anos));
	   $erro = $TIRDG - $TIRAntDG;
	   $TIRAntDG = $TIRDG;
	}
?>

<!-- Seção do Conteúdo -->
<section id="about">
	<div class="container text-center">
		<div class="container text-center col-lg-10 col-lg-offset-1 col-md-13 col-md-offset-5 col-md-6">
			<h3><br> <br> <br> Results for one turbine <br></h3>
		</div>
		<br><br><br>
		<table style="width:50%"  align="center" class="table">
			<tbody>
				<tr>
					<th align="left">Total Year Energy: </th>
					<th align="rigth"><?php 
						if($Etotal<1000){
							echo "".number_format($Etotal, 2)." kWh";
						}
						else{
							echo " ".number_format($Etotal/1000, 2)." MWh";
						} ?>		
					</th>
				</tr>
				<tr>
					<th align="left">Nominal Power:</th>
					<th align="rigth"><?php echo "".number_format($Pn, 2)." kW"; ?></th>
				</tr>
				<tr>
					<th align="left">Net Present Value (NPV):</th>
					<th align="rigth"><?php 
						if ($VAL<0) {
							echo "".number_format($VAL, 2)." € | Nooo! :(";
						}
						else{
							echo "".number_format($VAL, 2)." € | It's ok :)";
						} ?>
					</th>
				</tr>
				<tr>
					<th align="left">Approximate Internal Rate of Return (IRR): </th>
					<th align="rigth"><?php 
						if ($TIR<$txAt) {
							echo "".number_format(100*$TIR, 2)." % | Nooo! :(";
						}
						else{
							echo "".number_format(100*$TIR, 2)." % | It's ok :)";
						}?>
					</th>
				</tr>
			<tbody>
		</table>

		<div class="container text-center col-lg-10 col-lg-offset-1 col-md-13 col-md-offset-5 col-md-6">
			<h3><br> <br> <br> Results for two turbines <br></h3>
		</div>
		<br><br><br>
		<table style="width:50%"  align="center" class="table">
			<tbody>
				<tr>
					<th align="left">Total Year Energy: </th>
					<th align="rigth"><?php 
						if($EtotalDG<1000){
							echo "".number_format(2*$EtotalDG, 2)." kWh";
						}
						else{
							echo " ".number_format(2*$EtotalDG/1000, 2)." MWh";
						} ?>		
					</th>
				</tr>
				<tr>
					<th align="left">Nominal Power of Each Turbine:</th>
					<th align="rigth"><?php echo "".number_format($PnDG, 2)." kW"; ?></th>
				</tr>
				<tr>
					<th align="left">Net Present Value (NPV):</th>
					<th align="rigth"><?php 
						if ($VALDG<0) {
							echo "".number_format($VALDG, 2)." € | Nooo! :(";
						}
						else{
							echo "".number_format($VALDG, 2)." € | It's ok :)";
						} ?>
					</th>
				</tr>
				<tr>
					<th align="left">Approximate Internal Rate of Return (IRR): </th>
					<th align="rigth"><?php 
						if ($TIRDG<$txAt) {
							echo "".number_format(100*$TIRDG, 2)." % | Nooo! :(";
						}
						else{
							echo "".number_format(100*$TIRDG, 2)." % | It's ok :)";
						}?>
					</th>
				</tr>
			<tbody>
		</table>

		<br><br><br>
		<h3><a href="#" id="ancora"></a><br><br> <br> Graphics </h3>
		<br>
		<table style="width:80%" align="center" class="table">
			<tbody>
				<tr>
					<th align="left">
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
									}, { 
										data: [<?php 
										for ($i=0; $i<($length); $i++){
											echo "".$QusadoDG[$i].", ";
										} ?>],
										label: "Used Flow Rate for 2 turbines",
										borderColor: "#ff0080",
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
					</th>
				</tr>
			<tbody>
		</table>
		<br><br><br>
		<table style="width:80%" align="center" class="table">
			<tbody>
				<tr>
					<th align="left">
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
											echo "".$hHidrDG[$i].", ";
										} ?>],
										label: "Hydraulic Losses for 2 turbines",
										borderColor: "#ff0080",
										fill: false
									}, { 
										data: [<?php 
										for ($i=0; $i<($length); $i++){
											echo "".$hCheia[$i].", ";
										} ?>],
										label: "Full Flow Losses",
										borderColor: "#8e5ea2",
										fill: false
									}, { 
										data: [<?php 
										for ($i=0; $i<($length); $i++){
											echo "".$hCheiaDG[$i].", ";
										} ?>],
										label: "Full Flow Losses for 2 turbines",
										borderColor: "#B45F04",
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
					</th>
				</tr>
			<tbody>
		</table>
		<br><br><br>
		<table style="width:80%" align="center" class="table">
			<tbody>
				<tr>
					<th align="left">
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
										fill: false,
										yAxisID: "y-axis-1",
									}, { 
										data: [<?php 
										for ($i=0; $i<($length); $i++){
											echo "".$PDG[$i].", ";
										} ?>],
										label: "Available Power for 2 turbines",
										borderColor: "#ff0080",
										fill: false,
										yAxisID: "y-axis-1",
									}, { 
										data: [<?php 
										for ($i=0; $i<($length); $i++){
											echo "".$Qusado[$i].", ";
										} ?>],
										label: "Used Flow",
										borderColor: "#8e5ea2",
										fill: false,
										yAxisID: "y-axis-2",
									}, { 
										data: [<?php 
										for ($i=0; $i<($length); $i++){
											echo "".$QusadoDG[$i].", ";
										} ?>],
										label: "Used Flow for 2 turbines",
										borderColor: "#B45F04",
										fill: false,
										yAxisID: "y-axis-2",
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
					                    		labelString: 'm³/s',
					                    	}
					                    }]
				                	}
								}
							});
						</script>
					</th>
				</tr>
			<tbody>
		</table>
		</div>
		<br> <br> <br>
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