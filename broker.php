<html>
<head>
	<title> Broker Page -- Stock Operating System </title>
	<link rel="stylesheet" type="text/css" href="styleSheet.css" />
    <link rel="icon" href="favicon.ico" type="image/ico"/>
	<h1> Welcome to Broker Page! </h1>
</head>
<script type="text/javascript">

function onloadFunc() {
	alert("Hello! Welcome to our system!");
}

function isNumberKey(keyevent) {
	var charCode = (keyevent.which) ? keyevent.which : keyevent.keycode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}

	return true;
}

function displayTrans() {
	var times = 5;
	document.getElementById('displayDiv').innerHTML = '';
	// document.getElementById('displayDiv').innerHTML += "This is a function to display transactions recently performed.";
	document.getElementById('displayDiv').innerHTML += "<table border=\"2\" <tr> <th>" +
													   "<font face=\"calibri\"> Transaction Type </font> </th> " +
													   "\n <th> <font face=\"calibri\"> Share </font>" +
													   "</th> \n <th> <font face=\"calibri\"> Trading Price </font> </th> </tr> </table>\n";
	document.getElementById('displayDiv').innerHTML += "<table border=\"2\">";
	var displayString = "";
	for (var i = 0; i < times; i++) {
		var shareToDisp = Math.random().toPrecision(2) * 10000;
		shareToDisp = shareToDisp.toPrecision(4);
		var priceOfTrade = Math.random().toPrecision(4) * 20;
		priceOfTrade = priceOfTrade.toPrecision(4);
		if (getRand())
			var transType = "Buy";
		else
			var transType = "Sell";
		document.getElementById('displayDiv').innerHTML += 
						"<tr> <td> <font face=\"calibri\">" + transType 
					  + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" 
					  + "</font> </td> <td> <font face=\"calibri\"> " 
					  + shareToDisp + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
					  + "</font> </td> <td> <font face=\"Calibri\"> " + priceOfTrade 
					  + "</font> </td> </tr> <br/>\n";
	}
	document.getElementById('displayDiv').innerHTML += displayString;
	document.getElementById('displayDiv').innerHTML += "\n</table>";
	
}

function displayClient() {
	document.getElementById('displayDiv').innerHTML = '';
	// document.getElementById('displayDiv').innerHTML += "This is a function to display the clients!"; 
	// document.getElementById('displayDiv').innerHTML += '<table border=\"2\"> <tr> <th> ';
	document.getElementById('displayDiv').innerHTML += "<table border=\"2\" <tr> <th>" +
													   "<font face=\"calibri\"> Client ID </font> </th> " +
													   "\n <th> <font face=\"calibri\"> Account Balance </font>" +
													   "</th> \n </tr>\n";
	var times = Math.ceil(Math.random() * 10);

	for (var i = 0; i < times; i++) {
		var custID = Math.ceil(Math.random() * 900000) + 100000;
		var pow = Math.pow(10, Math.ceil(Math.random() * 7));
		var accountBalance = Math.ceil(Math.random() * pow) + Math.random().toPrecision(2);
		document.getElementById('displayDiv').innerHTML += 
						"<table border=\'1\'> <tr> <td> <font face=\"calibri\">" + custID
					  + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" 
					  + "</font> </td> <td> <font face=\"calibri\"> " 
					  + accountBalance + "</font> </td> </tr> </table>\n";
	}

	document.getElementById('displayDiv').innerHTML += '</table>';
}

