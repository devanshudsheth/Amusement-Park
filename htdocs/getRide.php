<?php

$con = mysqli_connect('localhost', 'root', 'root', 'amusementpark');

$rideNo = $_POST["id"];


	$queryU = "SELECT * FROM Ride as R, riderestrictions as S where S.restriction_id = R.restriction_id and Ride_No = '$rideNo';";



	
$array = array();


    $result = mysqli_query($con, $queryU);
		
		while($row = $result->fetch_assoc())
		{
			array_push($array, $row);
		}
		$o = "SELECT * FROM land_ride where Ride_No = '$rideNo'";
		$r = mysqli_query($con, $o);
		while($r11 = $r->fetch_assoc())
				{
					array_push($array, $r11);
				}
				
			$o1 = "SELECT * FROM water_ride where Ride_No = '$rideNo'";
				$r1 = mysqli_query($con, $o1);
				while($r12 = $r1->fetch_assoc())
				{
					array_push($array, $r12);
				}	
		echo json_encode($array);

?>