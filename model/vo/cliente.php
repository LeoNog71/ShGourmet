<?php
    
    include_once 'pessoa.php';
    
    class Cliente extends Pessoa{
        private $id;
        private $cpf;
        private $situacao;
        
        function __construct() {
            
        }
        
        function getId() {
            return $this->id;
        }

        function getCpf() {
            return $this->cpf;
        }

        function getSituacao() {
            return $this->situacao;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        function setSituacao($situacao) {
            $this->situacao = $situacao;
        }



    }

?>