<?php
    class funcionario extends QueryDao{
        
        function __construct($classe) {
            parent::__construct($classe);
        }

        public function insert() {
            
            $stmt = $conn->prepare("CALL insert_funcionario (:nome, :data_nasc, :cpf, :email_, :data_admi )");
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

        public function select() {
            
        }

        public function update() {

        }

}
?>