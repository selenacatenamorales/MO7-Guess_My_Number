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
            <form action="index.php" method="get">
                <button type="submit" name="tornar_a_jugar" value="si">Tornar a jugar</button>
            </form>

            <div id="taula">
                <?php
                $db = null;

                try {
                    $db = new DatabaseOOP("localhost:3306", "root", "", "m07uf3");
                    $db->connect();
                    $db->selectAll();
                } catch (Exception $error) {
                    echo "connection failed: " . $error->getMessage();
                }
                ?>
            </div>
            <form action="index.php" method="get">
                <button type="submit" name="tornar_a_jugar" value="si">Tornar a jugar</button>
            </form>
        </div>
    </div>
</body>
</html>
