<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


include_once '/home/milana/backend/rest api/config/database.php';
include_once '/home/milana/backend/rest api/models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($conn = $db);

if (
    !empty($_POST['username']) &&
    !empty($_POST['name']) &&
    !empty($_POST['city_id'])
) {

    $user->name = $_POST['name'];
    $user->city_id = $_POST['city_id'];
    $user->username = $_POST['username'];


    if ($user->create()) {

        http_response_code(201);
        echo json_encode(array("message" => "User was created."));
    } else {
        http_response_code(503);

        echo json_encode(["message" => "Failed to create a user."]);
    }
} else {

    http_response_code(400);

    echo json_encode(["message" => "Failed to create a user. Not all arguments are passed."]);
}
?>