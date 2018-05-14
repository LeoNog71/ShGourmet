<?php
    class LivroCaixa{
        
        private $id;
        private $dataAbertura;
        private $dataFechamento;
        private $funcionario;
        private $total;
        private $lancamentos;
        
        function __construct() {
            
        }
        
        function getId() {
            return $this->id;
        }

        function getDataAbertura() {
            return $this->dataAbertura;
        }

        function getDataFechamento() {
            return $this->dataFechamento;
        }

        function getFuncionario() {
            return $this->funcionario;
        }

        function getTotal() {
            return $this->total;
        }

        function getLancamentos() {
            return $this->lancamentos;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setDataAbertura($dataAbertura) {
            $this->dataAbertura = $dataAbertura;
        }

        function setDataFechamento($dataFechamento) {
            $this->dataFechamento = $dataFechamento;
        }

        function setFuncionario($funcionario) {
            $this->funcionario = $funcionario;
        }

        function setTotal($total) {
            $this->total = $total;
        }

        function setLancamentos($lancamentos) {
            $this->lancamentos = $lancamentos;
        }



        
    }
?>