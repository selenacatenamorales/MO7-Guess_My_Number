<?php

include_once 'DatabaseConnection.php';

/**
 * Implementació de la clase DatabaseConnection segons el model Procedimental.
 *
 * @author Pep
 */
class DatabaseProc extends DatabaseConnection {

    const TABLE_START = "<table style='border: solid 1px black;'><tr style='background: grey;'><th>Id</th><th>Modalitat</th><th>Nivell</th><th>Data</th><th>Intents</th></tr>";
    const TABLE_END = "</table>";

    private $database;

    public function __construct($servername, $username, $password, $database) {
        parent::__construct($servername, $username, $password);
        $this->database = $database;
    }

//put your code here
    public function connect(): void {

        $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
        // set the PDO error mode to exception    
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        echo "Connected successfully";
    }

    public function insert($modalitat, $nivell, $intents): int {
        try {
            // prepare sql and bind parameters
            $stmt = "INSERT INTO estadistiques (modalitat, nivell, intents) VALUES ('" . $modalitat . "', '" . $nivell . "', '" . $intents . "')";

            mysqli_query($this->connection, $stmt);

            return mysqli_insert_id($this->connection);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function delete($id): void {
        try {
            // prepare sql and bind parameters
            $stmt = "delete from estadistiques where id = " . $id;


            mysqli_query($this->connection, $stmt);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function selectAll() {
        $stmt = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques";
        $resultado = mysqli_query($this->connection, $stmt);
        //var_dump($resultado);

        if (mysqli_num_rows($resultado) > 0) {
            echo "<table><tr><th>ID</th><th>MODALITAT</th><th>NIVELL</th><th>DATA_PARTIDA</th><th>INTENTS</th></tr>";
            // output data of each row
            while ($row = mysqli_fetch_assoc($resultado)) {
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

    public function findById($id): void {
        $stmt = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques where id = " . $id;
        $resultado = mysqli_query($this->connection, $stmt);
        if (mysqli_num_rows($resultado) > 0) {
            echo "<table><tr><th>ID</th><th>MODALITAT</th><th>NIVELL</th><th>DATA_PARTIDA</th><th>INTENTS</th></tr>";

            while ($row = mysqli_fetch_assoc($resultado)) {
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

    public function update($estadistica): void {

        try {
            $stmt = "UPDATE ESTADISTIQUES SET modalitat = '" . $estadistica->modalitat .
                    "', nivell = " . $estadistica->nivell .
                    ", data_partida = '" . $estadistica->data_partida .
                    "', intents = " . $estadistica->intents .
                    " WHERE id = '" . $estadistica->id . "'; ";


            mysqli_query($this->connection, $stmt);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

}
