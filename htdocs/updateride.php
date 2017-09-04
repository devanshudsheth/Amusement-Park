<?php

$rideNo = $_POST["rideno"];

$rideName = $_POST["rideName"];
$ridetype = $_POST["ridetype"];
$ridestatus = $_POST["ridestatus"];
$rideloc = $_POST["rideloc"];
$maxOcc = $_POST["maxOcc"];
$duration = $_POST["duration"];

$height = $_POST["height"];
$health = $_POST["health"];
$weight = $_POST["weight"];
$restrictionNo = $_POST["restrid"];
$thrill = $_POST["thrill"];
$depth = $_POST["depth"];

$con = mysqli_connect('localhost', 'root', 'root', 'amusementpark');
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
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
else
{
	$query1 = "SELECT * FROM riderestrictions;";
	$result1 = mysqli_query($con, $query1);
	$restrictionNo = $result1->num_rows + 1;
	$insertQuery1 = "INSERT INTO riderestrictions VALUES ('$restrictionNo','$height', '$weight', '$health');";
     mysqli_query($con, $insertQuery1);


}

$upd1 = "UPDATE ride set Restriction_id = '$restrictionNo', Ride_Name = '$rideName', Ride_Type = '$ridetype', Status = '$ridestatus', Ride_Location = '$rideloc', Max_Occupancy = '$maxOcc', Duration = '$duration' where Ride_No = '$rideNo';";


$upd2 = "UPDATE land_ride set Thrill_level = '$thrill' where Ride_No = '$rideNo';";
$upd3 = "UPDATE water_ride set Water_depth = '$depth' where Ride_No = '$rideNo';";
mysqli_query($con, $upd2);
mysqli_query($con, $upd3);

$array = array();

$result23 = mysqli_query($con, $upd1);
    if($result23 === true){
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