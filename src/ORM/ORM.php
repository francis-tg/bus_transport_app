<?php

namespace Cisco\Shadow\ORM;
session_start();

use PDO;

class ORM extends db
{
      /**
       * Summary of createTable
       * @param string $table_name
       * @param array $fields
       * @return void
       */
    
    public function createTable(string $table_name, array $fields)
    {
        // Start building the SQL query
        $query = "CREATE TABLE $table_name (\n";
        // Add each field to the query
        foreach ($fields as $field_name => $field_type) {
            $query .= "$field_name $field_type,\n";
        }

        // Remove the trailing comma and add the closing parenthesis
        $query = rtrim($query, ",\n") . "\n)";
        
        // Execute the query
        $this->pdo->exec($query);
    }
    /**
     * Summary of createRelationship
     * @param string $table_name
     * @param string $field_name
     * @param string $related_table
     * @param string $related_field
     * @return void
     */
    public function createRelationship(string $table_name, string $field_name,string  $related_table, string $related_field)
    {
        $query = "ALTER TABLE $table_name ADD FOREIGN KEY ($field_name) REFERENCES $related_table($related_field) ON DELETE CASCADE ON UPDATE CASCADE";
        $this->pdo->exec($query);
    }
    /**
     * Summary of addColumn
     * @param string $table_name
     * @param string $field_name
     * @param string $value
     * @return void
     */
    function addColumn(string $table_name, string $field_name, string  $value){
        $query = "ALTER TABLE $table_name ADD $field_name $value";
        $this->pdo->exec($query);
    }
    /**
     * Summary of SELECT
     * @param mixed $table
     * @param mixed $fields
     * @param mixed $where
     * @param mixed $order_by
     * @param mixed $limit
     * @return mixed
     */
    public function select($table, $fields, $where = "", $order_by = "", $limit = "")
    {
        $query = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        if ($where != "") {
            $query .= " WHERE " . $where;
        }
        if ($order_by != "") {
            $query .= " ORDER BY " . $order_by;
        }
        if ($limit != "") {
            $query .= " LIMIT " . $limit;
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Summary of INSERT
     * @param string $table
     * @param array $data
     * @return mixed
     */
    public function insert(string $table, array $data)
    {
        $query = "INSERT INTO " . $table . " (" . implode(", ", array_keys($data)) . ") VALUES (:" . implode(", :", array_keys($data)) . ")";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($data);
    }

    /**
     * Summary of update
     * where 'id='.$user["id"] ||  * where 'id=1'
     * @param string $table
     * @param array $data
     * @param string $where
     * @return mixed
     * 
     * 
     */
    public function update(string $table, array $data, string $where)
    {
        $query = "UPDATE " . $table . " SET ";
        $query_parts = array();
        foreach ($data as $field => $value) {
            $query_parts[] = $field . " = :" . $field;
        }
        $query .= implode(", ", $query_parts) . " WHERE " . $where;
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($data);
    }
    /**
     * Summary of DELETE
     * @param string $table
     * @param string $where
     * @return mixed
     */
    public function delete(string $table, string $where)
    {
        $query = "DELETE FROM " . $table . " WHERE " . $where;
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute();
    }

}
