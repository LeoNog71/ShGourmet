<?php
    
    @include_once '..\vo\usuario.php';

    

    class UsuarioDAO {
        
        public function __construct($classe) {
            $this->classe = $classe;
            $this->conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
        }

        public function insert() {
            
            $stmt = $this->conn->prepare("CALL insert_usuario(':login', ':senha', :permissao, :funcionario )");
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
        
        public function select($consulta) {
            $stmt = $this->conn->prepare("CALL select_usuario('".$consulta."')");
            $stmt->execute();  
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }
        public function update(){
            
            $stmt = $this->conn->prepare("CALL insert_usuario(:id,':login', ':senha', :permissao, :funcionario )");
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
    class EnderecoDAO implements IDAO{
        
        public function __construct($classe) {
            parent::__construct($classe);
        }
        
        public function delete() {
        
        }

        public function insert() {
            
            $stmt = $this->conn->prepare("CALL insert_endereco(':rua', ':numero', :bairro, :cidade )");
            $a = $this->classe->getRua();
            $stmt->bindParam(":rua", $a);
            $b = $this->classe->getNumero();
            $stmt->bindParam(":numero", $b);
            $c = $this->classe->getBairro();
            $stmt->bindParam(":bairro", $c);
            $d = $this->classe->getCidade();
            $stmt->bindParam(":cidade", $d);
            
            $stmt->execute();
            
        }

        public function select($consulta) {
            $stmt = $this->conn->prepare("CALL select_endereco('".$consulta."')");
            $stmt->execute();  
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        public function update() {
            
            $stmt = $this->conn->prepare("CALL update_endereco(:id,':rua', ':numero', :bairro, :cidade )");
            $id = $this->classe->getId();
            $stmt->bindParam(":id",$id);
            $a = $this->classe->getRua();
            $stmt->bindParam(":rua", $a);
            $b = $this->classe->getNumero();
            $stmt->bindParam(":numero", $b);
            $c = $this->classe->getBairro();
            $stmt->bindParam(":bairro", $c);
            $d = $this->classe->getCidade();
            $stmt->bindParam(":cidade", $d);
            
            $stmt->execute();
        }

    }
?>