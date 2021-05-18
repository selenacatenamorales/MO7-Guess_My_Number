<?php
require_once 'guess_my_number.php';
include_once 'guess_my_number.php';
require_once 'DatabaseOOP.php';
include_once 'DatabaseOOP.php';
session_start();
$objeto = $_SESSION["obj"];
$contador = $_SESSION["contador"];
$modalitat = null;
if (isset($_GET["insertar"])) {
    if ($_GET["insertar"] == "si") {
        $db = new DatabaseOOP("localhost:3306", "root", "", "m07uf3");
        $db->connect();
        $last_record = $db->insert($_GET["Modalitat"], $_GET["nivell"], $_GET["contador"]);
        echo "<p>Nou registre " . $last_record;
    }
}
if (isset($_GET["eliminar"])) {
    if ($_GET["eliminar"] == "si") {
        $db = new DatabaseOOP("localhost:3306", "root", "", "m07uf3");
        $db->connect();
        $db->delete($_GET["id"]);
    }
}

if (isset($_GET["actualitzar"])) {
    if ($_GET["actualitzar"] == "si") {
        $db = new DatabaseOOP("localhost:3306", "root", "", "m07uf3");
        $db->connect();
        $db->update(new Estadistica($_GET["id2"], $_GET["Modalitat2"], $_GET["nivell2"], $_GET["data"], $_GET["contador2"]));
    }
}
?>
<html>
    <head>

        <meta charset="UTF-8">
        <title></title>

    </head>
    <body style="background-color: lightblue; text-align: center; font-family: arial" >
        <div>
            <form action="estadistiques_finals.php" method="get">
                <select name="modi" onchange="this.form.submit()">
                    <option value="">Selecciona una modalitat</option>
                    <option value="1">Huma</option>
                    <option value="2">Maquina</option>
                    <option value="3">Tots</option>
                </select>
            </form>

            <div id="taula">
                <?php
                $db = null;

                try {
                    $db = new DatabaseOOP("localhost:3306", "root", "", "m07uf3");
                    $db->connect();
                    if (isset($_GET["modi"])) {
                        switch ($_GET["modi"]) {
                            case "1": $db->selectModalitat("Huma");
                                break;
                            case "2": $db->selectModalitat("Maquina");
                                break;
                            default:
                                $db->selectAll();
                                ;
                                break;
                        }
                    }
                    else{
                    $db->selectAll();
                    }
                } catch (Exception $error) {
                    echo "connection failed: " . $error->getMessage();
                }
                ?>
            </div>
            <form action="index.php" method="get">
                <button type="submit" name="tornar_a_jugar" value="si">Tornar a jugar</button>
            </form>
            <div>
                <form action="estadistiques_finals.php" method="get">
                    <h2>CRUD</h2>
                    <p>Insertar un nou registre: </p>
                    Modalitat: 
                    <select name="Modalitat">
                        <option value="Huma">Huma</option> 
                        <option value="Maquina">Maquina</option> 
                    </select>
                    Nivell:
                    <input type="number" name="nivell" value = "">
                    Contador:
                    <input type="number" name="contador" value = "">
                    <button type="submit" name="insertar" value="si">Inserta</button>
                    <p>Elimina un registre per la seva ID: </p>
                    <input type="number" name="id" value = "">
                    <button type="submit" name="eliminar" value="si">Elimina</button>
                    <p>Modifica un registre: </p>
                    ID: <input type="number" name="id2" value = "">
                    Modalitat: 
                    <select name="Modalitat2">
                        <option value="Huma">Huma</option> 
                        <option value="Maquina">Maquina</option> 
                    </select>
                    Nivell:
                    <input type="number" name="nivell2" value = "">
                    Data:
                    <input type="date" name="data" value = "">
                    Contador:
                    <input type="number" name="contador2" value = "">
                    <button type="submit" name="actualitzar" value="si">Actualitza</button>
                </form>

            </div>
        </div>
    </div>
</body>
</html>
