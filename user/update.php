<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once '/home/milana/backend/rest api/config/database.php';
include_once '/home/milana/backend/rest api/models/user.php';


$database = new Database($host = $hostname, $db_name = $database, $username = $user, $password = $pass);
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->id = $data->id;

$user->name = $data->name;
$user->username = $data->username;
$user->city_id = $data->city_id;

if ($user->update()) {
    http_response_code(200);

    echo json_encode(array("message" => "the user was updated"), JSON_UNESCAPED_UNICODE);
}
else {
    http_response_code(503);

    echo json_encode(array("message" => "Failed to update the user"), JSON_UNESCAPED_UNICODE);
}
?>