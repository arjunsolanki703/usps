<?php
$servername = "127.0.0.1:3307";

$username = "root"; 

$password = ""; 

$dbname = "test_address"; 


$mysqli = new mysqli("127.0.0.1","root","","test_address");

// Check connection
if ($mysqli -> connect_errno) {
echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
exit();
}
    if (isset($_POST)) {
            $data = json_decode($_POST['data']);
            $address_1= $data->address_1;
            $address_2=$data->address_2; 
            $city=$data->city;
            $state=$data->state;
            $zip=$data->zip;

            $sql = "INSERT INTO `address`( `address_1`, `address_2`,`city`,`state`,`zip`) 
            VALUES ('$address_1','$address_2','$state','$city','$zip')";
           
            if (mysqli_query($mysqli, $sql)) {

			    echo json_encode(array("statusCode"=>200 ,'message' =>'Address add Successfully'));

		    } 
    
		mysqli_close($mysqli);

    }

?>