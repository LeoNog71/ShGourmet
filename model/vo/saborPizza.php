<?php
    include_once 'produto.php';
    
    class SaborPizza extends Produto{
        private $id;
        
        
        function __construct() {
            
        }
        function getId() {
            return $this->id;
        }

        



    }
?>

