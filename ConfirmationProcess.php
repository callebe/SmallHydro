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
$s = "<?php \n function Q(\$t) {\n \$R = ".$_POST["Qt"]."; \n return \$R; }\n ?>";
//Escrevendo
$file = @fopen($filename, "w+");
@fwrite($file, $s);
@fclose($file);
header('Location: Result.php'); 

?>