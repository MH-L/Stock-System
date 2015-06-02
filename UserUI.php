<!DOCTYPE html>
<!-- Author : Minghao Liu -->
<head>
<title> Administrator Page </title>
<link rel="stylesheet" type="text/css" href="styleSheet.css">
<link rel="icon" href="favicon.ico" type="image/ico"/>
<h1> Welcome to Administrator Page! </h1>
</head>
<script type="text/javascript">

function isNumberKey(keyevent) {
	var charCode = (keyevent.which) ? keyevent.which : keyevent.keycode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}

	return true;
}

function deleteStock() {
	var stockID = document.getElementById('stockToDel').value;
	if (stockID.length != 6) {
		alert("The stock ID you entered is invalid. It must be six digits.");
		return;
	} else if (!(stockID >= 0)) {
		alert("The stock ID must not be negative and must be pure digits.");
		return;
	} else {
		alert("You successfully deleted the stock with ID: " + stockID + ".\n Now the database is updating...");
	}
}

function deleteBroker() {
	var brokerID = document.getElementById('brokerToDel').value;
	if (brokerID.length != 6) {
		alert("The broker ID you entered is invalid. It must be six digits.");
		return;
	} else if (!(brokerID >= 0)) {
		alert("The broker ID must not be negative and must be pure digits!");
	} else {
		alert("You successfully deleted the broker with ID: " + brokerID + ".\n Now the database is updating...");
	}
}

function deleteClient() {
	var clientID = document.getElementById('clientToDel').value;
	if (clientID.length != 6) {
		alert("The client ID you entered is invalid. It must be six digits.");
		return;
	} else if (!(clientID >= 0)) {
		alert("The client ID must not be negative and must be pure digits!");
	} else {
		alert("You successfully deleted the client with ID: " + brokerID + ".\n Now the database is updating...");
	}
}

function resetTransaction() {
	document.getElementById("reactionDiv").innerHTML += '<p> <font face=\'calibri\'> All transaction records have been deleted! </font> </p>';
}

function deleteTransaction(numOfItem) {
    document.getElementById("reactionDiv").innerHTML = "";
	if (!(numOfItem >= 0)) {
		alert("The number of transactions you entered is invalid.\n It must be a non-negative number!");
		return;
	} else if (numOfItem > 100) {
		alert("The maximum number of transaction to be deleted is 100.\n Please delete them in several times or you can \njust reset all transactions.");
	} else {
		for (var i = 0; i < numOfItem; i++) {
			document.getElementById("reactionDiv").innerHTML += "<p> <font face=\"calibri\"> The transaction with number " + i + " is successfully deleted. </font> </p>";
		}
	}
}

function onloadFunc() {
	var newDiv = document.createElement('div');
	newDiv.id = "theNewDiv";
	newDiv.style.width= "100%";
	newDiv.style.height = "90%";
	newDiv.style.position = "absolute";
	newDiv.style.top = "280px";
	newDiv.style.background = "#E6E6FA";
	document.body.appendChild(newDiv);
}

