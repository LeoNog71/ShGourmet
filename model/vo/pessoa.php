<?php
    
    
    class Pessoa{
        
        private $id;
        private $nome;
        private $cpf;
        private $data_nascimento;
        private $endereco;
        
        function __construct() {
          
        }

        
        
        function getId() {
            return $this->id;
        }

        function getNome() {
            return $this->nome;
        }

        function getCpf() {
            return $this->cpf;
        }

        function getData_nascimento() {
            return $this->data_nascimento;
        }

        function getEndereco() {
            return $this->endereco;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNome($nome) {
            $this->nome = $nome;
        }

        function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        function setData_nascimento($data_nascimento) {
            $this->data_nascimento = $data_nascimento;
        }

        function setEndereco($endereco) {
            $this->endereco = $endereco;
        }


    }
?>
