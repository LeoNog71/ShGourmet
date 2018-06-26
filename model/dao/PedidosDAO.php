<?php

 include_once '..\vo\pedidos.php';
    class PedidosDAO {
             
            private $classe;
            private $conn;
            
            public function __construct($classe) {
                $this->classe = $classe;
                $this->conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "root", "");
            }
            public function insert() {
         
                $stmt = $this->conn->prepare("call insert_pedido(:id_cliente, :id_funcionario,:data_venda);");
                $a = $this->classe->getIdCliente();
                $stmt->bindParam(":id_cliente", $a);
                $b = $this->classe->getIdFuncionario();
                $stmt->bindParam(":id_funcionario",$b);
                $c = $this->classe->getData();
                $stmt->bindParam(":data_venda",$c);

                $stmt->execute();

            }

            public function selectAll() {
                $stmt = $this->conn->prepare("CALL selectAll_pedido()");
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                  
                return $result;
            }
            public function selectAllFinalizado() {
                $stmt = $this->conn->prepare("CALL selectAll_pedido_finalizado()");
                 $stmt->execute(); 
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                return $result;
            }
            public function selectID($consulta) {
                $stmt = $this->conn->prepare("CALL selectID_pedido($consulta)");
                $stmt->execute(); 
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                array_push($result,$this->selectPedidoProduto());
                return $result;
            }

            public function update() {      
                $stmt = $this->conn->prepare("call update_pedido(:id, :id_cliente, :id_funcionario,:data_venda);");
                $id = $this->classe->getId();
                $stmt->bindParam(":id",$id);
                $a = $this->classe->getIdCliente();
                $stmt->bindParam(":id_cliente", $a);
                $b = $this->classe->getIdFuncionario();
                $stmt->bindParam(":id_funcionario",$b);
                $c = $this->classe->getData();
                $stmt->bindParam(":data_venda",$c);

                $stmt->execute();
            }
            public function cancela(){
                $id = $this->classe->getId();
                $stmt = $this->conn->prepare("CALL cancela_pedido($id);");

                $stmt->execute();
            }
            public function finaliza(){
                $id = $this->classe->getId();
                $stmt = $this->conn->prepare("CALL finaliza_pedido($id);");

                $stmt->execute();
            }
            public function insertPedidoProduto(){
                $array = $this->classe->getProdutos();
                $tmt = $this->conn->prepare("SELECT id FROM pedidos ORDER BY id DESC LIMIT 1;");
                $tmt->execute();
                $id = $tmt->fetch(PDO::FETCH_ASSOC);
                foreach ($array as $value) {
                    
                    $stmt = $this->conn->prepare("insert_pedido_produto($id, $value );");
                    $stmt->execute();
                }
            }
            public function selectPedidoProduto(){
                
                $id = $this->classe->getId();
                $stmt = $this->conn->prepare("SELECT id_produto from produto_pedido WHERE id_pedido = $id");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
                return $result;
                
            }
            

        }

?>