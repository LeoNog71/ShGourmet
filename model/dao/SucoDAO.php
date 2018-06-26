<?php

 include_once '..\vo\suco.php';
    class BebidaDAO {
             
            private $classe;
            private $conn;
            
            public function __construct($classe) {
                $this->classe = $classe;
                $this->conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "root", "");
            }
            public function insert() {
                
                $stmt = $this->conn->prepare("call insert_suco(:nome, :descricao, :preco_venda, :unidade, :preco_compra,:fornecedor,:marca,:tamanho,:sabor);");
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
                $g = $this->classe->getMarca();
                $stmt->bindParam(":marca", $g);
                $h = $this->classe->getTamanho();
                $stmt->bindParam(":tamanho", $h);
                $i = $this->calsse->getSabor();
                $stmt->bindParam(":sabor",$i);

                $stmt->execute();

            }

            public function select($consulta) {
                $stmt = $this->conn->prepare("CALL select_suco('".$consulta."')");

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->execute();  
                return $result;
            }
            public function selectID($consulta) {
                $stmt = $this->conn->prepare("CALL selectID_suco($consulta)");

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->execute();  
                return $result;
            }

            public function update() {      
                $stmt = $this->conn->prepare("call update_suco(:id,:nome, :descricao, :preco_venda, :unidade, :preco_compra,:fornecedor,:marca, :tamanho,:sabor);");
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
                $g = $this->classe->getMarca();
                $stmt->bindParam(":marca", $g);
                $h = $this->classe->getTamanho();
                $stmt->bindParam(":tamanho", $h);
                $i = $this->calsse->getSabor();
                $stmt->bindParam(":sabor",$i);
                $stmt->execute();
            }
            

        }

?>