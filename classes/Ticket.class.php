<?php
class Ticket {
    private $_connection;
    private $_select_all_query_without_joins = "id AS ID, name AS Name, description AS Description, due_date AS DueDate, responsible_user_id AS ResponsibleUserID, project_id AS ProjectID, status_id AS StatusID,";

    public function __construct($connection) {
        $this->_connection = $connection;
    }


}