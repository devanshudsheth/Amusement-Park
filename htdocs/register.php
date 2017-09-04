<?php
session_start();

$username = $_POST["username"];
$password = $_POST["password"];
$firstname = $_POST["fname"];
$lastname = $_POST["lname"];
$email = $_POST["email"];
$address = $_POST["address"];
$phone = $_POST["phone"];

$con = mysqli_connect('localhost', 'root', 'root', 'MusicStore');
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}    

$queryU = "SELECT * FROM Users WHERE username = '".$username."'";
$queryE = "SELECT * FROM Users WHERE email = '".$email."'";

$resultU = mysqli_query($con, $queryU);
$resultE = mysqli_query($con, $queryE);
$array = array();

if($resultU->num_rows > 0){
    array_push($array, "errorU");
    echo json_encode($array);
}
elseif($resultE->num_rows > 0){
    array_push($array, "errorE");
    echo json_encode($array);
} 
else{
    $password = md5($password);
    $insertQuery = "INSERT INTO Users (username, password, email, fname, lname, address, phone) VALUES ('".$username."', '".$password."', '".$email."', '".$firstname."', '".$lastname."','".$address."', '".$phone."')";

    $result = mysqli_query($con, $insertQuery);
    if($result === true){
        $_SESSION["username"] = $username;
        $_SESSION["pwd"] = $password;
        // setcookie("username", $username);
        // setcookie("pwd", $password);
        array_push($array, "success");
        echo json_encode($array);
    }
    else{
        array_push($array, "errorI");
        echo json_encode($array);
    }
}
?>