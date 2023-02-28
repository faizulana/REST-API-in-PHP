<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


include_once '/home/milana/backend/rest api/config/database.php';
include_once '/home/milana/backend/rest api/models/city.php';

$database = new Database($host = $hostname, $db_name = $database, $username = $user, $password = $pass);
$db = $database->getConnection();

$city = new City($conn = $db);

$data = json_decode(file_get_contents("php://input"));
if (
    !empty($data->cityname)
) {

    $city->cityname = $data->cityname;


    if ($city->create()) {

        http_response_code(201);
        echo json_encode(array("message" => "City was created."));
    } else {
        http_response_code(503);

        echo json_encode(["message" => "Failed to create a city."]);
    }
} else {

    http_response_code(400);

    echo json_encode(["message" => "Failed to create a city. Not all arguments are passed."]);
}

?>