</script>
<body>
	<!--  onload="onloadFunc();" -->
	<div style="position:absolute;left:20px;top:240px">
		<div align="center">
			<font face="calibri" size="6">
				Quick Links
			</font>
		</div>
		<a href="index.html" style="text-decoration:underline"> <font face="calibri"> Jump to Main Page </font> </a> <br/>
		<div align="center">
			<a href="index.html" onclick="window.open('index.html'); window.close(); return false;" style="text-decoration:underline">
				<font face="calibri" style="color:#00ff00"> 
					Log-off
				</font>
			</a>
		</div>
	</div>
	<div style="position:absolute;right:20px;top:240px">
		<div align="center">
			<font face="calibri" size="6">
				Friend Links
			</font>
		</div>
		<a href="http://www.google.com/finance" style="text-decoration:underline">
			<font face="calibri">
				Google Finance
			</font>
		</a>
		<div align="center">
			<a href="https://ca.finance.yahoo.com" style="text-decoration:underline">
				<font face="calibri" style="color:#00ff00">
					Yahoo Finance
				</font>
			</a>
		</div>
	</div>
	<div align="center">
		<form method="post" action="broker.php">
			<font face="Calibri" color=#880000> Search Stock </font>
			<input type="text" id="stockName" name="searchID" size="13" onkeypress="return isNumberKey(event)" />
			<input type="submit" id="SubmitSearch" value="go" style="width:40px;height:30px;font-size:16" name="SearchStock" />
		</form>
	</div>
	<br> </br> 
	<div align="center">
		<form method="post" action="broker.php">
			<font face="Calibri" color=#880000 size=12> Buy Stocks </font> <br> </br>
			<font face="calibri" color=#000000> Enter the stock ID: </font>
			<input type="text" value="" id="buyingStock" style="margin:5px" 
			name="buyingStock" onkeypress="return isNumberKey(event)" />
			<br/>
			<font face="calibri" color=#880000> Enter share: </font>
			<input type="text" value="" id="stockShare" style="margin:5px" 
			name="stockShare" onkeypress="return isNumberKey(event)" />
			<br/>
			<font face="calibri" color=#000000> Enter the client ID: </font>
			<input type="text" value="" id="custIDToBuy" style="margin:5px" 
			name="custIDToBuy" onkeypress="return isNumberKey(event)" /> 
			<input type="submit" value="Buy!" name="BuyStock" />

		</form>

		<form method="post" action="broker.php">
			<font face="Calibri" color=#008800 size=12> Sell Stocks </font> 
			<br/>
			<font face="calibri" color=#000000> Enter the stock ID: </font>
			<input type="text" value="" id="sellOne" name="sellOne" 
			style="margin:5px" onkeypress="return isNumberKey(event)" />
			<br/>
			<font face="calibri" color=#880000> Enter share: </font>
			<input type="text" value="" id="sellShare" name="sellShare" 
			style="margin:5px" onkeypress="return isNumberKey(event)" />
			<br/>
			<font face="calibri" color=#000000> Enter the client ID: </font>
			<input type="text" value="" id="custIDSell" name="custIDSell" 
			style="margin:5px" onkeypress="return isNumberKey(event)" /> 
			<input type="submit" value="Sell!" name="SellStock" />

		</form>
		<br/>
		<form action="broker.php" method="post">
		<input type="submit" name="views" 
			value="View Transaction" style="margin:6px;width:120px;height:30px" />
		</form>

		<button type="button" onclick="displayClient()" name="00000" style="margin:6px;width:120px;height:30px">
			<font face="calibri"> ViewClients </font>
		</button>
		
		
		<middle> <p> <font face="Calibri"> Your client information and recent transactions will be loaded here. </font> </p> </middle>
	</div>
	<div align="center" id="displayDiv">

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

function insufficientFund($total, $custID) {
	global $db_conn, $success;
	$sqlCommand = "select cash from client_has_account cc, account a where cc.cid=" . $custID . ";";
	$result = executePlainSQL($sqlCommand);
	$resstr = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS);
	if ($resstr == false) {
		return False;
	}
	$balance = $resstr['ACCOUNTBAL'];
	return ($total > $balance);
}

function checkCondition($idtocheck) {
	if ($idtocheck >= 0 && $idtocheck < 1000000 && !($idtocheck == "")) {
		return true;
	} else 
		return false;
}

function checkAvailable($custIDBuy, $amt) {
    $check = "select cash from client_has_account c, account a where c.accountno = a.accountno and cid = " . $custIDBuy;
    $result = executePlainSQL($check);	
    while ($row = oci_fetch_array($result, OCI_BOTH)) {
    	if ($row["CASH"] > $amt) {
    		return true;
    	} else 
    		return false;
    }
    return false;
}

function checkifstockvalid($sid) {
	$check = "select * from stock where stockid = " . $sid;
	$res = executePlainSQL($check);
	while ($rrr = oci_fetch_array($res, OCI_BOTH)) {
		return true;
	}

	return false;
}

function portfolioexist($stockNum, $custID) {
	$cond = "select * from portfolio_detail p, client_has_account c where p.ticket = " . $stockNum . "and p.accountno = c.accountno and c.cid = " . $custID;
	$rest = executePlainSQL($cond);
	while ($rrr = oci_fetch_array($rest, OCI_BOTH)) {
		return true;
	} 

	return false;
} 

function updateport($stock, $client, $shares, $price, $type) {
	if ($type == 0) {
		$cond = "select shareamount from portfolio_detail p, client_has_account c where p.accountno = c.accountno and c.cid = " 
				. $client . " and p.ticket = " . $stock;
		$rest = executePlainSQL($cond);
	    $row = oci_fetch_array($rest, OCI_ASSOC);
	    $sharesss = $row["SHAREAMOUNT"];
	    $newshare = $sharesss + $shares;
		$cond = "update portfolio_detail set shareamount = " . $newshare . ", traded_price = " . $price 
				. " where ticket = " . $stock . " and accountno = (select"
				. " accountno from client_has_account where cid = " . $client . ")";
		executePlainSQL($cond);
	} else {
		$cond = "select shareamount from portfolio_detail p, client_has_account c where p.accountno = c.accountno and c.cid = " 
				. $client . " and p.ticket = " . $stock;
		$rest = executePlainSQL($cond);
	    $row = oci_fetch_array($rest, OCI_ASSOC);
	    $sharesss = $row["SHAREAMOUNT"];
	    $newshare = $sharesss - $shares;
		$cond = "update portfolio_detail set shareamount = " . $newshare . ", traded_price = " . $price 
				. " where ticket = " . $stock . " and accountno = (select"
				. " accountno from client_has_account where cid = " . $client . ")";
		executePlainSQL($cond);
	}
}

