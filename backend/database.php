<?php
use Cisco\Shadow\ORM\ORM;

class database extends ORM
{
    public function start()
    {
        $this->createTable("trajet", [
            'id' => 'INT(6) AUTO_INCREMENT PRIMARY KEY',
            'id_depart' => 'INT(6) NOT NULL',
            'id_dest' => 'INT(6) NOT NULL',
            'prix' => 'VARCHAR(30) NOT NULL',
            'createdAt' => 'DATETIME(6) DEFAULT CURRENT_TIMESTAMP NOT NULL',
        ]);

        $this->createTable("role", [
            'id' => 'INT(6) AUTO_INCREMENT PRIMARY KEY',
            'nom_role' => 'VARCHAR(30) NOT NULL',
            'createdAt' => 'DATETIME(6) DEFAULT CURRENT_TIMESTAMP NOT NULL',
        ]);
        $this->createTable("user", [
            'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'nom' => 'VARCHAR(30) NOT NULL',
            'prenom' => 'VARCHAR(30) NOT NULL',
            'phone' => 'VARCHAR(30)',
            'gender' => 'VARCHAR(30)',
            'id_role' => 'INT(30)',
        ]);
        $this->createRelationship("user", "id_role", "role", "id");
        $this->createTable("destination", [
            'id' => 'INT(6) AUTO_INCREMENT PRIMARY KEY',
            'dest_ville' => 'VARCHAR(30) NOT NULL',
            'reached_time' => 'VARCHAR(30) NOT NULL',
            'createdAt' => 'DATETIME(6) DEFAULT CURRENT_TIMESTAMP NOT NULL',
        ]);
        $this->createTable("depart", [
            'id' => 'INT(6) AUTO_INCREMENT PRIMARY KEY',
            'leave_ville' => 'VARCHAR(30) NOT NULL',
            'leave_time' => 'VARCHAR(30) NOT NULL',
            'createdAt' => 'DATETIME(6) DEFAULT CURRENT_TIMESTAMP NOT NULL',
        ]);

        $this->createTable("ticket", [
            'id' => 'INT(6)  AUTO_INCREMENT PRIMARY KEY',
            "id_client" => "INT(6) NOT NULL",
            "id_trajet" => 'INT(6) NOT NULL',
            'createdAt' => 'DATETIME(6) DEFAULT CURRENT_TIMESTAMP NOT NULL',
        ]);
        
        $this->createRelationship("ticket", "id_trajet", "trajet", "id");
        //$this->createRelationship("ticket", "id_client", "user", "id");
        $this->createRelationship("trajet", "id_dest", "destination", "id");
        $this->createRelationship("trajet", "id_depart", "depart", "id");



        if (!$this->select("role", ["*"],"nom_role='administrateur'")) {
            $this->insert("role", [
                "nom_role" => "administrateur",
            ]);

        }
        if (!$this->select("role", ["*"],"nom_role='personnel'")) {
            $this->insert("role", [
                "nom_role" => "personnel",
            ]);
        }
        if (!$this->select("role", ["*"], "nom_role='client'")) {
            $this->insert("role", [
                "nom_role" => "client",
            ]);
        }
        $this->addColumn("user", "password", "VARCHAR(60)");
        if (!$this->select("user", ["*"], "phone='admin'")) {
            $this->insert("user", [
                "phone" => "admin",
                "password"=>md5("password"),
                "id_role"=>1
            ]);
        }

    }
}
