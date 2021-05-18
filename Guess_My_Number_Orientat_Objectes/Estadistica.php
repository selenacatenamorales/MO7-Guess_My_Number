<?php

class Estadistica{
    public $id;
    public $modalitat;
    public $nivell;
    public $data_partida;
    public $intents;
        
    function __construct($id, $mod, $nivell, $data, $intents){
     $this-> id = $id; 
     $this-> modalitat = $mod;
     $this-> nivell = $nivell;
     $this-> data_partida = $data;
     $this-> intents = $intents;
    }
}