function updateBrokerDetails($clientid) {
	$qqquery = "select bid from client where cid = " . $clientid;
	$reslt = executePlainSQL($qqquery);
	$row = oci_fetch_array($reslt, OCI_BOTH);
	$bidd = $row["BID"];
	$query = "select transnum from broker b where b.bid = " . $bidd;
	$reslt = executePlainSQL($query);
	$rowww = oci_fetch_array($reslt, OCI_BOTH);
	$newTrans = $rowww["TRANSNUM"] + 1;
	$updatequery = "update broker set transnum = " . $newTrans . " where bid = " . $bidd;
	executePlainSQL($updatequery);
}
 
function checkstocksuff($stockid, $clientid, $sharetosell) {
	$cond = "select shareamount from portfolio_detail p, client_has_account c, stock s where s.stockid = p.ticket and c.accountno = p.accountno and c.cid = " . $clientid;
	$res = executePlainSQL($cond);
	$row = oci_fetch_array($res, OCI_BOTH);
	if ($row == false) {
		return false;
	}
	return ($row["SHAREAMOUNT"] >= $sharetosell);
}

function displaytr() {
	$query = "select * from transaction order by transaction_num desc";
	$reslt = executePlainSQL($query);
	$counter = 5;
	echo "<div align='center'> <table border = '2'> <tr> <th> Transaction Number </th> <th> Share </th> <th> Price </th> <th> Broker ID </th> </tr>";
	while (($row = oci_fetch_array($reslt, OCI_BOTH)) && $counter > 0) {
		echo "<tr> <td> " . $row["TRANSACTION_NUM"] . "</td> <td> " 
			. $row["SHAREAMOUNT"] . "</td> <td>" . $row["TRADED_PRICE"]
			. "</td> <td>" . $row["BID"] . "</td> </tr>";
		$counter = $counter - 1;
	}
	echo "</table> </div>";
}

function updateTransactionHistory($clientid, $stockID, $shares, $price, $flag) {
	if ($flag) {
		$query = "select max(transaction_num) from transaction";
		$resl = executePlainSQL($query);
		$row = oci_fetch_array($resl, OCI_NUM);
		$newTrans = $row[0] + 1;
		$query = "select bid from client where cid = " . $clientid;
		$resl = executePlainSQL($query);
		$row = oci_fetch_array($resl, OCI_NUM);
		$bid = $row[0];
		$query = "insert into transaction values(" . $newTrans . ", " 
				. $stockID . ", " . $shares . ", " . $price . ", 1, 0, 0, 0, " . $bid . ")";
		executePlainSQL($query);
	} else {
		$query = "select max(transaction_num) from transaction";
		$resl = executePlainSQL($query);
		$row = oci_fetch_array($resl, OCI_NUM);
		$newTrans = $row[0] + 1;
		$query = "select bid from client where cid = " . $clientid;
		$resl = executePlainSQL($query);
		$row = oci_fetch_array($resl, OCI_NUM);
		$bid = $row[0];
		$query = "insert into transaction values(" . $newTrans . ", " 
				. $stockID . ", " . $shares . ", " . $price . ", 0, 1, 0, 0, " . $bid . ")";
		executePlainSQL($query);
	}
}

