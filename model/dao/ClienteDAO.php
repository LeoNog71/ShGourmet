<?php
@include_once '..\vo\cliente.php';
    class ClienteDAO extends CrudDao{

            public function __construct($classe) {
                $this->classe = $classe;
                $this->conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
            }
            public function insert() {
                $stmt = $this->conn->prepare("CALL insert_cliente (':nome', ':data_nasc', ':cpf', :situacao )");
                $a = $this->classe->getNome();
                $stmt->bindParam(":nome", $a);
                $b = $this->classe->getData_nascimento();
                $stmt->bindParam(":data_nasc", $b);
                $c = $this->classe->getCpf();
                $stmt->bindParam(":cpf", $c);

                $stmt->execute();

            }

            public function select($consulta) {
                $stmt = $this->conn->prepare("CALL select_cliente('".$consulta."')");

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->execute();  
                return $result;
            }

            public function update() {
                $stmt = $this->conn->prepare("CALL update_cliente (:id,':nome', ':data_nasc', ':cpf', ':email' , ':data_admi' )");
                $id = $this->classe->getId();
                $stmt->bindParam(":id",$id);
                $a = $this->classe->getNome();
                $stmt->bindParam(":nome", $a);
                $b = $this->classe->getData_nascimento();
                $stmt->bindParam(":data_nasc", $b);
                $c = $this->classe->getCpf();
                $stmt->bindParam(":cpf", $c);


                $stmt->execute();
            }
            public function delete(){
                $id = $this->classe->getId();
                $stmt = $this->conn->prepare("CALL delete_funcionario ($id)");

                $stmt->execute();
            }

        }
?>
