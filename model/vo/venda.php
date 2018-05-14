<?php
    class Venda{
        
        private $id;
        private $cliente;
        private $funcionario;
        private $mesa;
        private $data;
        private $valor_total;
        private $valor_desconto;
        private $produtos;
        private $situacao;
        function __construct() {
            
        }
        
        function getId() {
            return $this->id;
        }

        function getCliente() {
            return $this->cliente;
        }

        function getFuncionario() {
            return $this->funcionario;
        }

        function getMesa() {
            return $this->mesa;
        }

        function getData() {
            return $this->data;
        }

        function getValor_total() {
            return $this->valor_total;
        }

        function getValor_desconto() {
            return $this->valor_desconto;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setCliente($cliente) {
            $this->cliente = $cliente;
        }

        function setFuncionario($funcionario) {
            $this->funcionario = $funcionario;
        }

        function setMesa($mesa) {
            $this->mesa = $mesa;
        }

        function setData($data) {
            $this->data = $data;
        }

        function setValor_total($valor_total) {
            $this->valor_total = $valor_total;
        }

        function setValor_desconto($valor_desconto) {
            $this->valor_desconto = $valor_desconto;
        }
        
        function getProdutos() {
            return $this->produtos;
        }

        function setProdutos($produtos) {
            $this->produtos = $produtos;
        }

        function getSituacao() {
            return $this->situacao;
        }

        function setSituacao($situacao) {
            $this->situacao = $situacao;
        }




    }
?>

