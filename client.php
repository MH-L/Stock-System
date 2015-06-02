<!DOCTYPE html>
<head>
<title> Client Page -- Stock Operating System </title>
<link rel="stylesheet" type="text/css" href="styleSheet.css">
<link rel="icon" href="favicon.ico" type="image/ico"/>
<h1> Welcome to Client Page! </h1>
</head>
<script>

function isNumberKey(keyevent) {
	var charCode = (keyevent.which) ? keyevent.which : keyevent.keycode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}

	return true;
}

function searchStock() {
    var stockNum = document.getElementById("stockName").value;
	var rando = Math.random() * 10;
	var changeRate = (Math.random() - 0.5) * 22;
	rando = rando.toPrecision(2);
	changeRate = changeRate.toPrecision(2);
	if (stockNum.length != 6) {
        alert("The ID you entered is invalid since it must be a six-digit number!");
	} else if (stockNum > 0) {
	    document.write("The stock you requested is: ID: " + stockNum + ", Price: $" + rando);
		document.write("<br/>Today's rate of change: " + changeRate + "%");
	} else {
	    alert("The stock ID cannot be negative and must be pure six digit number!");
	}
}

function viewPortfolio() {
	document.getElementById('dispDiv').innerHTML = '';
	var userid = Math.random() * 900000 + 100000;
	var balance = Math.ceil(Math.random() * Math.pow(10, Math.ceil(Math.random() * 7)));
	document.write("<table border=\"2\"> <tr> <th> UserID </th> <th> Account Balance </th> </tr>");
	document.write("<tr> <td> " + userid.toPrecision(6) + "</td> <td> " + balance + "</td> </tr> </table>");
	viewStocks();
}

function viewStocks() {
	document.write("<br/> <br/> <table border=\"2\"> <tr> <th> StockID </th> <th> StockShare </th> <th> StockPrice </th> <tr>");
	var numIter = Math.ceil(Math.random() * 10 + 1);
	for (var t = 0; t < numIter; t++) {
		var stockID_ = Math.ceil(Math.random() * 900000 + 100000);
		var stockShare = Math.ceil(Math.random().toPrecision(3) * 10000);
		var stockPrice = (Math.random() * 22).toPrecision(4);
		document.write("<tr> <td> "  + stockID_ + "</td> <td>" + stockShare + "</td> <td>" + stockPrice + "</td> </tr>");
	}
	document.write("</table>");
}

</script>
<body>
<div align="center">
<form method="post" action="client.php">
	<font face="Calibri Light" color=#880000> Search Stock </font>
	<input type="text" id="stockName" size="13" name="stockToSearch" onkeypress="return isNumberKey(event)">
	<input type="submit" id="SubmitSearch" name="gogogo" value="go" style="width:40px;height:30px;font-size:3">
</form>
<br/> <br/>
<form method="post" action="client.php">
	<font face="calibri" color=#63237a size="6"> Compare stocks between clients: </font> <br/>
	<br/> <font face="calibri"> Enter the id of the first client: </font> 
	<input type="text" name="clientToCompare" maxlength="6" onkeypress="return isNumberKey(event)"> </br>
	<br/> <font face="calibri"> Enter the id of the second client: </font> 
	<input type="text" name="clientToCompare_" maxlength="6" onkeypress="return isNumberKey(event)">
	<input type="submit" name="compareGo" value="go" style="margin:5px">
</form>
<br/>
</div>
<div align="center">
	<form method="post" onsubmit="viewPortfolio();">
		<input type="submit" style="width:130px;height:35px" value="View Portfolio">
	</form>
</div>
<div align="center" id="dispDiv">

</div>
</body>

<?php 
// I think this one should not be echoed.
$success = True;
$db_conn = OCILogon("ora_f2w8", "a51102135", "ug");

