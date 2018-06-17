<?php
    include_once 'IDAO.php';
    abstract class CrudDao implements IDAO{
        private $classe;
        private $conn;
        
        public function __construct($classe) {
            $this->classe = $classe;
            $this->conn = new ConexaoDao().getConection();
        }
        public function insert(){
            
        }
        public function select($consulta) {
            
        }
        public function update() {
            
        }
        public function delete(){
            
        }
        
    }
?>

