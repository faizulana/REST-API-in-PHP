<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '/home/milana/backend/rest api/config/database.php';
include_once '/home/milana/backend/rest api/models/user.php';

$database = new Database($host = $hostname, $db_name = $database, $username = $user, $password = $pass);
$db = $database->getConnection();

$user = new User($db);


$stmt = $user->get();

$num = $stmt->rowCount();

if ($num > 0) {

    $user_arr = array();
    $user_arr["items"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // извлекаем строку
        extract($row);
        $user_item = array(
            "id" => $id,
            "username" => $username,
            "city" => $cityname,
            "name" => $name,
        );

        $user_arr["items"][] = $user_item;

    }

    http_response_code(200);

    echo json_encode($user_arr);

} else {
    http_response_code(404);

    echo json_encode(["message" => "Пользователи не найдены."]);
}

?>