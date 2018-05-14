<?php
    class Mesa{
        private $id;
        private $num_mesa;
        
        
        function __construct() {
            
        }
        
        function getId() {
            return $this->id;
        }

        function getNum_mesa() {
            return $this->num_mesa;
        }

        function setNum_mesa($num_mesa) {
            $this->num_mesa = $num_mesa;
        }


    }