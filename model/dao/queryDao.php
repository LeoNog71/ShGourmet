<?php
    abstract class QueryDao{
        private $classe;
        private $con;
        
        function __construct($classe) {
            $this->classe = $classe;
            $this->con = new ConexaoDao().getConection();
        }
        
        function insert(){
            
        }
        function update(){
            
        }
        function select(){
            
        }

    }
?>

