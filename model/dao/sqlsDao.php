<?php
        include_once 'queryDao.php';
        include_once '../vo/funcionario.php';
        include_once '../vo/enderecos.php';
        include_once 'Conexao.php';
    class funcionarioDao implements queryBasicas{
        
        private $funcionario;
        private $con;
        
        function __construct($funcionario) {
            $this->con = new ConexaoDao().getConection();
            $this->funcionario = $funcionario;
        }

        public function insert() {
            $stmt = $this->conn->prepare("INSERT INTO pessoa (nome, data_nascimento, id_endereco)"
                    . "values(:nome,:data,(SELECT id FROM endereco ORDER BY ID DESC LIMIT 1))");
           
            $stmt->bindParam(":nome",$this->funcionario->getNome());
            $stmt->bindParam(":data",$this->funcionario->getData_nascimento());
            $stmt->bindParam(":endereco",$this->funcionario->getEndereco());
            $stmt->execute();
            
            $stmt = $this->conn->prepare("INSERT INTO funcionario(data_de_admissao,cpf,email,id_pessoa)"
                    . "values (:admissao, :cpf, :email,(SELECT id FROM pessoa ORDER BY ID DESC LIMIT 1))");
            
            $stmt->bindParam(":adimissao",$this->funcionario->getData_adimissao());
            $stmt->bindParam(":cpf",$this->funcionario->getCpf());
            $stmt->bindParam(":email",$this->funcionario->getEmail());
            $stmt->execute();
            
        }

        public function select() {

        }

        public function upgrade() {

        }

    }
    class endereco implements queryBasicas{
        
        private $con;
        private $endereco;
                
        function __construct($endereco) {
            $this->con = new ConexaoDao().getConection();
            $this->endereco = $endereco;
        }

        
        public function insert() {
            $stmt = $this->con->prepare("INSERT INTO endereco ()"
                    . "VALUES(:rua, :numero, :bairro, :cidade, :estado)");
            
            $stmt->bindParam(":rua",$this->endereco->getRua());
            $stmt->bindParam(":numero",$this->endereco->getNumero());
            $stmt->bindParam(":bairro",$this->endereco->getBairro());
            $stmt->bindParam(":cidade",$this->endereco->getCidade());
            $stmt->bindParam(":estado",$this->endereco->getEstado());
            
        }


        public function select() {

        }

        public function upgrade() {

        }

    }
?>
