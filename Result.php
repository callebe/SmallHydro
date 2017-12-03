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
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js" integrity="sha256-vyehT44mCOPZg7SbqfOZ0HNYXjPKgBCaqxBkW3lh6bg=" crossorigin="anonymous"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js" integrity="sha256-N4u5BjTLNwmGul6RgLoESPNqDFVUibVuOYhP4gJgrew=" crossorigin="anonymous"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js" integrity="sha256-t3+U9BqykoMN9cqZmJ5Z53TvPv4V7S9AmjUcIWNNyxo=" crossorigin="anonymous"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" integrity="sha256-c0m8xzX5oOBawsnLVpHnU2ieISOvxi584aNElFl2W6M=" crossorigin="anonymous"></script>

	<script language="JavaScript">
		function Aba(pAba) {
			if (pAba == 0) {
				document.getElementById("Aba0").style.visibility = "visible";
				document.getElementById("Aba1").style.visibility = "hidden";
				document.getElementById("Aba2").style.visibility = "hidden";
				document.getElementById("tdAba0").className = "abaOn";
				document.getElementById("tdAba1").className = "abaOff";
				document.getElementById("tdAba2").className = "abaOff";
			}
			else 
			if (pAba == 1) {
				document.getElementById("Aba0").style.visibility = "hidden";
				document.getElementById("Aba1").style.visibility = "visible";
				document.getElementById("Aba2").style.visibility = "hidden";
				document.getElementById("tdAba0").className = "abaOff";
				document.getElementById("tdAba1").className = "abaOn";
				document.getElementById("tdAba2").className = "abaOff";
			}
			else
			if (pAba == 2) {
				document.getElementById("Aba0").style.visibility = "hidden";
				document.getElementById("Aba1").style.visibility = "hidden";
				document.getElementById("Aba2").style.visibility = "visible";
				document.getElementById("tdAba0").className = "abaOff";
				document.getElementById("tdAba1").className = "abaOff";
				document.getElementById("tdAba2").className = "abaOn";
			}
		}
	</script>
		
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	
<!-- Navigation -->
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
<!-- /.container -->
</nav>

<!-- Intro Header -->
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

<!-- About Section -->
<section id="about">

<?php
	// diretório onde encontra-se o arquivo
	$filename = "FlowRateFunction.php";
	// verifica se existe o arquivo
	if(file_exists($filename)){
	  $script = file_get_contents($filename);
	} else {
	  $script = "";
	}

	//Adciona um novo texto
	$s = "<?php \n function FlowRateFunction(\$t) {\n \$R = ".$_POST["Qt"]."; \n return \$R; }\n ?>";
	//Escrevendo
	$file = @fopen($filename, "w+");
	@fwrite($file, $s);
	@fclose($file);
	
?>

