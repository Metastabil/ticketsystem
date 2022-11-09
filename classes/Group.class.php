<?php
class Group {
    private $_connection;

    public function __construct($connection) {
        $this->_connection = $connection;
    }

    public function get() {
        $sql = "SELECT id AS ID, name AS Name, description AS Description, DATE_FORMAT(created_at, '%d.%m.%Y') AS CreatedAt, DATE_FORMAT(updated_at, '%d.%m.%Y') AS UpdatedAt FROM user_groups";
        $statement = $this->_connection->prepare($sql);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $groups[] = $row;
        }

        return (count($groups) > 0) ? $groups : [];
    }
}