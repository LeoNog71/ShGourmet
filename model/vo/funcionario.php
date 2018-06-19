<?php
    
    include_once 'pessoa.php';
    
    class Funcionario extends Pessoa{
        private $id;
        private $data_adimissao;
        private $cpf;
        private $email;
        
        function __construct() {
            parent::__construct();
            
        }
        
                
        function getId() {
            return $this->id;
        }

        function getData_adimissao() {
            return $this->data_adimissao;
        }

        function getCpf() {
            return $this->cpf;
        }

        function getEmail() {
            return $this->email;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setData_adimissao($data_adimissao) {
            $this->data_adimissao = $data_adimissao;
        }

        function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        function setEmail($email) {
            $this->email = $email;
        }



    }

    


?>

