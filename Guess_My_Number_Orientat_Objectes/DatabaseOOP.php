<?php

include_once 'DatabaseConnection.php';
include_once 'Estadistica.php';

/**
 * Implementació de la clase DatabaseConnection segons el model OOP,
 * Object Oriented Programming.
 *
 * @author Pep
 */
class DatabaseOOP extends DatabaseConnection {

    public function __construct($servername, $username, $password, $database) {
        parent::__construct($servername, $username, $password);
        $this->database = $database;
    }

    //put your code here
    public function connect(): void {

        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
        // set the PDO error mode to exception
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function insert($modalitat, $nivell, $intents): int {
        try {
            // prepare sql and bind parameters
            $stmt = "INSERT INTO estadistiques (modalitat, nivell, intents) VALUES ('" . $modalitat . "', '" . $nivell . "', '" . $intents . "')";
            $stmt = $this->connection->query($stmt);
            return $this->connection->insert_id;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function selectAll(): void {
        $stmt = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques";
        $stmt = $this->connection->query($stmt);
        if ($stmt->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>MODALITAT</th><th>NIVELL</th><th>DATA_PARTIDA</th><th>INTENTS</th></tr>";
            // output data of each row
            while ($row = $stmt->fetch_assoc()) {
                echo "<tr><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["id"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["modalitat"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["nivell"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["data_partida"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["intents"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }
    
    
    public function selectModalitat($modalitat): void {
        $stmt = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques where modalitat='" .$modalitat."'";
        $stmt = $this->connection->query($stmt);
        if ($stmt->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>MODALITAT</th><th>NIVELL</th><th>DATA_PARTIDA</th><th>INTENTS</th></tr>";
            // output data of each row
            while ($row = $stmt->fetch_assoc()) {
                echo "<tr><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["id"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["modalitat"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["nivell"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["data_partida"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["intents"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }

    public function delete($id): void {
        try{
            
            $stmt = "DELETE FROM ESTADISTIQUES WHERE id = ".$id;
            $stmt = $this->connection->query($stmt);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function update($estadistica): void{
        try{
            
          $stmt = "UPDATE ESTADISTIQUES SET modalitat = '" .$estadistica->modalitat .
                  "', nivell = "  .$estadistica->nivell .
                  ", data_partida = '" .$estadistica->data_partida .
                  "', intents = " .$estadistica->intents .
                  " WHERE id = '".$estadistica->id. "'; ";
            echo $stmt;
            $stmt = $this->connection->query($stmt);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
    
        public function findById($id): void {
        $stmt = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques where id = ".$id;
        $stmt = $this->connection->query($stmt);
        if ($stmt->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>MODALITAT</th><th>NIVELL</th><th>DATA_PARTIDA</th><th>INTENTS</th></tr>";
            // output data of each row
            while ($row = $stmt->fetch_assoc()) {
                echo "<tr><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["id"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["modalitat"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["nivell"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["data_partida"] . 
                        "</td><td style='width:150px;border:1px solid blue;background:silver;'>" . $row["intents"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }

}
