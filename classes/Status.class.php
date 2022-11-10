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

    public function get_by_id(int $id) :array {
        $sql = "SELECT id AS ID, name AS Name, DATE_FORMAT(created_at, '%d.%m.%Y') AS CreatedAt, DATE_FORMAT(updated_at, '%d.%m.%Y') AS UpdatedAt FROM status WHERE id = ?";
        $statement = $this->_connection->prepare($sql);
        $statement->execute([$id]);

        while ($row = $statement->fetch()) {
            $status[] = $row;
        }

        return (count($status) > 0) ? $status[0] : [];
    }

    public function create(array $data) {
        $sql = "INSERT INTO status (name) VALUES(?)";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute($data);
    }

    public function update(array $data) :bool {
        $sql = "UPDATE status SET name = ? WHERE id = ?";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute($data);
    }

    public function delete(int $id) :bool {
        $sql = "DELETE FROM status WHERE id = ?";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute([$id]);
    }
}