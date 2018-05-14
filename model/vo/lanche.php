<?php
    include_once 'produto.php';
    
    class Lanche extends Produto{
        private $id;
        private $adicionais;
        
        
        function getAdicionais() {
            return $this->adicionais;
        }

        function setAdicionais($adicionais) {
            $this->adicionais = $adicionais;
        }

        function getId() {
            return $this->id;
        }


    }
?>