<?php
    include_once 'CrudDAO.php';
    include_once 'funcionario.php';
    include_once 'endereco.php';
    
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
            
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            
            $this->classe->setId($result->id);
            $this->classe->setNome($result->nome);
            $this->classe->setData_nascimento($result->data_nascimento);
            $this->classe->setCpf($result->cpf);
            $this->classe->setData_admissao($result->data_admissao);
            $this->classe->setEmail($result->email);
            $endereco = new Endereco($result->id_endereco, $result->rua, $result->bairro, $result->cidade, $result->numero);
            
            $this->classe->setEndereco($endereco);
            
            return $this->classe;
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
            
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            
            $this->classe->setId($result->id);
            $this->classe->setNome($result->nome);
            $this->classe->setData_nascimento($result->data_nascimento);
            $this->classe->setCpf($result->cpf);
            $this->classe->setSituacao($result->data_admissao);
            
            $endereco = new Endereco($result->id, $result->rua, $result->bairro, $result->cidade, $result->numero);
            
            $this->classe->setEndereco($endereco);
            
            return $this->classe;
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
            
        }
        public function update(){
            
        }

        public function delete(){
            $id = $this->classe->getId();
            $stmt = $this->conn->prepare("CALL delete_usuario ($id)");

            $stmt->execute();
        }
    }
?>