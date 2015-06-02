<!DOCTYPE html>
<!-- Author : Minghao Liu -->
<head>
<title> Manager Page -- Stock Operating System </title>
<link rel="stylesheet" type="text/css" href="styleSheet.css">
<link rel="icon" href="favicon.ico" type="image/ico"/>
<h1> <font color="purple"> Welcome to Manager Page! <font> </h1>
</head>

<body>
<div align="center">
<font face="Calibri" size="6" color="green"> Check Brokers </font>
<br/><br/>
<font face="Calibri" size="6" color="blue"> Enter Manager ID:</font>
<form method="post" onsubmit="fetchBrokers();"> 
<input type="text" style="width:20;height:1.2em;margin:6px" id="brokerID" maxlength="6" />
<input type="submit" style="width:60;height:35" /> 
</form>
<font face="calibri" size="6" color=#087713>
    Check Clients' Average Balance of Brokers
</font><br/>
<form action="manager.php" method="post">
    <input type="submit" value="Check Min" style="margin:5px" name="checkmin">
</form>
<form action="manager.php" method="post">
    <input type="submit" value="Check Max" style="margin:5px" name="checkmax">
</form>
<font face="calibri" size="6"> Check Performances of Brokers </font>
<form action="manager.php" method="post">
    <input type="submit" value="Check!" name="checkitup" style="margin:5px">
</form>
</div>

<script type="text/javascript">
function fetchBrokers() {
	var idToSearch = document.getElementById('brokerID').value;
    if (idToSearch.length !== 6) {
		alert("The broker ID you entered is incorrect! It must be six digits!");
	} else if (!(idToSearch >= 0)) {
	    alert("The ID you entered must be pure digits!");
	} else {
	    displayData();
	}
}

function displayData() {
	var numBrokers = Math.ceil(Math.random() * 12);
    document.write("<table border=\"2\">" + "<tr> <th> Broker ID </th> <th> transactionsPerformed </th> <th> NumberOfClients </th> </tr>");
    for (var j = 0; j < numBrokers; j++) {
    	var brokerID = Math.ceil(Math.random() * 900000) + 100000;
    	var brokerTrans = Math.ceil(Math.random() * 30);
    	var numClients = Math.ceil(Math.random() * 10);
    	document.write("<tr> <td> " + brokerID + "</td> <td>" + brokerTrans + "</td> <td>" + numClients + "</td> </tr>");
    }
    document.write("</table>");

}

function printHTML() {
    return '<tr> Annual Performance </tr>';
}

function onloadFunc() {
    var newDiv = document.createElement('div');
    newDiv.id = "theNewDiv";
    newDiv.style.width= "100%";
    newDiv.style.height = "90%";
    newDiv.style.position = "absolute";
    newDiv.style.top = "209px";
    newDiv.style.background = "white";
    document.body.appendChild(newDiv);
}

</script>

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

function checkminfunc() {
    $query = "select avg(cash), b.bid, sum(cash) from broker b, client c, client_has_account ch, account a where a.accountno = ch.accountno and ch.cid = c.cid and c.bid = b.bid group by b.bid order by sum(cash) desc";
    $res = executePlainSQL($query);
    echo "<div align='center'> <table border = '2'> <tr> <th> Broker ID </th> <th> Total Balance </th> <th> Average Balance </th> <th> Num. Clients </th> </tr>";
    while ($row = oci_fetch_array($res, OCI_NUM)) {
        echo "<tr> <td>" . $row[1] . "</td> <td>" . round($row[2], 2) . "</td> <td>" . round($row[0], 2) . "</td> <td>" . round($row[2] / $row[0]) . "</td> </tr>";
    }
    echo "</table></div>";
    $query_ = "select min(avg_cash) from (select avg(cash) as avg_cash, b.bid from broker b, client c, client_has_account ch, account a where a.accountno = ch.accountno and ch.cid = c.cid and c.bid = b.bid group by b.bid order by sum(cash) desc)";
    $res = executePlainSQL($query_);
    echo "<center> <font face='calibri' size='4'> The min average is " . oci_fetch_array($res, OCI_NUM)[0];
}

function checkmaxfunc() {
    $query = "select avg(cash), b.bid, sum(cash) from broker b, client c, client_has_account ch, account a where a.accountno = ch.accountno and ch.cid = c.cid and c.bid = b.bid group by b.bid order by sum(cash) desc";
    $res = executePlainSQL($query);
    echo "<div align='center'> <table border = '2'> <tr> <th> Broker ID </th> <th> Total Balance </th> <th> Average Balance </th> <th> Num. Clients </th> </tr>";
    while ($row = oci_fetch_array($res, OCI_NUM)) {
        echo "<tr> <td>" . $row[1] . "</td> <td>" . round($row[2], 2) . "</td> <td>" . round($row[0], 2) . "</td> <td>" . round($row[2] / $row[0]) . "</td> </tr>";
    }
    echo "</table></div>";
    $query_ = "select max(avg_cash) from (select avg(cash) as avg_cash, b.bid from broker b, client c, client_has_account ch, account a where a.accountno = ch.accountno and ch.cid = c.cid and c.bid = b.bid group by b.bid order by avg(cash) desc)";
    $res = executePlainSQL($query_);
    echo "<center> <font face='calibri' size='4'> The max average is " . oci_fetch_array($res, OCI_NUM)[0];
}

function showPerformances() {
    $query = "select * from broker";
    $res = executePlainSQL($query);
    echo "<div align='center'> <table border = '2'> <tr> <th> Broker ID </th> <th> Broker Name </th> <th> Transactions Performed </th> </tr>";
    while ($row = oci_fetch_array($res, OCI_BOTH)) {
        echo "<tr> <td>" . $row["BID"] . " </td> <td>" . $row["BNAME"] . "</td> <td>" . $row["TRANSNUM"] . "</td> </tr>";
    }
    echo "</table> </div>";
}


if ($db_conn) {
    if (array_key_exists('checkmin', $_POST)) {
        checkminfunc();
    } else if (array_key_exists('checkmax', $_POST)) {
        checkmaxfunc();
    } else if (array_key_exists('checkitup', $_POST)) {
        showPerformances();
    }
} else {
    echo "cannot connect";
    $e = OCI_Error(); // For OCILogon errors pass no handle
    echo htmlentities($e['message']);
}

?>
</html>