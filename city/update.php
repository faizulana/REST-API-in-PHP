<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once '/home/milana/backend/rest api/config/database.php';
include_once '/home/milana/backend/rest api/models/city.php';


$database = new Database($host = $hostname, $db_name = $database, $username = $user, $password = $pass);
$db = $database->getConnection();

$city = new City($db);

$data = json_decode(file_get_contents("php://input"));

$city->id = $data->id;

$city->cityname = $data->cityname;

if ($city->update()) {
    http_response_code(200);

    echo json_encode(array("message" => "the city was updated"), JSON_UNESCAPED_UNICODE);
}
else {
    http_response_code(503);

    echo json_encode(array("message" => "Failed to update the city"), JSON_UNESCAPED_UNICODE);
}
?>