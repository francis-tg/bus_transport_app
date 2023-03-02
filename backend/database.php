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
            'ville' => 'VARCHAR(30) NOT NULL',
            'reached_time' => 'VARCHAR(30) NOT NULL',
            'createdAt' => 'DATETIME(6) DEFAULT CURRENT_TIMESTAMP NOT NULL',
        ]);
        $this->createTable("depart", [
            'id' => 'INT(6) AUTO_INCREMENT PRIMARY KEY',
            'ville' => 'VARCHAR(30) NOT NULL',
            'leave_time' => 'VARCHAR(30) NOT NULL',
            'createdAt' => 'DATETIME(6) DEFAULT CURRENT_TIMESTAMP NOT NULL',
        ]);

        $this->createTable("ticket", [
            'id' => 'INT(6)  AUTO_INCREMENT PRIMARY KEY',
            'prix' => 'INT(10) NOT NULL',
            "nom_client" => "VARCHAR(60) NOT NULL",
            'phone' => 'VARCHAR(30)',
            "id_trajet" => 'INT(6)',
            'createdAt' => 'DATETIME(6) DEFAULT CURRENT_TIMESTAMP NOT NULL',
        ]);
        
        $this->createRelationship("ticket", "id_trajet", "trajet", "id");
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

        $this->addColumn("user", "password", "VARCHAR(60)");
    }
}
