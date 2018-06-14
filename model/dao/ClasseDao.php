<?php
    include_once 'CrudDAO.php';
    include_once 'funcionario.php';
    include_once 'endereco.php';
    
    class funcionarioDAO extends CrudDao{
        
        function __construct($classe) {
            parent::__construct($classe);
        }

        public function insert() {
            
            $stmt = $conn->prepare("CALL insert_funcionario (':nome', ':data_nasc', ':cpf', ':email', ':data_admi' )");
            $a = $classe->getNome();
            $stmt->bindParam(":nome", $a);
            $b = $classe->getData_nascimento();
            $stmt->bindParam(":data_nasc", $c);
            $c = $classe->getCpf();
            $stmt->bindParam(":cpf", $c);
            $d = $classe->getEmail();
            $stmt->bindParam(":email", $d);
            $e = $calsse->getData_adimissao();
            $stmt->bindParam(":data_admi", $e);
          
            $stmt->execute();
            
        }

        public function select($consulta) {
            $stmt = $conn->prepare("CALL select_funcionario('".$consulta."')");
            
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            
            $classe->setId($result->id);
            $classe->setNome($result->nome);
            $classe->setData_nascimento($result->data_nascimento);
            $classe->setCpf($result->cpf);
            $classe->setsetData_admissao($result->data_admissao);
            $classe->setEmail($result->email);
            
            $endereco = new Endereco($reuslt->id, $result->rua, $result->bairro, $result->cidade, $result->numero);
            
            $classe->setEndereco($endereco);
            
            return $classe;
        }

        public function update() {
            $stmt = $conn->prepare("CALL update_funcionario (:id,':nome', ':data_nasc', ':cpf', ':email' , ':data_admi' )");
            $id = $classe->getId();
            $stmt->bindParam(":id",$id);
            $a = $classe->getNome();
            $stmt->bindParam(":nome", $a);
            $b = $classe->getData_nascimento();
            $stmt->bindParam(":data_nasc", $c);
            $c = $classe->getCpf();
            $stmt->bindParam(":cpf", $c);
            $d = $classe->getEmail();
            $stmt->bindParam(":email", $d);
            $e = $calsse->getData_adimissao();
            $stmt->bindParam(":data_admi", $e);
          
            $stmt->execute();
            
        }
    }
    class ClienteDAO extends CrudDao{
        
        function __construct($classe) {
            parent::__construct($classe);
        }
        public function insert() {
            $stmt = $conn->prepare("CALL insert_cliente (':nome', ':data_nasc', ':cpf', :situacao )");
            $a = $classe->getNome();
            $stmt->bindParam(":nome", $a);
            $b = $classe->getData_nascimento();
            $stmt->bindParam(":data_nasc", $c);
            $c = $classe->getCpf();
            $stmt->bindParam(":cpf", $c);
            $d = $classe->getSituacao();
            $stmt->bindParam(":situacao", $d);
          
            $stmt->execute();
        
        }

        public function select($consulta) {
            
        }

        public function update() {

        }

    }
?>