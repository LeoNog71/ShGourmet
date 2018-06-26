<?php

 include_once '..\vo\porcao.php';
    class PorcaoDAO {
             
            private $classe;
            private $conn;
            
            public function __construct($classe) {
                $this->classe = $classe;
                $this->conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
            }
            public function insert() {
                
                $stmt = $this->conn->prepare("call insert_porcao(:nome, :descricao, :preco_venda, :unidade, :preco_compra,:fornecedor, :tamanho);");
                $a = $this->classe->getNome();
                $stmt->bindParam(":nome", $a);
                $b = $this->classe->getDescricao();
                $stmt->bindParam(":descricao",$b);
                $c = $this->classe->getPreco_venda();
                $stmt->bindParam(":preco_venda",(double)$c);
                $d = $this->classe->getQuantidade();
                $stmt->bindParam(":unidade",(int)$d);
                $e = $this->classe->getPreco_compra();
                $stmt->bindParam(":preco_compra", $e);
                $f = $this->classe->getFornecedor();
                $stmt->bindParam(":fornecedor", $f);
                
                $h = $this->classe->getTamanho();
                $stmt->bindParam(":tamanho", $h);

                $stmt->execute();

            }

            public function select($consulta) {
                $stmt = $this->conn->prepare("CALL select_porcao('".$consulta."')");
                $stmt->execute(); 
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
                return $result;
            }
            public function selectID($consulta) {
                $stmt = $this->conn->prepare("CALL selectID_porcao($consulta)");
                $stmt->execute(); 
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
                return $result;
            }
            public function selectALL(){
                $stmt = $this->conn->prepare("CALL selectAll_porcao($consulta)");
                $stmt->execute(); 
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
                return $result;
            }

            public function update() {
                
                $stmt = $this->conn->prepare("call update_porcao(:id,:nome, :descricao, :preco_venda, :unidade, :preco_compra,:fornecedor, :tamanho);");
                $id = $this->classe->getId();
                $stmt->bindParam(":id",(int)$id);
                $a = $this->classe->getNome();
                $stmt->bindParam(":nome", $a);
                $b = $this->classe->getDescricao();
                $stmt->bindParam(":descricao",$b);
                $c = $this->classe->getPreco_compra();
                $stmt->bindParam(":preco_venda",(double)$c);
                $d = $this->classe->getQuantidade();
                $stmt->bindParam(":unidade",(int)$d);
                $e = $this->classe->getPreco_compra();
                $stmt->bindParam(":preco_compra", $e);
                $f = $this->classe->getFornecedor();
                $stmt->bindParam(":fornecedor", $f);
                $h = $this->classe->getTamanho();
                $stmt->bindParam(":tamanho", $h);

                $stmt->execute();
            }
            

        }

?>