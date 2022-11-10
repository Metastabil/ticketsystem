<?php
class User {
    private $_connection;

    public function __construct($connection) {
        $this->_connection = $connection;
    }

    public function get() {
        $sql = "SELECT id AS ID, email AS Email, DATE_FORMAT(created_at, '%d.%m.%Y') AS CreatedAt, DATE_FORMAT(updated_at, '%d.%m.%Y') AS UpdatedAt FROM users";
        $statement = $this->_connection->prepare($sql);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $users[] = $row;
        }

        return (count($users) > 0) ? $users : [];
    }

    public function get_by_id($id) {
        $sql = "SELECT id AS ID, email AS Email, DATE_FORMAT(created_at, '%d.%m.%Y') AS CreatedAt, DATE_FORMAT(updated_at, '%d.%m.%Y') AS UpdatedAt FROM users WHERE id = ?";
        $statement = $this->_connection->prepare($sql);
        $statement->execute([intval($id)]);

        while ($row = $statement->fetch()) {
            $users[] = $row;
        }

        return (count($users) > 0) ? $users[0] : [];
    }

    public function create(array $data) {
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute($data);
    }

    public function update(array $data) {
        if (!empty($data['password'])) {
            $sql = "UPDATE users SET email = ?, password = ? WHERE id = ?";
        }
        else {
            $sql = "UPDATE users SET email = ? WHERE id = ?";
        }

        $statement = $this->_connection->prepare($sql);

        return $statement->execute($data);
    }

    public function delete(int $id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute([$id]);
    }


    // TODO ~> Doesn't set the user data in $_SESSION
    public function check_credentials(array $data) {
        $result = false;
        $statement_data = [
            $data['email']
        ];

        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        $statement = $this->_connection->prepare($sql);
        $statement->execute($statement_data);

        while ($row = $statement->fetch()) {
            $users[] = $row;
        }

        if (count($users) < 1) {
            $user = $users[0];

            if (password_verify($data['password'], $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email']
                ];

                $result = true;
            }
        }

        return $result;
    }
}