<?php
class User
{
    private ?PDO $conn;
    private string $table_name = "user";
    public string $id;
    public string $username;
    public string $city_id;

    public  string $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get(): bool|PDOStatement
    {

        $query = "SELECT user.id, user.username, user.name, city.cityname FROM " . $this->table_name . " LEFT JOIN city ON user.city_id = city.id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function create(): bool
    {

        $query = "INSERT INTO " . $this->table_name . " SET name=:name, city_id=:city_id, username=:username";

        $stmt = $this->conn->prepare($query);


        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));
        $this->username = htmlspecialchars(strip_tags($this->username));


        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":city_id", $this->city_id);
        $stmt->bindParam(":username", $this->username);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function update(): bool|PDOStatement
    {
    $query = "UPDATE
            " . $this->table_name . "
        SET
            name = :name,
            username = :username,
            city_id = :city_id,
        WHERE
            id = :id";

    $stmt = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->city_id = htmlspecialchars(strip_tags($this->city_id));

    // привязываем значения
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":city_id", $this->city_id);
    $stmt->bindParam(":id", $this->id);

    // выполняем запрос
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

function delete()
{
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(":id", $this->id);

    // выполняем запрос
    if ($stmt->execute()) {
        return true;
    }
    return false;
}
}
?>