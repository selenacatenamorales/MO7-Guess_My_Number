<?php
session_start();

$_SESSION["nivell"] = $_GET["nivell"];

$modalitat = $_GET["modalidad"];
$_SESSION["modalitat"] = $modalitat;

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="background-color: lightblue; text-align: center; font-family: arial" >
        <?php
        if ($modalitat == 'M') {
            header("Location: maquina.php");
        }
        
        else{
            header("Location: persona.php");
        }
        ?>

    </body>

</html>