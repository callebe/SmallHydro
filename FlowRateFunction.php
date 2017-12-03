<?php 
 function FlowRateFunction($t) {
 $R = 25*exp(-$t/100); 
 return $R; }
 ?>