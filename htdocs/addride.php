<?php

$rideName = $_POST["rideName"];
$ridetype = $_POST["ridetype"];
$ridestatus = $_POST["ridestatus"];
$rideloc = $_POST["rideloc"];
$maxOcc = $_POST["maxOcc"];
$duration = $_POST["duration"];

$height = $_POST["height"];
$health = $_POST["health"];
$weight = $_POST["weight"];
$thrill = $_POST["thrill"];
$depth = $_POST["depth"];



$con = mysqli_connect('localhost', 'root', 'root', 'amusementpark');
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}    

	$queryU = "SELECT max(Ride_No) as m FROM Ride;";
	$resultU = mysqli_query($con, $queryU);
	
if ($resultU->num_rows > 0)
{
		while($row1 = $resultU->fetch_assoc())
		{
			$rideNo = $row1["m"] + 1;
		}
}




$query2 = "SELECT Restriction_id from riderestrictions where Height='$height' and  Weight='$weight' and health='$health';";
$result2 = mysqli_query($con, $query2);

if ($result2->num_rows > 0)
{
		while($row = $result2->fetch_assoc())
		{
			$restrictionNo = $row["Restriction_id"];
		}
}
else{

	$query1 = "SELECT * FROM riderestrictions;";
	$result1 = mysqli_query($con, $query1);
	$restrictionNo = $result1->num_rows + 1;
	$insertQuery1 = "INSERT INTO riderestrictions VALUES ('$restrictionNo','$height', '$weight', '$health');";
    $result = mysqli_query($con, $insertQuery1);

	
}

    $insertQuery = "INSERT INTO Ride (Ride_no, Ride_name, Status, Ride_location, Max_occupancy, Duration, Ride_type, Restriction_id) VALUES ('$rideNo','$rideName', '$ridestatus', '$rideloc', '$maxOcc', '$duration', '$ridetype', '$restrictionNo');";

		
			
	
$array = array();


    $result = mysqli_query($con, $insertQuery);
    if($result === true){
		
		if ($ridetype === "Land")
		{
	    $q = "INSERT INTO land_ride (Ride_no, Thrill_level) VALUES ('$rideNo','$thrill');";
		    mysqli_query($con, $q);

		}
		else{
				    $q1 = "INSERT INTO water_ride (Ride_no, Water_depth) VALUES ('$rideNo','$depth');";
		    mysqli_query($con, $q1);

		}
		
		
        array_push($array, "success");
		array_push($array, $rideName);
		array_push($array, $rideNo);


        echo json_encode($array);
    }
    else{
        array_push($array, "errorI");
        echo json_encode($array);
    }

?>