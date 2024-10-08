<?php

	$inData = getRequestInfo();

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331"); 	
	if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		// $name = $inData["Name"];
		$stmt = $conn->prepare("DELETE FROM Contacts WHERE ID =?");
		$stmt->bind_param("s", $inData["id"]);
		$stmt->execute();


		$stmt->close();
		$conn->close();
	}
	
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"id":0,"Name":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
?>
