<?php
    include_once '..\model\vo\funcionario.php';
    @include '..\model\dao\ClasseDao.php';
    include_once '..\Interfaces\IController.php';
    class FuncionarioController implements IController{
        private $classe;
        private $json;
        public function __construct() {
            $this->classe = new Funcionario();
        }

        public function recebeJson(){
            $this->json = file_get_contents('php://input');
            $array = json_decode($json);
            $this->classe->setId($array->id);
            $this->classe->setNome($array->nome);
            $this->classe->setData_nascimento($array->data_nascimento);
            $this->classe->setCpf($array->cpf);
            $this->classe->setData_admissao($array->data_admissao);
            $this->classe->setEmail($array->email);
            $endereco = new Endereco($array->id_endereco, $array->rua, $array->bairro, $array->cidade, $array->numero);
            
            $this->classe->setEndereco($endereco);
            
            return $this->classe;
        }

        public function enviaJson($array){
            
            return json_encode($array);
        }
        

}
?>

