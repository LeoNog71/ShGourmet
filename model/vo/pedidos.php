<?php

    class Lancamentos{
        private $id;
        private $valor;
        private $descricao;
        
        
        function __construct() {
            
        }
        
        function getId() {
            return $this->id;
        }

        function getValor() {
            return $this->valor;
        }

        function getDescricao() {
            return $this->descricao;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setValor($valor) {
            $this->valor = $valor;
        }

        function setDescricao($descricao) {
            $this->descricao = $descricao;
        }



    }
?>