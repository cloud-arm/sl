<?php 



//----------------------------------------------------------------//
$url="http://api.colorbiz.org/service_request/service_request_view.php";

$curl = curl_init();
$fields = array(
    'cus_id' => '5'
);
$json_string = json_encode($fields);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $json_string);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
$data = curl_exec($curl);
curl_close($curl);

echo $data;
?>