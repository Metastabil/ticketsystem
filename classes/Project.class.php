<?php
class Project {
    private $_connection;
    private $_select_all_query_without_joins = "SELECT id AS ID, name AS Name, description AS Description, status_id AS StatusID, DATE_FORMAT(created_at, '%d.%m.%Y') AS CreatedAt, DATE_FORMAT(updated_at, '%d.%m.%Y') AS UpdatedAt FROM projects";
    private $_select_all_query_with_joins = "SELECT P.id AS ID, P.name AS Name, P.description AS Description, P.status_id AS StatusID, DATE_FORMAT(P.created_at, '%d.%m.%Y') AS CreatedAt, DATE_FORMAT(P.updated_at, '%d.%m.%Y') AS UpdatedAt, S.name AS Status 
                                             FROM projects AS P 
                                             JOIN status AS S ON P.status_id = S.id";

    public function __construct($connection) {
        $this->_connection = $connection;
    }

    public function get(int $joins = 0) {
        $sql = ($joins) ? $this->_select_all_query_with_joins : $this->_select_all_query_without_joins;
        $statement = $this->_connection->prepare($sql);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $groups[] = $row;
        }

        return (count($groups) > 0) ? $groups : [];
    }

    public function get_by_id(int $id, int $joins = 0) {
        $sql = ($joins) ? $this->_select_all_query_with_joins . " WHERE P.id = ?" : $this->_select_all_query_without_joins . " WHERE P.id = ?";
        $statement = $this->_connection->prepare($sql);
        $statement->execute([intval($id)]);

        while ($row = $statement->fetch()) {
            $groups[] = $row;
        }

        return (count($groups) > 0) ? $groups[0] : [];
    }

    public function create(array $project_data, array $assigned_users, array $assigned_groups) {
        $success = true;

        $sql = "INSERT INTO projects (name, description, status_id) VALUES(?, ?, ?)";
        $statement = $this->_connection->prepare($sql);

        if ($statement->execute($project_data)) {
            $project_id = $this->_connection->lastInsertId();

            if (count($assigned_groups) > 0) {
                foreach ($assigned_groups as $ag) {
                    $sql = "INSERT INTO group_project (group_id, project_id) VALUES(?, ?)";
                    $group_statement = $this->db->prepare($sql);

                    $success = ($group_statement->execute([$project_id, $ag])) ? true : false;
                }
            }

            if (count($assigned_users) > 0) {
                foreach ($assigned_users as $au) {
                    $sql = "INSERT INTO group_project (group_id, project_id) VALUES(?, ?)";
                    $user_statement = $this->db->prepare($sql);

                    $success = ($user_statement->execute([$project_id, $au])) ? true : false;
                }
            }
        }
        else {
            $success = false;
        }

        return $success;
    }

    public function edit(int $id, array $project_data, array $assigned_groups, array $assigned_users) {
        $success = true;

        $project_data[] = intval($id);

        $sql = "UPDATE projects SET name = ?, description = ?, status_id = ? WHERE id = ?";
        $statement = $this->_connection->prepare($sql);

        if ($statement->exeucte($project_data)) {
            $this->_delete_project_group_associations(intval($id));
            $this->_delete_user_group_associations(intval($id));

            if (count($assigned_groups) > 0) {
                foreach ($assigned_groups as $ag) {
                    $sql = "INSERT INTO group_project (group_id, project_id) VALUES(?, ?)";
                    $group_statement = $this->db->prepare($sql);

                    $success = ($group_statement->execute([$id, $ag])) ? true : false;
                }
            }

            if (count($assigned_users) > 0) {
                foreach ($assigned_users as $au) {
                    $sql = "INSERT INTO group_project (group_id, project_id) VALUES(?, ?)";
                    $user_statement = $this->db->prepare($sql);

                    $success = ($user_statement->execute([$id, $au])) ? true : false;
                }
            }
        }
        else {
            $success = false;
        }

        return $success;
    }

    public function delete(int $id) {
        $success = true;

        $sql = "DELETE FROM projects WHERE id = ?";
        $statement = $this->_connection->prepare($sql);

        if ($statement->execute([$id])) {
            $success = ($this->_delete_project_group_associations(intval($id))) ? true : false;
            $success = ($this->_delete_user_group_associations(intval($id))) ? true : false;
        }
        else {
            $success = false;
        }

        return $success;
    }

    /*
     * ------------------------------------------------------------------------
     * Private Methods---------------------------------------------------------
     * ------------------------------------------------------------------------
     */

    /* Deletes all associations in table group_project for given project */
    private function _delete_project_group_associations(int $id) {
        $sql = "DELETE FROM group_project WHERE project_id = ?";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute([intval($id)]);
    }

    /* Deletes all associations in table user_project for given project */
    private function _delete_user_group_associations(int $id) {
        $sql = "DELETE FROM user_project WHERE project_id = ?";
        $statement = $this->_connection->prepare($sql);

        return $statement->execute([intval($id)]);
    }
}