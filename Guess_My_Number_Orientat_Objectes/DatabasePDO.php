<?php

include_once 'DatabaseConnection.php';
include_once 'Estadistica.php';
/*
 * Implementació de la clase DatabaseConnection segons el model PDO, 
 * PHP Data Object.
 * @author Pep
 */

class DatabasePDO extends DatabaseConnection {

    const TABLE_START = "<table style='border: solid 1px black;'><tr style='background: grey;'><th>Id</th><th>Modalitat</th><th>Nivell</th><th>Data</th><th>Intents</th></tr>";
    const TABLE_END = "</table>";

    private $database;

    public function __construct($servername, $username, $password, $database) {
        parent::__construct($servername, $username, $password);
        $this->database = $database;
    }

    function connect(): void {
        try {
            $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function insert($modalitat, $nivell, $intents): int {
        try {
            // prepare sql and bind parameters
            $stmt = $this->connection->prepare("INSERT INTO estadistiques (modalitat, nivell, intents) VALUES (:modalitat, :nivell, :intents)");
            $stmt->bindParam(':modalitat', $modalitat);
            $stmt->bindParam(':nivell', $nivell);
            $stmt->bindParam(':intents', $intents);
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function delete($id): void {
        try {
            // prepare sql and bind parameters
            $stmt = $this->connection->prepare("delete from estadistiques where id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function selectAll() {
        $stmt = $this->connection->prepare("SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques");
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;
    }

    public function findById($id): void {
        $stmt = $this->connection->prepare("SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new EstadistiquesRow(new RecursiveArrayIterator($stmt->fetchAll())) as $key => $row) {
            echo $row;
        }
    }

    public function update($estadistica): void {
        try {
            $stmt = $this->connection->prepare("UPDATE ESTADISTIQUES SET MODALITAT = :MODALITAT, NIVELL = :NIVELL, DATA_PARTIDA = :DATA, INTENTS = :INTENTS WHERE ID = :ID ");
            $stmt->bindParam(':MODALITAT', $estadistica->modalitat);
            $stmt->bindParam(':NIVELL', $estadistica->nivell);
            $stmt->bindParam(':DATA', $estadistica->data_partida);
            $stmt->bindParam(':INTENTS', $estadistica->intents);
            $stmt->bindParam(':ID', $estadistica->id);
            $stmt->execute();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

}
