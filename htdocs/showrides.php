<?php

$con = mysqli_connect('localhost', 'root', 'root', 'amusementpark');

console.log("GOT CONNECTION");
	$queryU = "SELECT Ride_Name, Ride_No FROM Ride;";



	
$array = array();


    $result = mysqli_query($con, $queryU);
		
		while($row = $result->fetch_assoc())
		{
			
			array_push($array, $row);
		}
		echo json_encode($array);

?>