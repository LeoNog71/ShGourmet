<?php

 include_once '..\vo\bebida.php';
    class BebidaDAO {
             
            private $classe;
            private $conn;
            
            public function __construct($classe) {
                $this->classe = $classe;
                $this->conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "root", "");
            }
            public function insert() {
                
                $stmt = $this->conn->prepare("call insert_bebida(:nome, :descricao, :preco_venda, :unidade, :preco_compra,:fornecedor,:marca, :tamanho);");
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
                $g = $this->classe->getMarca();
                $stmt->bindParam(":marca", $g);
                $h = $this->classe->getTamanho();
                $stmt->bindParam(":tamanho", $h);

                $stmt->execute();

            }

            public function select($consulta) {
                $stmt = $this->conn->prepare("CALL select_bebida('".$consulta."')");

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->execute();  
                return $result;
            }
            public function selectID($consulta) {
                $stmt = $this->conn->prepare("CALL selectID_bebida($consulta)");
                $stmt->execute(); 
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
                return $result;
            }

            public function update() {
                
                $stmt = $this->conn->prepare("call update_bebida(:id,:nome, :descricao, :preco_venda, :unidade, :preco_compra,:fornecedor,:marca, :tamanho);");
                $id = $this->classe->getId();
                $stmt->bindParam(":id",$id);
                $a = $this->classe->getNome();
                $stmt->bindParam(":nome", $a);
                $b = $this->classe->getDescricao();
                $stmt->bindParam(":descricao",$b);
                $c = $this->classe->getPreco_compra();
                $stmt->bindParam(":preco_venda",$c);
                $d = $this->classe->getQuantidade();
                $stmt->bindParam(":unidade",$d);
                $e = $this->classe->getPreco_compra();
                $stmt->bindParam(":preco_compra", $e);
                $f = $this->classe->getFornecedor();
                $stmt->bindParam(":fornecedor", $f);
                $g = $this->classe->getMarca();
                $stmt->bindParam(":marca", $g);
                $h = $this->classe->getTamanho();
                $stmt->bindParam(":tamanho", $h);

                $stmt->execute();
            }
            

        }

?>
