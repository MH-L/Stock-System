<html>
<link rel="icon" href="favicon.ico" type="image/ico"/>

<body>
	<center> <h1> <font face="calibri" color=#35f42a> Create Account </font> </h1></center>
	<div align="center">
	<form action="signup.php" method="post">
		<font face="calibri"> Login ID: </font> 
		<input type="text" maxlength="6" name="loginid"><br/>
		<font face="Calibri"> Password: </font> 
		<input type="password" maxlength="17" name="pswd"> <br/>
		<font face="calibri"> Re-enter Password: </font>
		<input type="password" maxlength="17" name="reenter" style="margin:5px">
		<br/> <input type="submit" value="Create Account!" name="Create">
	</form>
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

function loginIDexists($id) {
	$command = "select * from login where loginid = " . $id;
	$result = executePlainSQL($command);
	while($row = oci_fetch_array($result)) {
		return true;
	}
	return false;
}

function createLoginId($login, $pass) {
	$command = "insert into login values(" . $login . ", '" . $pass . "')";
	executePlainSQL($command);
}

if ($db_conn) {
    if (array_key_exists('Create', $_POST)) {
        if (loginIDexists($_POST["loginid"])) {
        	echo "<center> <font face='Calibri' size='6'> The login id exists! Please change one. </font> </center>";
        } else {
        	if (strlen($_POST["pswd"]) < 8) {
        		echo "<center> <font face='Calibri' size='6'> The length of password must be more than 8 characters! </font> </center>";
        	} else {
        		if ($_POST["pswd"] != $_POST["reenter"]) {
        			echo "<center> <font face='Calibri' size='6'> The passwords do not match! </font> </center>";
        		} else {
        			createLoginId($_POST["loginid"], $_POST["pswd"]);
        			oci_commit($db_conn);
        			echo "<script> window.close(); </script>";
        		}
        	}
        }
    }
    OCILogoff($db_conn);
} else {
    echo "cannot connect";
    $e = OCI_Error(); // For OCILogon errors pass no handle
    echo htmlentities($e['message']);
}

?>
</html>



