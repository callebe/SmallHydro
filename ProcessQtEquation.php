<h3><a href="#" id="ancora"></a>Enter the Hydroelectric Resource Data</h3>

<form name="AllInputsA" action="ProjectNow.php" method="post"  class="form-horizontal">
	<table style="width:50%" align="center">
		<tr>
			<th align="left">The Flow Rate Function (In t Terms): </th>
			<th align="rigth"><input type="text" class="form-control" name="Qi"  id="Qi" placeholder="Q(t)" size=10 required></th> 
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
		<th align="left"><button onclick="myFunctionA()" class="btn btn-secondary">Try Exemple</button></th>
		<th align="rigth"></th>
	</tr>
</table>
<br>
<br>
<br>
<h6>Use these default functions for express math functions</h6>
<table style="width:30%"  align="center" class="table">
	<tbody>
		<tr>
			<th align="center"> x<sup>y</sup> </th>
			<th align="center"> pow(x, y) </th> 
		</tr>
		<tr>
			<th align="center"> log <sub>y</sub> x </th>
			<th align="center"> log(x, y) </th> 
		</tr>
		<tr>
			<th align="center"> ln x </th>
			<th align="center"> log(x, euler) </th> 
		</tr>
		<tr>
			<th align="center"> sin x </th>
			<th align="center"> sin (x) </th> 
		</tr>
		<tr>
			<th align="center"> cos x </th>
			<th align="center"> cos (x) </th> 
		</tr>
		<tr>
			<th align="center"> e <sup>x</sup> </th>
			<th align="center"> exp(x) </th> 
		</tr>
		<tr>
			<th align="center"> π </th>
			<th align="center"> pi </th> 
		</tr>
		<tr>
			<th align="center"> e </th>
			<th align="center"> euler </th> 
		</tr>
	</tbody>
</table>