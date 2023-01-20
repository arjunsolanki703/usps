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
        $input_xml = <<<EOXML
        <AddressValidateRequest USERID="262DIGNI1213">
            <Address ID="0">
                <Address1>$data->address_1</Address1>
                <Address2>$data->address_2</Address2>
                <City>$data->city</City>
                <State>$data->state</State>
                <Zip5>$data->zip</Zip5>
                <Zip4></Zip4>
            </Address>
        </AddressValidateRequest>
        EOXML;

        $fields = array(
            'API' => 'Verify',
            'XML' => $input_xml
        );

        $url = 'http://production.shippingapis.com/ShippingAPITest.dll?' . http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);

        $array_data = json_decode(json_encode(simplexml_load_string($data)), true);
        $error = @$array_data['Address']['Error']['Description'];

            if($error){
                echo json_encode(array(
                 'statusCode'=> 202, 
                 'error' => $array_data['Address']['Error']['Description'],));
            }   
        
            else {
                $data = json_decode($_POST['data']);
                $address_1= $data->address_1;
                $address_2=$data->address_2; 
                $city=$data->city;
                $state=$data->state;
                $zip=$data->zip;
 
                $address_1_usps = $array_data['Address']['Address1'];
                $address_2_usps = $array_data['Address']['Address2'];
                $city_usps = $array_data['Address']['City'];
                $state_usps = $array_data['Address']['State'];
                $zip1_1_usps = $array_data['Address']['Zip5'];
                $zip2_2_usps = $array_data['Address']['Zip4'];
                
                echo json_encode(array( 'statusCode'=> 200, 
                    'address_1'     =>  $address_1,
                    'address_2'     =>  $address_2,
                    'city'          =>  $city,
                    'state'         =>  $state,
                    'zip'           =>  $zip,
                    'address_1_usps'=>  $address_1_usps,
                    'address_2_usps'=>  $address_2_usps,
                    'city_usps'     =>  $city_usps,
                    'state_usps'    =>  $state_usps,
                    'zip1_usps'     =>  $zip1_1_usps,
                    'zip2_usps'     =>  $zip2_2_usps,
                ));
            }
        }
    
	
    

?>