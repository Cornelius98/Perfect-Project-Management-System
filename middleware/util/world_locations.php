<?php 
header("Content-Type: application/json");
require_once ('../../EXTERNAL_HEADER_FILES.php');
$response =[
    "status"=>0,
    "worlds"=>[]
];
$existCountries = $UserAccountPull->get_world_locations();
if(is_array($existCountries) && !empty($existCountries)){
    $response["status"] =200;
    array_push($response["worlds"],$existCountries);
}else{

    $response["status"] = 404;
    array_push($response["worlds"],$existCountries);
}
echo json_encode($response);
?>