<?php
    include_once 'produto.php';
    
    class Porcao extends Produto{
        private $tamanho;
        private $id;
        
        function getTamanho() {
            return $this->tamanho;
        }

        function getId() {
            return $this->id;
        }

        function setTamanho($tamanho) {
            $this->tamanho = $tamanho;
        }



    }
    
?>

