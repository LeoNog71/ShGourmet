<?php
        include_once 'queryDao.php';
        include_once '../vo/funcionario.php';
        include_once '../vo/enderecos.php';
        include_once '../vo/cliente.php';
        include_once '../vo/usuario.php';
        include_once 'Conexao.php';

    class EnderecoDao extends QueryDao{
        
        
        public function insert() {
            $stmt = $this->con->prepare("INSERT INTO endereco ()"
                    . "VALUES(:rua, :numero, :bairro, :cidade, :estado)");
            
            $stmt->bindParam(":rua",$this->classe->getRua());
            $stmt->bindParam(":numero",$this->classe->getNumero());
            $stmt->bindParam(":bairro",$this->classe->getBairro());
            $stmt->bindParam(":cidade",$this->classe->getCidade());
            $stmt->bindParam(":estado",$this->classe->getEstado());
            
        }


        public function select() {

        }

        public function upgrade() {

        }

    public function update() {
        
    }

}
    class FuncionarioDao extends QueryDao{

       

        public function insert() {
            
            $stmt = $this->conn->prepare("INSERT INTO pessoa (nome, data_nascimento, id_endereco)"
                    . "values(:nome,:data,(SELECT id FROM endereco ORDER BY ID DESC LIMIT 1))");
           
            $stmt->bindParam(":nome",$this->classe->getNome());
            $stmt->bindParam(":data",$this->classe->getData_nascimento());
            $stmt->execute();
            
            $stmt = $this->conn->prepare("INSERT INTO funcionario(data_de_admissao,cpf,email,id_pessoa)"
                    . "values (:admissao, :cpf, :email,(SELECT id FROM pessoa ORDER BY ID DESC LIMIT 1))");
            
            $stmt->bindParam(":admissao",$this->classe->getData_adimissao());
            $stmt->bindParam(":cpf",$this->classe->getCpf());
            $stmt->bindParam(":email",$this->classe->getEmail());
            $stmt->execute();
            
        }

        public function select() {

        }

        public function upgrade() {

        }

    public function update() {
        
    }

}
    
    class UsuarioDao extends QueryDao{
        
        function insert(){
            
        }
        function update(){
            
        }
        function select(){
            
        }
    }
    
    class ClienteDao extends QueryDao{
 
        function insert(){
            
            $stmt = $this->conn->prepare("INSERT INTO pessoa (nome, data_nascimento, id_endereco)"
                    . "values(:nome,:data,(SELECT id FROM endereco ORDER BY ID DESC LIMIT 1))");
           
            $stmt->bindParam(":nome",$this->classe->getNome());
            $stmt->bindParam(":data",$this->classe->getData_nascimento());
            $stmt->execute();
            
            $stmt = $this->conn->prepare("INSERT INTO cliente (cpf,email,id_pessoa)"
                    . "values (:cpf, :situacao, (SELECT id FROM pessoa ORDER BY ID DESC LIMIT 1))");
            
            $stmt->bindParam(":cpf",$this->classe->getCpf());
            $stmt->bindParam(":situacao",$this->classe->getSituacao());
            $stmt->execute();
        }
        function update(){
            
        }
        function select(){
            
        }
    }
?>
