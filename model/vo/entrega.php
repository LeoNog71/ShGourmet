<?php
    
    
    class Entrega {
        
        private $id;
        private $venda;
        private $endereco;
        
        function __construct() {
            
        }
        
        function getId() {
            return $this->id;
        }

        function getVenda() {
            return $this->venda;
        }

        function getEndereco() {
            return $this->endereco;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setVenda($venda) {
            $this->venda = $venda;
        }

        function setEndereco($endereco) {
            $this->endereco = $endereco;
        }



    }
?>