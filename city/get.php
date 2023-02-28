<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '/home/milana/backend/rest api/config/database.php';
include_once '/home/milana/backend/rest api/models/city.php';

$database = new Database();
$db = $database->getConnection();

$city = new City($db);

$stmt = $city->get();

$num = $stmt->rowCount();

if ($num > 0) {

    $city_arr = array();
    $city_arr["items"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $city_item = array(
            "id" => $id,
            "cityname" => $cityname,
        );

        $city_arr["items"][] = $city_item;

    }

    http_response_code(200);

    echo json_encode($city_arr);

} else {
    http_response_code(404);

    echo json_encode(["message" => "Пользователи не найдены."]);
}
?>