<?php
    include_once 'produto.php';
    class Bebida extends Produto{
        
        private $id;
        private $marca;
        private $tamanho;
        private $quantidade;
        
        function __construct() {
            
        }
        
        function getId() {
            return $this->id;
        }

        function getMarca() {
            return $this->marca;
        }

        function getTamanho() {
            return $this->tamanho;
        }

        function getQuantidade() {
            return $this->quantidade;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setMarca($marca) {
            $this->marca = $marca;
        }

        function setTamanho($tamanho) {
            $this->tamanho = $tamanho;
        }

        function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }


    }
    
?>

