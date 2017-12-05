<form name="AllInputs" action="ProjectNow.php" method="post" id="Entrada" class="form-horizontal">
	<table style="width:50%" align="center">
		<tr>
			<th align="left">Gross head (Meters): </th>
			<th align="rigth"><input class="form-control" type="number" class="form-control" name="Hb" id="Hb" placeholder="Hb" min="0" max="5000" step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">Time Interval (% of Years) : </th>
			<th align="rigth"><input type="number" class="form-control" class="form-control" name="t" id="t" placeholder="t" min="1" max="365" step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">The Maximum Load Losses Value (%): </th>
			<th align="rigth"><input type="number" class="form-control"  name="pHidrMax" id="pHidrMax" placeholder="pHidrMax" min="0" max="100" step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">Maximum Decrease in Gross Head due to Full Flow (Meters): </th>
			<th align="right"><input type="number" name="hCheiaMax" class="form-control"  name="hCheiaMax" id="hCheiaMax" placeholder="hCheiaMax" min="0" max="5000" step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">Generator Efficienc (%): </th>
			<th align="rigth"><input type="number" name="ng" id="ng" class="form-control"  placeholder="ng" min="0" max="100" step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">Transformer Efficienc (%): </th>
			<th align="rigth"><input type="number" name="nTrafo"  id="nTrafo" class="form-control"  placeholder="nTrafo" min="0" max="100" step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">Other Electric Losses (%): </th>
			<th align="rigth"><input type="number" name="pDiv" id="pDiv" class="form-control"  placeholder="pDiv" min="0" max="100" step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">Nominal Flow Rate (meters): </th>
			<th align="rigth"><input type="number" name="Qn" id="Qn" class="form-control"  placeholder="Qn" min="0" max="100" step=0.001 required></th> 
		</tr>
		<tr>
			<th align="left">Compensation Flow (meters): </th>
			<th align="rigth"><input type="number" name="Qr" id="Qr" class="form-control"  placeholder="Qr" min="0" max="100" step=0.001 required></th> 
		</tr>
	</table>
	<table style="width:50%" align="center">
		<tr>
			<th align="left">Type of Turbine: </th>
			<th align="rigth" class="col-xs-5"><select class="form-control" name="TypeTurbine">
					<option value="Kaplan">Kaplan</option>
					<option value="Helix">Helix</option>
					<option value="Francis">Francis</option>
					<option value="Pelton1">Pelton (1 Ozzle)</option>
					<option value="Pelton2">Pelton (2 Ozzle)</option>
				</select>
			</th>
		</tr>
	</table>
	<table style="width:50%" align="center">
		<tr>
			<th align="left">The Flow Rate:</th>
			<th align="rigth" class="col-xs-5"><select class="form-control" name="TypeQt">
					<option value="Function">Discribe by C Function</option>
					<option value="Discrete">In Discrete Terms</option>
				</select>
			</th>
		</tr>
	</table>
	<br>
	<table style="width:50%" align="center">
		<tr>
			<th align="left"><button onclick="myFunction()" class="btn btn-secondary">Try Exemple</button></th>
			<th align="rigth"></th>
		</tr>
	</table>
	<br><br><br>
	<button type="submit" Name="Submit"  class="btn btn-primary">Next</button>
</form>