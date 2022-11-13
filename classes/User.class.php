<?php
class User {
    private $_connection;

    public function __construct($connection) {
        $this->_connection = $connection;
    }

    public function get(int $id = 0) :array {
        $users = [];

        if ($id > 0) {
            $sql = "SELECT id, first_name, last_name, email, password, is_administrator, DATE_FORMAT(created_at, '%d.%m.%Y') AS created_at, DATE_FORMAT(updated_at, '%d.%m.%Y') AS updated_at
                    FROM users
                    WHERE id = ?";
            $statement = $this->_connection->prepare($sql);
            $statement->execute([$id]);
        }
        else {
            $sql = "SELECT id, first_name, last_name, email, password, is_administrator, DATE_FORMAT(created_at, '%d.%m.%Y') AS created_at, DATE_FORMAT(updated_at, '%d.%m.%Y') AS updated_at
                    FROM users";
            $statement = $this->_connection->prepare($sql);
            $statement->execute();
        }

        while ($row = $statement->fetch()) {
            $users[] = $row;
        }

        if ($id > 0) {
            $return = (count($users) > 0) ? $users[0] : [];
        }
        else {
            $return = (count($users) > 0) ? $users : [];
        }

        return $return;
    }

    public function create(array $data) :bool {
        $sql = "INSERT INTO users (first_name, last_name, email, password, is_administrator) VALUES(?, ?, ?, ?, ?)";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute($data);
    }

    public function update(array $data) :bool {
        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, is_administrator = ? WHERE id = ?";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute($data);
    }

    public function update_password(array $data) :bool {
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute($data);
    }

    public function delete(int $id) :bool {
        $sql = "DELETE FROM users WHERE id = ?";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute([$id]);
    }

    public function check_credentials(array $credentials) :bool {
        $users = [];
        $success = false;
        $sql = "SELECT id, first_name, last_name, email, password, is_administrator FROM users WHERE email = ?";
        $statement = $this->_connection->prepare($sql);
        $statement->execute([$credentials['email']]);

        while ($row = $statement->fetch()) {
            $users[] = $row;
        }

        if (count($users) > 0) {
            $user = $users[0];

            if (password_verify($credentials['password'], $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'is_adminsitrator' => $user['is_administrator']
                ];

                $success = true;
            }
        }

        return $success;
    }
}