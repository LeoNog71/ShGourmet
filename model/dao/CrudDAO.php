<?php
    abstract class CrudDao{
        private $classe;
        private $con;
        
        public function __construct($classe) {
            $this->classe = $classe;
            $this->con = new ConexaoDao().getConection();
        }
        
        public abstract function insert();
        public abstract function update();
        public abstract function select($consulta);
    }
?>

