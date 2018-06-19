<?php
    include_once 'CrudDAO.php';
    include_once '..\vo\funcionario.php';
    include_once '..\vo\enderecos.php';
    include_once '..\vo\cliente.php';

    
    class funcionarioDAO extends CrudDao{
        
        function __construct($classe) {
            parent::__construct($classe);
        }

        public function insert() {
            
            $stmt = $this->conn->prepare("CALL insert_funcionario (':nome', ':data_nasc', ':cpf', ':email', ':data_admi' )");
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
          
            $stmt->execute();
            
        }

        public function select($consulta) {
            $stmt = $this->conn->prepare("CALL select_funcionario('".$consulta."')");
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        public function update() {
            $stmt = $this->conn->prepare("CALL update_funcionario (:id,':nome', ':data_nasc', ':cpf', ':email' , ':data_admi' )");
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
          
            $stmt->execute();
            
        }
        public function delete() {
            $id = $this->classe->getId();
            $stmt = $this->conn->prepare("CALL delete_funcionario ($id)");

            $stmt->execute();
        }
    }
    class ClienteDAO extends CrudDao{
        
        function __construct($classe) {
            parent::__construct($classe);
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
    class UsuarioDAO extends CrudDao{
        
        public function __construct($classe) {
            parent::__construct($classe);
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