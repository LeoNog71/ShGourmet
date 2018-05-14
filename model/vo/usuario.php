<?php
    include_once 'funcionario.php';
    class Usuario extends Funcionario{
        private $id;
        private $login;
        private $senha;
        private $permissao;
        private $funcionario;
        
        function __construct($funcionario) {
            $this->funcionario = $funcionario;
            $this->login = funcionario.getEmail();
        }
        function getId() {
            return $this->id;
        }

        function getLogin() {
            return $this->login;
        }

        function getSenha() {
            return $this->senha;
        }

        function getPermissao() {
            return $this->permissao;
        }

        function getFuncionario() {
            return $this->funcionario;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setLogin($login) {
            $this->login = $login;
        }

        function setSenha($senha) {
            $this->senha = $senha;
        }

        function setPermissao($permissao) {
            $this->permissao = $permissao;
        }

        function setFuncionario($funcionario) {
            $this->funcionario = $funcionario;
        }



    }
    
?>