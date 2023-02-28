<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


include_once '/home/milana/backend/rest api/config/database.php';
include_once '/home/milana/backend/rest api/models/user.php';

$database = new Database($host = $hostname, $db_name = $database, $username = $user, $password = $pass);
$db = $database->getConnection();

$user = new User($conn = $db);

$data = json_decode(file_get_contents("php://input"));
if (
    !empty($data->name) &&
    !empty($data->username) &&
    !empty($data->city_id)
) {


    //$user->name = $_POST['name'];
    //$user->city_id = $_POST['city_id'];
    //$user->username = $_POST['username'];
    $user->name = $data->name;
    $user->city_id = $data->city_id;
    $user->username = $data->username;


    if ($user->create()) {

        http_response_code(201);
        echo json_encode(array("message" => "User was created."));
    } else {
        http_response_code(503);

        echo json_encode(["message" => "Failed to create a user."]);
    }
} else {

    http_response_code(400);

    echo json_encode(["message" => "User cannot be created. Not enough data."]);
}
?>