function executePlainSQL($cmdstr) {
	global $db_conn, $success;
	$statement = OCIParse($db_conn, $cmdstr);

	if (!$statement) {
		echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
		$e = OCI_Error($db_conn); 
		echo htmlentities($e['message']);
		$success = False;
	}

	$r = OCI_Execute($statement, OCI_DEFAULT);
	if (!$r) {
		echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
		$e = oci_error($statement);
		echo htmlentities($e['message']);
		$success = False;
	} else {

	}
	return $statement;
}

function executeBoundedSQL($cmdstr, $list) {
	global $db_conn, $success;
	$statement = OCIParse($db_conn, $cmdstr);

	if (!$statement) {
		echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
		$e = OCI_Error($db_conn);
		echo htmlentities($e['message']);
		$success = False;
	}

	foreach ($list as $tuple) {
		foreach ($tuple as $bind => $val) {
			OCIBindByName($statement, $bind, $val);
			unset ($val);

		}
		$r = OCIExecute($statement, OCI_DEFAULT);
		if (!$r) {
			echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($statement);
			echo htmlentities($e['message']);
			echo "<br>";
			$success = False;
		}
	}
}

function checkCondition($idtocheck) {
	if ($idtocheck >= 0 && $idtocheck < 1000000 && !($idtocheck == "")) {
		return true;
	} else 
		return false;
}

function clientExists($clientid) {
	$query = "select count(*) from client where cid = " . $clientid;
	$res = executePlainSQL($query);
	$row = oci_fetch_array($res, OCI_BOTH);
	return ($row[0] >= 1);
}


function compareandshow($idone, $idtwo) {
	if (clientExists($idone) && clientExists($idtwo)) {
		$query = "select distinct stockid, price, rateofchange from stock where stockid in (select stockid from stock s, portfolio_detail p, client_has_account c where"
			   . " s.stockid = p.ticket and p.accountno = c.accountno and c.cid = " . $idone  
			   . ") and stockid in (select stockid from stock s, portfolio_detail p, client_has_account c where"
			   . " s.stockid = p.ticket and p.accountno = c.accountno and c.cid = " . $idtwo
			   . ")";
		$res = executePlainSQL($query);
		echo "<center> <h2> The stock both clients have on their accounts are: </h2> </center> <br/>";
		echo "<div align='center'> <table border='2'> <tr> <th> Stock ID </th> <th> Price </th> <th> RateOfChange </th> </tr>";
		while ($row = oci_fetch_array($res, OCI_BOTH)) {
			echo "<tr> <td> <h3>" . $row[0] . "</h3> </td> <td> <h3>" . $row[1] . "</h3> </td> <td> <h3>" . $row[2] . "</h3> </td> </tr>";
		}
		echo "</table> </div>";
	} else {
		echo "<center> <h2> At least one of the client you entered does not exist. </h2> </center>";
	}
}


if ($db_conn) {
	if (array_key_exists('gogogo', $_POST)) {
		if (!checkCondition($_POST['stockToSearch'])) {
			echo "<h2><center>The stock ID you are searching must be within six digits!</center></h2>";
		} else {
			$cmdString = "select price, rateofchange from stock where stockid=" . $_POST['stockToSearch'];
			$resultStr = executePlainSQL($cmdString);
			$row = oci_fetch_array($resultStr, OCI_BOTH);
			if ($row == false) {
				echo "<h2> <center>THE stock does not exist in our database</center> </h2>";
			} else {
				echo "<h2> <center> The rate of change is " . $row["RATEOFCHANGE"] . "%, and the price is " . $row["PRICE"] . "</center> </h2>";
			}
		
		}
	} else if (array_key_exists('compareGo', $_POST)) {
		if (!checkCondition($_POST["clientToCompare_"]) || !(checkCondition($_POST["clientToCompare"]))) {
			echo "<center> <h2> The id's you entered are invalid. They must be all six pure digits.</h2> </center>";
		} else {
			compareandshow($_POST["clientToCompare_"], $_POST["clientToCompare"]);
		}
	}
} else {
	echo "cannot connect";
	$e = OCI_Error(); // For OCILogon errors pass no handle
	echo htmlentities($e['message']);
}




?>
</html>