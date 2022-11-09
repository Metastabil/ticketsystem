<?php
class Database {
    public function connect() {
         $connection_string = 'mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME;

        try {
            $connection = new PDO($connection_string, DATABASE_USER, DATABASE_PASSWORD);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception) {
            if (ENVIRONMENT === 'development') {
                echo 'Error: ' . $exception->getMessage();
                die();
            }
            else {
                header("Location: error.php");
                die();
            }
        }

        return $connection;
    }
}