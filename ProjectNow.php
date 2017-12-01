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
			<a href="ProjectNow.html">Project Now</a>
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

<!-- About Section -->
<section id="about">
<div class="container text-center">
	<div class="container text-center">
		<h3><br> <br> <br> Enter the Hydroelectric Resource Data <br></h3>
		<form>
			<div class="col-lg-11 col-lg-offset-2 col-md-13 col-md-offset-5">
				<table style="width:70%">
					<tr>
						<th align="left">Gross head (Meters): </th>
						<th align="rigth"><input type="number" class="form-control" id="Hb" placeholder="Hb" min="1" max="5000"></th> 
					</tr>
					<tr>
						<th align="left">Time Interval (Days) : </th>
						<th align="rigth"><input type="number" class="form-control" id="t" placeholder="t" min="1" max="365"></th> 
					</tr>
					<tr>
						<th align="left">The Flow Rate Function (In t Terms): </th>
						<th align="rigth"><input type="text" class="form-control" id="Qt" placeholder="Q(t)" size=10></th> 
					</tr>
					<tr>
						<th align="left">The Maximum Load Losses Value (%): </th>
						<th align="rigth"><input type="number" class="form-control" id="pHidrMax" placeholder="pHidrMax" min="0" max="100"></th> 
					</tr>
					<tr>
						<th align="left">Maximum Decrease in Gross Head due to Full Flow (Meters): </th>
						<th align="right"><input type="number" class="form-control" id="hCheiaMax" placeholder="hCheiaMax" min="0" max="5000"></th> 
					</tr>
					<tr>
						<th align="left">Generator Efficienc (%): </th>
						<th align="rigth"><input type="number" class="form-control" id="ng" placeholder="ng" min="0" max="100"></th> 
					</tr>
					<tr>
						<th align="left">Transformer Efficienc (%): </th>
						<th align="rigth"><input type="number" class="form-control" id="nTrafo" placeholder="nTrafo" min="0" max="100"></th> 
					</tr>
					<tr>
						<th align="left">Other Electric Losses (%): </th>
						<th align="rigth"><input type="number" class="form-control" id="pDiv" placeholder="pDiv" min="0" max="100"></th> 
					</tr>
					<tr>
						<th align="left">Nominal Flow Rate (meters): </th>
						<th align="rigth"><input type="number" class="form-control" id="Qn" placeholder="Qn" min="0" max="100"></th> 
					</tr>
					<tr>
						<th align="left">Compensation Flow (meters): </th>
						<th align="rigth"><input type="number" class="form-control" id="Qr" placeholder="Qr" min="0" max="100"></th> 
					</tr>
				</table>
				<table style="width:70%">
					<tr>
						<th align="left">Type of Turbine: </th>
						<th align="rigth"><select class="form-control" id="typeOfTurbine">
								<option>Helix</option>
								<option>Kaplan</option>
								<option>Francis</option>
								<option>Pelton</option>
							</select>
						</th>
					</tr>
				</table>
				<br> <br> <br>
			</div>
		</form>
		
		<button id="Begin" type="submit" class="btn btn-primary">Project</button>
		
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