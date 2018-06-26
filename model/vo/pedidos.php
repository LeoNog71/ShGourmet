<?php
    class Pedidos{
        
        private $id;
        private $idCliente;
        private $idFuncionario;
        private $data;
        private $valor_total;
        private $produtos;
        private $situacao;
        private $cancelado;
                
        function __construct() {
            $this->produtos = array();
        }
        
        function getId() {
            return $this->id;
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
            $this->produtos.push($produtos);
        }
        function getSituacao() {
            return $this->situacao;
        }
        function setSituacao($situacao) {
            $this->situacao = $situacao;
        }
        function getCancelado() {
            return $this->cancelado;
        }

        function setCancelado($cancelado) {
            $this->cancelado = $cancelado;
        }

        function getIdCliente() {
            return $this->idCliente;
        }

        function getIdFuncionario() {
            return $this->idFuncionario;
        }

        function setIdCliente($idCliente) {
            $this->idCliente = $idCliente;
        }

        function setIdFuncionario($idFuncionario) {
            $this->idFuncionario = $idFuncionario;
        }


    }
        
?>