</script>
<body bgcolor=#E6E6FA>
	<div align="center">
		<form method="post" action="UserUI.php"> 
			<font face="calibri" color=#00ff00 size="6"> Delete Stock </font> 
			<br/> <font face="calibri"> Stock ID: </font>
			<input type="text" value="" maxlength="6" id="stockToDel" 
				onkeypress="return isNumberKey(event)" name="00000" style="margin:5px" />
			<input type="submit" value="Delete!" id="deleteStockButton" name="22222" style="margin:5px" />
		</form>
		<form method="post" action="UserUI.php">
			<font face="calibri" color=#0000ff size="6"> Delete Broker </font>
			<br/> <font face="calibri" color=#4527f5> Broker ID: </font>
			<input type="text" value="" maxlength="6" id="brokerToDel" 
				onkeypress="return isNumberKey(event)" name="11111" style="margin:5px" />
			<input type="submit" value="Delete!" id="deleteBrokerButton" name="33333" style="margin:5px" />
		</form>
		<form method="post" action="UserUI.php">
			<font face="calibri" color=#ff0000 size="6"> Delete Client </font>
			<br/> <font face="calibri" color=#887f4f> Client ID: </font>
			<input type="text" value="" maxlength="6" id="clientToDel" 
				onkeypress="return isNumberKey(event)" name="44444" style="margin:5px" />
			<input type="submit" value="Delete!" id="deleteClientButton" name="55555" style="margin:5px" />
		</form>
		<form method="post" action="UserUI.php"> 
			<font face="calibri" color=#00ff00 size="6"> Add Stock </font> 
			<br/> <font face="calibri" color=#0faf03> Enter Stock ID: </font>
			<input type="text" value="" maxlength="6" id="stockToAdd" 
			    onkeypress="return isNumberKey(event)" name="99999" style="margin:5px" />
			<input type="submit" value="Add!" id="addStockButton" name="100000" style="margin:5px" />
		</form>
		<br/>
		<form  method="post" action="UserUI.php">
			<font face="calibri" color=#0000ff size="6"> Add Broker </font>
			<br/><font face="calibri"> Enter broker's name: </font>
			<input type="text" value="" maxlength="30" name="800000" style="margin:5px" />
			<input type="submit" value="Add!" id="addBrokerButton" name="200000" style="margin:5px" />
		</form>
		<br/>
		<form method="post" action="UserUI.php">
			<font face="calibri" color=#ff0000 size="6"> Add Client </font>
			<br/><font face="calibri"> Enter client's name: </font>
			<input type="text" value="" maxlength="30" name="600000" style="margin:5px" />
			<br/><font face="calibri"> Enter broker id it associates with: </font>
			<input type="text" value="" maxlength="6"
				onkeypress="return isNumberKey(event)" name="900000" style="margin:5px" />
			<input type="submit" value="Add!" id="addClientButton" name="400000" style="margin:5px" />
		</form>
		<form method="post"	action="UserUI.php" >
			<br/> <font face="calibri" size="6" color="00f0f0"> Delete Transactions </font> <br/>
			<font face="calibri" color=#00ffff> Number of Transaction to Delete </font>
			<input type="text" value="" id="numTransaction"
				onkeypress="return isNumberKey(event)" name="66666" style="margin:5px" />
			<input type="submit" value="Delete!" id="delTransButton" name="77777" style="margin:5px" />
		</form>
	</div>
	<div align="center">
		<form action="UserUI.php" method="post">
			<font face="calibri" color=#008800> DeleteALLTransaction </font>
			<input type="submit" style="width:140px;height:35px;margin:10px" name="500000" />
		</form>
	</div>
	<div id="reactionDiv" align="center">

	</div>
</body> 
<?php


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

	$r = OCIExecute($statement, OCI_DEFAULT);
	if (!$r) {
		echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
		$e = oci_error($statement);
		echo htmlentities($e['message']);
		$success = False;
	} else {

	}
	return $statement;
}

function executeBoundedSQL($cmdstr) {
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

function insufficientFund($total, $custID) {
	$sqlCommand = "select accountbal from client_has_account where id=" . $custID . ";";
	$result = executePlainSQL($sqlCommand);
	$balance = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)['accountbal'];
	return ($total > $balance);
}

function checkSufficientTrans($num_trans) {
	$query = "select count(*) from transaction";
	$res = executePlainSQL($query);
	$row = oci_fetch_array($res, OCI_BOTH);
	return ($row[0] >= $num_trans);
}

function brokerExists($brokerid) {
	$query = "select count(*) from broker where bid = " . $brokerid;
	$res = executePlainSQL($query);
	$row = oci_fetch_array($res, OCI_BOTH);
	return ($row[0] >= 1);
}

function stockExists($stockid) {
	$query = "select count(*) from stock where stockid = " . $stockid;
	$res = executePlainSQL($query);
	$row = oci_fetch_array($res, OCI_BOTH);
	return ($row[0] >= 1);
}

function clientExists($clientid) {
	$query = "select count(*) from client where cid = " . $clientid;
	$res = executePlainSQL($query);
	$row = oci_fetch_array($res, OCI_BOTH);
	return ($row[0] >= 1);
}

function deletestk($stockid) {
	global $db_conn;
	$query = "delete from stock where stockid = " . $stockid;
	executePlainSQL($query);
	oci_commit($db_conn);
	echo "<center> <h4> The stock with stockid: " . $stockid . " is deleted successfully. </h4> </center>";
}

function deleteclt($clientid) {
	global $db_conn;
	$query = "delete from client where cid = " . $clientid;
	executePlainSQL($query);
	oci_commit($db_conn);
	echo "<center> <h4> The client with client ID: " . $clientid . " is deleted successfully. </h4> </center>";
}

function deletebrk($brokerid) {
	global $db_conn;
	$query = "delete from broker where bid = " . $brokerid;
	executePlainSQL($query);
	oci_commit($db_conn);
	echo "<center> <h4> The broker with broker ID: " . $brokerid . " is deleted successfully. </h4> </center>";
}

function deleteSmlstRec() {
	global $db_conn;
	$query = "select min(transaction_num) from transaction";
	$resl = executePlainSQL($query);
	$row = oci_fetch_array($resl, OCI_BOTH);
	$trnum = $row[0];
	$query = "delete from transaction where transaction_num = " . $trnum;
	executePlainSQL($query);
	oci_commit($db_conn);
}

