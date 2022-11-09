<?php
class Status {
    private $_connection;

    public function __construct($connection) {
        $this->_connection = $connection;
    }

    public function get() {
        $sql = "SELECT id AS ID, name AS Name, DATE_FORMAT(created_at, '%d.%m.%Y') AS CreatedAt, DATE_FORMAT(updated_at, '%d.%m.%Y') AS UpdatedAt FROM status";
        $statement = $this->_connection->prepare($sql);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $status[] = $row;
        }

        return (count($status) > 0) ? $status : [];
    }

    public function create(array $data) {
        $sql = "INSERT INTO status (name) VALUES(?)";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute($data);
    }
}