<?php
    class ConexaoDao{
        public function getConection(){
            $conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "root", "labzwv20");
            return $conn;
        }
        public function closeConection(){
            
        }
    }

?>


