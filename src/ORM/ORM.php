<?php

namespace Cisco\Shadow\ORM;
use Cisco\Shadow\cli\Cli;
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
    
    public function createTable(string $table_name, array $fields )
    {
        // Start building the SQL query
        $query = "CREATE TABLE IF NOT EXISTS $table_name (\n";
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
        $fq = "SELECT table_name, 
            column_name, 
            referenced_table_name, 
            referenced_column_name
            FROM information_schema.key_column_usage
            WHERE table_name='$table_name' AND referenced_table_name = '$related_table'";
        $f = $this->pdo->prepare($fq);
        $f->execute();
        if(empty($f->fetch()["referenced_table_name"])==true){
            $query = "ALTER TABLE $table_name ADD FOREIGN KEY ($field_name) REFERENCES $related_table($related_field) ON DELETE CASCADE ON UPDATE CASCADE";
            $this->pdo->exec($query);

        }
    }
    /**
     * Summary of addColumn
     * @param string $table_name
     * @param string $field_name
     * @param string $value
     * @return void
     */
    function addColumn(string $table_name, string $field_name, string  $value){
        $query = "ALTER TABLE $table_name ADD IF NOT EXISTS $field_name $value";
        Cli::consoleLog("info", $query);
        $this->pdo->exec($query);
    }
    /**
     * Summary of select
     * @param string $table
     * @param array $fields
     * @param string $where
     * @param string $order_by
     * @param string $limit
     * @return mixed
     */
    public function select(string $table, array $fields=["*"], string $where = "", string $order_by = "", string $limit = "", array $include=[])
    {
        $query = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        if(count($include) >0){
            $joins = "";
            foreach ($include as $r_table => $r_column) {
                $joins .=" JOIN $r_table ON $table".".".$r_column." = ".$r_table.".id ";
            }
            $query .= $joins;
        }
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
        Cli::consoleLog("info", $query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Summary of selectOne
     * @param string $table
     * @param array $fields
     * @param array $where
     * @param string $order_by
     * @param array $include
     * @return mixed
     */
    public function selectOne(string $table, array $fields=["*"], array $where=[], string $order_by = "",array $include=[]){
        $limit = 1;
        $query = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        if (count($include) > 0) {
            $joins = "";
            foreach ($include as $r_table => $r_column) {
                $joins .= " JOIN $r_table ON $table" . "." . $r_column . " = " . $r_table . ".id ";
            }
            $query .= $joins;
        }

        if (array_keys($where)>0) {
            $joins_where = "";
            

            $shift_array = array_shift($where);

            $extractfirst = array_keys($shift_array)[0];
           
            $joins_where .= " WHERE $extractfirst = '" . $shift_array[$extractfirst] . "'";
            foreach ($where as $column => $value) {
                $joins_where .= " AND ".array_keys($value)[0]." = '".array_values($value)[0]."'";
            }
            $query .= $joins_where;
        }
        if ($order_by != "") {
            $query .= " ORDER BY " . $order_by;
        }
        $query .= " LIMIT " . $limit;
        Cli::consoleLog("info", $query);
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

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
        Cli::consoleLog("info", $query);

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
        Cli::consoleLog("info", $query);

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
        Cli::consoleLog("info", $query);

        return $stmt->execute();
    }

}
