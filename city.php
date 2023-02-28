<?php
class City
{
    private ?PDO $conn;
    private string $table_name = "city";
    public string $id;
    public string $cityname;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get(): bool|PDOStatement
    {

        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function create(): bool
    {

        $query = "INSERT INTO " . $this->table_name . " SET name=:name, id=:id";

        $stmt = $this->conn->prepare($query);


        $this->cityname = htmlspecialchars(strip_tags($this->cityname));
        $this->id = htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(":name", $this->cityname);
        $stmt->bindParam(":id", $this->id);

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
            cityname = :cityname,
        WHERE
            id = :id";

    $stmt = $this->conn->prepare($query);

    $this->cityname = htmlspecialchars(strip_tags($this->cityname));

    // привязываем значения
    $stmt->bindParam(":cityname", $this->cityname);
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