if ($db_conn) {
	if (array_key_exists('SearchStock', $_POST)) {
		if (!checkCondition($_POST['searchID'])) {
			echo "<h2><center>The stock ID you are searching must be within six digits!</center></h2>";
		} else {
			$cmdString = "select price, rateofchange from stock where stockid=" . $_POST['searchID'];
			$resultStr = executePlainSQL($cmdString);
			$row = oci_fetch_array($resultStr, OCI_BOTH);
			if ($row == false) {
				echo "<h2> <center>THE stock does not exist in our database</center> </h2>";
			} else {
				echo "<h2> <center> The rate of change is " . $row["RATEOFCHANGE"] . "%, and the price is " . $row["PRICE"] . "</center> </h2>";
			}
		}
} else if (array_key_exists('BuyStock', $_POST)) {
	if (checkCondition($_POST['buyingStock'])) {
		if (checkifstockvalid($_POST['buyingStock'])) {
			$stockNum = $_POST["buyingStock"];
			$queryQ = "select price from stock where stockid = " . $stockNum;
			$fetchRes = executePlainSQL($queryQ);
			$row = oci_fetch_array($fetchRes, OCI_BOTH);
			$totalAmount = $row["PRICE"] * $_POST['stockShare'];
			if (checkAvailable($_POST['custIDToBuy'], $totalAmount)) {
				$qqq = "select cash from client_has_account c, account a where cid = " 
					 . $_POST["custIDToBuy"] . " and c.accountno = a.accountno";
				$res = executePlainSQL($qqq);
				$arr = oci_fetch_array($res, OCI_BOTH);
				$newcash = $arr["CASH"] - $totalAmount;
				$updateQ = "update account set cash = " . $newcash . " where accountno = (select accountno from client_has_account where cid = " 
						 . $_POST["custIDToBuy"] . ")";
				$res = executePlainSQL($updateQ);
				oci_commit($db_conn);
				if (portfolioexist($stockNum, $_POST["custIDToBuy"])) {
					updateport($stockNum, $_POST["custIDToBuy"], $_POST["stockShare"], $row["PRICE"], 0);
					oci_commit($db_conn);
				} else {
					$newCmd = "select accountno from client_has_account where cid = " . $_POST["custIDToBuy"];
					$resvar = executePlainSQL($newCmd);
					$rrrss = oci_fetch_array($resvar, OCI_BOTH);
					$accounttoinsert = $rrrss["ACCOUNTNO"];
					$newCmd = "insert into portfolio_detail values(" . $accounttoinsert . ", " 
						    . $stockNum . ", " . $row["PRICE"] . ", " . $_POST["stockShare"] . ")";
					executePlainSQL($newCmd);
					oci_commit($db_conn);
				}
				updateBrokerDetails($_POST["custIDToBuy"]);
				updateTransactionHistory($_POST["custIDToBuy"], $_POST["buyingStock"], $_POST["stockShare"], $row["PRICE"], 1);
				oci_commit($db_conn);
				echo "<h2> <center> Transaction succeeded and the database is updating information for you. </center> </h2>";
				echo "<h3> <center> Your previous balance is " . $arr["CASH"] . ".<br/> And your new balance is " . $newcash . ".";
			} else {
				echo "<h2> <center> Either the customer does not exist or there is insufficient fund on the account.</center> </h2>";
			}
		} else {
			echo "<h2> <center> The stock you are buying does not exist in the database. </center> </h2>";
		}
	} else {
		echo '<h2> <center> The stock id you entered is invalid. </center> </h2>';
	}
} else if (array_key_exists('SellStock', $_POST)) {
	if (checkCondition($_POST['sellOne'])) {
		if (checkifstockvalid($_POST['sellOne'])) {
			if (checkstocksuff($_POST["sellOne"], $_POST["custIDSell"], $_POST["sellShare"])) {
				// There is enough share in the portfolio
				$cmd_ = "select price from stock where stockid = " . $_POST["sellOne"];
				$res = executePlainSQL($cmd_);
				$ppprr = oci_fetch_array($res, OCI_BOTH);
				$priceofstock = $ppprr["PRICE"];
				$addmoney = $priceofstock * $_POST["sellShare"];
				$cmd_ = "select cash from account a, client_has_account c where a.accountno = c.accountno and c.cid = " . $_POST["custIDSell"];
				$res = executePlainSQL($cmd_);
				$pppr = oci_fetch_array($res, OCI_BOTH);
				$newmoney = $addmoney + $pppr["CASH"];
				$cmd_ = "update account set cash = " . $newmoney 
					  . " where accountno = (select accountno from client_has_account where cid = "
					  . $_POST["custIDSell"] . ")";
				executePlainSQL($cmd_);
				oci_commit($db_conn);
				
				updateport($_POST["sellOne"], $_POST["custIDSell"], $_POST["sellShare"], $ppprr["PRICE"], 1);
				updateBrokerDetails($_POST["custIDSell"]);
				updateTransactionHistory($_POST["custIDToBuy"], $_POST["buyingStock"], $_POST["stockShare"], $row["PRICE"], 0);
				oci_commit($db_conn);
				echo "<h2> <center> Transaction succeeded and the database is updating information for you. </center> </h2>";
				echo "<h3> <center> Your previous balance is " . $pppr["CASH"] . ".<br/> And your new balance is " . $newmoney . ".";
			} else {
				echo "<h3> <center> The client does not have enough share to perform the transaction. </center> </h3>";
			}

		} else {
			echo "<h2> <center> The stock you are selling does not exist in the database. </center> </h2>";
		}
	} else 
		echo "<h2> <center> The stock id you entered is invalid! </center> </h2>";
} else if (array_key_exists('views', $_POST)) {
	displaytr();
}
	OCILogoff($db_conn);
} else {
	echo "cannot connect";
	$e = OCI_Error();
	echo htmlentities($e['message']);
}




?>
</html>