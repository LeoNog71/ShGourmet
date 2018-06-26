<?php
    class Produto{
        
        private $id;
        private $nome;
        private $descricao;
        private $preco_venda;
        private $preco_compra;
        private $disponivel;
        private $quantidade;
        private $fornecedor;
        
        function __construct() {
            
        }
        function getId() {
          return $this->id;
        }
        function getQuantidade() {
            return $this->quantidade;
        }

        function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }

                

        function getNome() {
            return $this->nome;
        }

        function getDescricao() {
            return $this->descricao;
        }

        function getPreco_venda() {
            return $this->preco_venda;
        }

        function getPreco_compra() {
            return $this->preco_compra;
        }

        function getDisponivel() {
            return $this->disponivel;
        }

        function getFornecedor() {
            return $this->fornecedor;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNome($nome) {
            $this->nome = $nome;
        }

        function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        function setPreco_venda($preco_venda) {
            $this->preco_venda = $preco_venda;
        }

        function setPreco_compra($preco_compra) {
            $this->preco_compra = $preco_compra;
        }

        function setDisponivel($disponivel) {
            $this->disponivel = $disponivel;
        }

        function setFornecedor($fornecedor) {
            $this->fornecedor = $fornecedor;
        }



    }
?>

