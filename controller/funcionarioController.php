<?php
    class FuncionarioController implements IController{
        private $classe;
        public function __construct() {
            $this->classe = new Funcionario();
        }

        public function recebeJson($json){
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

