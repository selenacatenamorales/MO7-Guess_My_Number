<?php
require_once 'guess_my_number.php';
include_once 'guess_my_number.php';
require_once 'DatabaseOOP.php';
include_once 'DatabaseOOP.php';
session_start();
$objeto = $_SESSION["obj"];
$contador  = $_SESSION["contador"];
$modalitat = null;

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="background-color: lightblue; text-align: center; font-family: arial" >
        <div>
            <?php
            
             $db = null;
             
            try {
            $db = new DatabaseOOP("localhost:3306", "root", "", "m07uf3");
            $db->connect();
            if($_SESSION["modalitat"] == 'M'){
                $modalitat = ModalitatEnum::MAQUINA;
            }
            else{
              $modalitat = ModalitatEnum::HUMA;  
            }
            $last_record = $db->insert($modalitat ,$_SESSION["nivell"] , $contador);
            echo "<p>Registre $last_record inserit correctament</p>";

        } catch (Exception $error) {
            echo "connection failed: " . $error->getMessage();
        }
       
            
            echo "<div style='margin-top: 200px'>";
            if ($_SESSION["modalitat"] == 'M'){
            echo "<h1>L'he endevinat!!!!!</h1>";
            }
            else{
                 echo "<h1>Felicitats l'has endevinat</h1>";
            }
            echo "<p>Numero: ".$objeto -> PrintNumero()."<br>Intents: $contador </p>"
            ?>
            <form action="estadistiques_finals.php" method="get">
                <button type="submit" name="veure_estadistiques" value="si">Veure estadistiques</button>
            </form>
            <form action="index.php" method="get">
                <button type="submit" name="tornar_a_jugar" value="si">Tornar a jugar</button>
            </form>
        </div>
        </div>
    </body>
</html>

