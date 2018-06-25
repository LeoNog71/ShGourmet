<?php
    
    include_once '..\vo\funcionario.php';
    
    class FuncionarioDAO {
        
        private $classe;
        private $conn;
        
        public function __construct($classe) {
            $this->classe = $classe;
            $this->conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
        }

        public function insert() {
            
            $stmt = $this->conn->prepare("CALL insert_funcionario (:nome, :data_nasc, :cpf, :email, :data_admi,:endereco )");
            $a = $this->classe->getNome();
            $stmt->bindParam(":nome", $a);
            $b = $this->classe->getData_nascimento();
            $stmt->bindParam(":data_nasc", $b);
            $c = $this->classe->getCpf();
            $stmt->bindParam(":cpf", $c);
            $d = $this->classe->getEmail();
            $stmt->bindParam(":email", $d);
            $e = $this->classe->getData_admissao();
            $stmt->bindParam(":data_admi", $e);
            $f = $this->classe->getEndereco();
            $stmt->bindParam(":endereco",$f);
          
            $stmt->execute();
            
        }

        public function select($consulta) {
            $stmt = $this->conn->prepare("CALL select_funcionario('".$consulta."')");
            $stmt->execute();  
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        public function update() {
            $stmt = $this->conn->prepare("CALL update_funcionario (:id, :nome, :data_nasc, :cpf, :email , :data_admi, :endereco);");
            $id = $this->classe->getId();
            $stmt->bindParam(":id",$id);
            $a = $this->classe->getNome();
            $stmt->bindParam(":nome", $a);
            $b = $this->classe->getData_nascimento();
            $stmt->bindParam(":data_nasc", $b);
            $c = $this->classe->getCpf();
            $stmt->bindParam(":cpf", $c);
            $d = $this->classe->getEmail();
            $stmt->bindParam(":email", $d);
            $e = $this->classe->getData_adimissao();
            $stmt->bindParam(":data_admi", $e);
            $f = $this->classe->getEndereco();
            $stmt->bindParam(":endereco",$f);
          
            $stmt->execute();
            
        }
        public function delete() {
            $id = $this->classe->getId();
            $stmt = $this->conn->prepare("CALL delete_funcionario ($id)");

            $stmt->execute();
        }
    }
    
