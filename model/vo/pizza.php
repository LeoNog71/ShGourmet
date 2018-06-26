<?php
    include_once 'produto.php';
    
    class Pizza extends Produto{
        private $id;
        private $tamanho;
        private $sabores;
        
        function getTamanho() {
            return $this->tamanho;
        }

        function getSabores() {
            return $this->sabores;
        }

        function setTamanho($tamanho) {
            $this->tamanho = $tamanho;
        }

        function setSabores($sabores) {
            $this->sabores = $sabores;
        }

        function getId() {
            return $this->id;
        }
        function setId($id) {
            $this->id = $id;
        }


    }
?>