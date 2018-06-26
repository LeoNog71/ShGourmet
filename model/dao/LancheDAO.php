<?php

 include_once '..\vo\lanche.php';
    class LancheDAO {
             
            private $classe;
            private $conn;
            
            public function __construct($classe) {
                $this->classe = $classe;
                $this->conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
            }
            public function insert() {
                
                $stmt = $this->conn->prepare("call insert_lanche(:nome, :descricao, :preco_venda, :unidade, :preco_compra,:fornecedor);");
                $a = $this->classe->getNome();
                $stmt->bindParam(":nome", $a);
                $b = $this->classe->getDescricao();
                $stmt->bindParam(":descricao",$b);
                $c = $this->classe->getPreco_venda();
                $stmt->bindParam(":preco_venda",$c);
                $d = $this->classe->getQuantidade();
                $stmt->bindParam(":unidade",$d);
                $e = $this->classe->getPreco_compra();
                $stmt->bindParam(":preco_compra", $e);
                $f = $this->classe->getFornecedor();
                $stmt->bindParam(":fornecedor", $f);
               

                $stmt->execute();

            }

            public function select($consulta) {
                
                $stmt = $this->conn->prepare("CALL select_lanche('".$consulta."')");
                $stmt->execute(); 
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
                return $result;
            }
            public function selectID($consulta) {
                
                $stmt = $this->conn->prepare("CALL selectID_lanche($consulta)");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  
                return $result;
            }

            public function update() {
                
                $stmt = $this->conn->prepare("call update_lanche(:id,:nome, :descricao, :preco_venda, :unidade, :preco_compra,:fornecedor);");
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
                

                $stmt->execute();
            }
            

        }

?>