<?php
    
    interface IController {
        public function recebeJson();
        public function enviaJson();
        public function cadastrar();
        public function atualizar();
        public function excluir();
        public function pesquisa();
    }
?>

