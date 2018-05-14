<?php
    class ConexaoDao{
        public function getConection(){
            $conn = new PDO("mysql:dbname=shgourmet;host=localhost", "root", "viviane");
            return $conn;
        }
        public function closeConection(){
            
        }
    }

?>


