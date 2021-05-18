<?php

abstract class GuessMyNumber{
   private $NumeroEndevinar;
   private $min;
   private $max;
   
   function __construct($max){
     $this-> min = 1; 
     $this->max = $max;
     $this->NumeroEndevinar = rand($this->min, $this -> max);
    }
    
    function getNumeroEndevinar() {
        return $this->NumeroEndevinar;
    }

    function getMin() {
        return $this->min;
    }

    function getMax() {
        return $this->max;
    }

    function setNumeroEndevinar($NumeroEndevinar) {
        $this->NumeroEndevinar = $NumeroEndevinar;
    }

    function setMin($min) {
        $this->min = $min;
    }

    function setMax($max) {
        $this->max = $max;
    }
    
    function PrintNumero(){
        echo  $this -> NumeroEndevinar ;
    }
        
}



 class GuessMyNumberMaquina extends GuessMyNumber{
    
}

class GuessMyNumberPersona extends GuessMyNumber{
    
}