function instMaxBrk($name) {
	global $db_conn;
	$query = "select max(bid) from broker";
	$resl = executePlainSQL($query);
	$row = oci_fetch_array($resl, OCI_BOTH);
	$bidNum = $row[0] + 1;
	$query = "insert into broker values(" . $bidNum . ", '" . $name . "'" . ", 0)";
	executePlainSQL($query);
	oci_commit($db_conn);
	echo "<center> <h4> Broker added successfully. The broker ID <br> associated with it is: " . $bidNum . " </h4> </center>";
}

function instMaxClt($name, $bid) {
	global $db_conn;
	$query = "select max(cid) from client";
	$resl = executePlainSQL($query);
	$row = oci_fetch_array($resl, OCI_BOTH);
	$cltNum = $row[0] + 1;
	$query = "insert into client values(" . $cltNum . ", '" . $name . "', " . $bid . ")";
	executePlainSQL($query);
	oci_commit($db_conn);
	echo "<center> <h4> Client added successfully. The client ID <br> associated with it is: " . $cltNum . " </h4> </center>";
}

if ($db_conn) {
		if (array_key_exists("22222", $_POST)) {
			if (stockExists($_POST["00000"]))
				deletestk($_POST["00000"]);
			else 
				echo "<center> <h3> The stock does not exist in our database! </h3> </center>";
		} else if (array_key_exists("33333", $_POST)) {
			if (brokerExists($_POST["11111"]))
				deletebrk($_POST["11111"]);
			else
				echo "<center> <h3> The broker does not exist in our database! </h3> </center>";
		} else if (array_key_exists("55555", $_POST)) {
			if (clientExists($_POST["44444"]))
				deleteclt($_POST["44444"]);
			else
				echo "<center> <h3> The client does not exist in our database! </h3> </center>";
		} else if (array_key_exists("77777", $_POST)) {
			$numRec = $_POST["66666"];
			$qqrr = "select count(*) from transaction";
			$rrsstt = executePlainSQL($qqrr);
			$result = oci_fetch_array($rrsstt, OCI_BOTH);
			if ($result[0] >= $numRec) {
				while ($numRec > 0) {
					deleteSmlstRec();
					$numRec = $numRec - 1;
				}
				echo "<center> <h4> Transactions deleted successfully. </h4> </center>";
			}
			else 
				echo "<center> <h2> The number you entered is too large. </h2> </center>";
		} else if (array_key_exists("100000", $_POST)) {
			if (stockExists($_POST["99999"])) {
				echo "<center> <h2> The stock already exists in the database!</h2> </center>";
			} else {
				$randsp = (rand(1,100) * 100 + rand(0,100)) / 100;
				$randrate = (rand(-12,12) * 100 + rand(-100,100)) / 100;
				$query = "insert into stock values(" . $_POST["99999"] . ", " . $randsp . ", " . $randrate . ")";
				executePlainSQL($query);
				oci_commit($db_conn);
				echo "<center> <h4> Stock added successfully. The stock ID <br> associated with it is: " . $_POST["99999"] . " </h4> </center>";
			}
		} else if (array_key_exists("200000", $_POST)) {
			if ($_POST["800000"] != "") 
				if (brokerExists($_POST["800000"]))
					echo "<center> <h2> The broker already exists in the database!</h2> </center>";
				else 
					instMaxBrk($_POST["800000"]);
			else 
				echo "<center> <h4> The name of the broker cannot be empty! </h4> </center>";			
		} else if (array_key_exists("400000", $_POST)) {
			if ($_POST["600000"] != "")
				if (brokerExists($_POST["900000"]))
					instMaxClt($_POST["600000"], $_POST["900000"]);
				else
					echo "<center> <h3> The broker does not exist! </h3> </center>";
			else 
				echo "<center> <h4> The name of the client cannot be empty! </h4> </center>";
		} else if (array_key_exists("500000", $_POST)) {
			$request = "select count(*) from transaction";
			$reslttt = executePlainSQL($request);
			$row = oci_fetch_array($reslttt, OCI_BOTH);
			$initialCount = $row[0];
			while ($initialCount > 0) {
				deleteSmlstRec();
				$initialCount = $initialCount - 1;
			}
			echo "<center> <h4> All transactions deleted successfully. </h4> </center>";
		}

		OCILogoff($db_conn);
} else {
	echo "cannot connect";
	$e = OCI_Error(); // For OCILogon errors pass no handle
	echo htmlentities($e['message']);
}




?>
</html>