<div class="container text-center">
	<div class="container text-center col-lg-10 col-lg-offset-1 col-md-13 col-md-offset-5 col-md-6">
				
		<h3><br> <br> <br> Results <br></h3>

		<?php
			
			//Trazendo variaveis de Forms para o cálculo
			$Hb = ($_POST["Hb"]);
			$t = $_POST["t"];
			$pHidrMax = ($_POST["pHidrMax"])/100;
			$hCheiaMax = ($_POST["hCheiaMax"]);
			$ng = ($_POST["ng"])/100;
			$nTrafo = ($_POST["nTrafo"])/100;
			$pDiv = ($_POST["pDiv"])/100;
			$Qn = ($_POST["Qn"]);
			$Qr = ($_POST["Qr"]);
			$length = floor(365/($_POST["t"]));
			$time = array($length);
			$time[0] = 0;
			for ($i=1; $i<($length); $i++){
				$time[$i] = $time[$i-1]+$t;
			}
		
			//Selecionando variáveis com base no tipo de Turbina
			switch ($_POST["TypeTurbine"]) {
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
					$alpha = 1;
					$beta = 1; 
					$qui = 1;
					$delta = 1;
					break;

				default:
					$alpha = 1;
					$beta = 1; 
					$qui = 1;
					$delta = 1;
					break;
			}
			
			//Função de Calculo do Caldal em função do tempo
			include 'FlowRateFunction.php';
		
			$hHidr = array($length);
			$hCheia = array($length);
			$P = array($length);
			$Qdisponivel = array($length);
			$Qusado = array($length);
			$E = array($length);
			$Etotal = 0;
		
			for ($i=0; $i<($length); $i++){
				$Qi = FlowRateFunction($time[$i]);
				$Qdisponivel[$i] =  max($Qi-$Qr, 0);
				$Qusado[$i] =  min($Qdisponivel[$i], $Qn);
				$hHidr[$i] = $Hb*$pHidrMax*pow($Qusado[$i]/$Qn,2);
				$Qrevised = max($Qi-$Qn,0);
				$hCheia[$i] = $hCheiaMax*pow($Qrevised/($Qi[0]-$Qn),2);
				$nt = max(1-$alpha*pow(abs(1-$beta*$Qusado[$i]/$Qn),$qui)*$delta,0);
				$P[$i] = 9810*$Qusado[$i]*($Hb-($hHidr[$i]+$hCheia[$i]))*$nt*$ng*$nTrafo*(1-$pDiv)/(1000);
				if($i > 0){
					$E[$i] = ($P[$i-1]+P[i])/2*5/100*8760*(1-4/100);
				}
				$Etotal += $E[$i];

				echo "->".$time[$i]."<br>";
			}
			

		?>
		<div class="col-lg-11 col-lg-offset-1 col-md-13 col-md-offset-5 col-md-6" style="visibility: visible;">
			<table>
			<tr>
				<td id="tdAba0" class="abaOn" onClick="Aba(0)" title="LossHeight">
				<button Name="SubmitA"  class="btn btn-primary">Loss Heightt</button>
				</td>
				<td id="tdAba1" class="abaOff" onClick="Aba(1)" title="FlowDurationCurve"><button Name="SubmitB"  class="btn btn-primary">Flow Duration Curve</button>
				</td>
				<td id="tdAba2" class="abaOff" onClick="Aba(2)" title="ElectricPowerAvailable"><button Name="SubmitC"  class="btn btn-primary">Electric Power Available</button>
				</td>
				<td id="tdAba2" class="abaOff" onClick="Aba(2)" title="ProductivePower"><button Name="SubmitA"  class="btn btn-primary">Productive Power</button>
				</td>
				<td  class="abaNulo">&nbsp;
				</td>
			</tr>
			</table>
		</div>
		<div class="col-lg-11 col-lg-offset-2 col-md-13 col-md-offset-5 col-md-6" id="Aba0" style=" visibility: hidden;">
			<table>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Nome:</td>
					<td><input type="text" name="" size="30"></td>
				</tr>
				<tr>
					<td>Endereço:</td>
					<td><input type="text" name="" size="30"></td>
				</tr>
			</table>
		</div>

		<div class="col-lg-11 col-lg-offset-2 col-md-13 col-md-offset-5 col-md-6" id="Aba1" style=" visibility: hidden; position:absolute; top:640;">
			<table>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Tipo:</td>
					<td><input type="checkbox" name=""></td>
				</tr>
				<tr>
					<td>Endereço:</td>
					<td><input type="text" name="" size="30"></td>
				</tr>
			</table>
		</div>
		<div id="Aba2" style="height: 480px; width: 700px; left: 10px; top: 100px; visibility: hidden; position:absolute;">
			<table width="100%" border="0">
				<tr>
					<td>&nbsp;</td>
					</tr>
				<tr>
					<td>Código:</td>
					<td><input type="text" name="" size="30"></td>
				</tr>
				<tr>
					<td>Descrição:</td>
					<td><input type="text" name="" size="30"></td>
				</tr>
			</table>
		</div>
		<br>
		<canvas id="myChart" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        //labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            //label: '# of Votes',
            data: [{
            	x:0,
            	y:1
            }, {
            	x:1,
            	y:2
            }, {x:2,
            	y:3
            }, {x:3,
            	y:4
            }, {x:4,
            	y:5
            }, {x:5,
            	y:6
            }],
        }]
    },
    
});
</script>
		</div>
	</div>
		<h2><br> <br> <br></h2>
</div>

</section>

<!-- Footer -->
<footer>
<div class="container text-center">
	<p class="credits">
		Copyright &copy; Callebe SB<br/>
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