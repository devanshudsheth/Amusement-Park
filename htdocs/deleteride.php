<?php

$rideNo = $_POST["id"];
$con = mysqli_connect('localhost', 'root', 'root', 'amusementpark');

console.log("GOT CONNECTION");
	$queryU = "delete FROM Ride where Ride_No = '$rideNo' ;";



	
$array = array();


    $result = mysqli_query($con, $queryU);
	if($result === true){
        array_push($array, "success");
		echo json_encode($array);
    }
    else{
        array_push($array, "errorI");
        echo json_encode($array);
    }	
		

?>