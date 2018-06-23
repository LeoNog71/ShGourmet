<?php
    include_once 'idFuncionario.php';
    class Usuario extends idFuncionario{
        private $id;
        private $login;
        private $senha;
        private $permissao;
        private $IdidFuncionario;
        
        function __construct($idFuncionario) {
            $this->idFuncionario = $idFuncionario;
            $this->login = idFuncionario.getEmail();
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

        function getIdFuncionario() {
            return $this->idFuncionario;
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

        function setIdFuncionario($idFuncionario) {
            $this->idFuncionario = $idFuncionario;
        }



    }
    
?>