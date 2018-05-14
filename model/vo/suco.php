<?php
    include_once 'bebida.php';
    class Suco extends Bebida{
        
        private $id;
        private $sabor;
        
        function __construct() {
            
        }
        
        function getId() {
            return $this->id;
        }

        function getSabor() {
            return $this->sabor;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setSabor($sabor) {
            $this->sabor = $sabor;
        }



    }
?>

