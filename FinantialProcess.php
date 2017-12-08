<form name="AllInputsC" action="Result.php" method="post" id="Entrada" class="form-horizontal">
	<table style="width:50%" align="center">
		<tr>
			<th align="left">Work Hours per Years (Hours/Years): </th>
			<th align="rigth"><input type="number" class="form-control" name="hFun" id="hFun" placeholder="hFun" min="0" max="5000" step=0.1 required></th> 
		</tr>
		<tr>
			<th align="left">Initial Unit Investiment ($) : </th>
			<th align="rigth"><input type="number" class="form-control"  name="invUni" id="invUni" placeholder="invUni" min="1"  step=1 required></th> 
		</tr>
		<tr>
			<th align="left">Annual Update rate (%): </th>
			<th align="rigth"><input type="number" class="form-control"  name="txAt" id="txAt" placeholder="txAt" min="0" max="100" step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">MW Price ($/MWh): </th>
			<th align="right"><input type="number" class="form-control"  name="venEner" id="venEner" placeholder="venEner" min="0" step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">Maintenance Costs (%): </th>
			<th align="rigth"><input type="number" name="encManu" id="encManu" class="form-control"  placeholder="encManu" min="0"  step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">Time Lapse (Years): </th>
			<th align="rigth"><input type="number" name="anos"  id="anos" class="form-control"  placeholder="anos" min="0" max="50" step=0.001 required></th> 
		</tr>
	</table>
	<br>
	<br>
	<button type="submit" Name="Submit"  class="btn btn-primary">Next</button>
</form>
<br>
<br>
<table style="width:50%" align="center">
	<tr>
		<th align="left"><button onclick="myFunctionC()" class="btn btn-secondary">Try Exemple</button></th>
		<th align="rigth"></th>
	</tr>
</table>