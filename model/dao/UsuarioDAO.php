<?php
    
    @include_once '..\vo\usuario.php';

    class UsuarioDAO {
        
        private $classe;
        private $conn;
        public function __construct($classe) {
            $this->classe = $classe;
            $this->conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
        }

        public function insert() {
            
            $stmt = $this->conn->prepare("CALL insert_usuario(:login, :senha, :permissao, :id_funcionario )");
            $a = $this->classe->getLogin();
            $stmt->bindParam(":login", $a);
            $b = $this->classe->getSenha();
            $stmt->bindParam(":senha", $b);
            $c = $this->classe->getPermissao();
            $stmt->bindParam(":permissao", $c);
            $d = $this->classe->getIdFuncionario();
            $stmt->bindParam(":id_funcionario",(int) $d);
            $stmt->execute();
            
        }
        
        public function select($consulta) {
            $stmt = $this->conn->prepare("CALL select_usuario('".$consulta."')");
            $stmt->execute();  
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }
        public function update(){
            
            $stmt = $this->conn->prepare("CALL insert_usuario(:id,:login, :senha, :permissao, :funcionario )");
            $id = $this->classe->getId();
            $stmt->bindParam(":id", $id);
            $a = $this->classe->getLogin();
            $stmt->bindParam(":login", $a);
            $b = $this->classe->getSenha();
            $stmt->bindParam(":senha", $b);
            $c = $this->classe->getPermissao();
            $stmt->bindParam(":permissao", $c);
            $d = $this->classe->getFuncionario();
            $stmt->bindParam(":funcionario", $d);
            $stmt->execute();
            
        }

        public function delete(){
            $id = $this->classe->getId();
            $stmt = $this->conn->prepare("CALL delete_usuario ($id)");

            $stmt->execute();
        }
    }
 
?>