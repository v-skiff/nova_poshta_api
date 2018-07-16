<?php
$con = mysqli_connect('localhost', 'root', '', 'nova_p');
mysqli_set_charset($con, 'utf8');

if ( mysqli_connect_errno() ) {
    echo 'Что-то вышло из под контроля, инфо: ' . mysqli_connect_errno();
    die;
}

// CURL

// $curl = curl_init();
// curl_setopt_array($curl, array(
// CURLOPT_URL => "https://api.novaposhta.ua/v2.0/json/",
// CURLOPT_RETURNTRANSFER => True,
// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST => "POST",
// CURLOPT_POSTFIELDS => "{\r\n\"apiKey\": \"cd605ed4ab43e54f994e40a2bd1c9801\",\r\n\"modelName\": \"Address\",\r\n\"calledMethod\": \"getCities\",\r\n\"methodProperties\": {}\r\n}",
// CURLOPT_HTTPHEADER => array("content-type: application/json",),
// ));
//
// $response = curl_exec($curl);
//
// $err = curl_error($curl);
//
// curl_close($curl);
//
// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     $settlementsList = json_decode($response, true);
//     $settlementsList = $settlementsList['data'];
//
// }

// DB refreshing
// foreach ( $settlementsList as $settlement ) {
//     $city_name = $settlement["DescriptionRu"];
//     $city_ref = $settlement["Ref"];

    // $query = "INSERT INTO settlement VALUES (NULL, '$city_name', '$city_ref', CURRENT_TIMESTAMP)";
    // $check_query_result = mysqli_query($con, $query);

// }

// CURL

// get rows count
$query = "SELECT COUNT(*) as total FROM settlement";
$query_result = mysqli_query($con, $query);
$settlement_count = mysqli_fetch_assoc($query_result);
$settlement_count = (int) $settlement_count['total'];
// get rows count

// get settlements list
$query = "SELECT * FROM settlement";
$query_result = mysqli_query($con, $query);
$settlement_list = mysqli_fetch_assoc($query_result);
// get settlements list
?>
