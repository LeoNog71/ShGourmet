<?php
    include_once '..\model\vo\funcionario.php';
    @include '..\model\dao\ClasseDao.php';
    include_once '..\Interfaces\IController.php';
   

    function recebeJson(){
            
        $classe = new Funcionario();
        $this->json = file_get_contents('php://input');
        $array = json_decode($this->json);

        $classe->setId($array->id);
        $classe->setNome($array->nome);
        $classe->setData_nascimento($array->data_nascimento);
        $classe->setCpf($array->cpf);
        $classe->setData_admissao($array->data_admissao);
        $classe->setEmail($array->email);
        $endereco = new Endereco($array->id_endereco, $array->rua, $array->bairro, $array->cidade, $array->numero);

        $classe->setEndereco($endereco);

        return $this->classe;
    }

     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar() {
        $f  = new funcionarioDAO($this->recebeJson());
        $f->update();
    }

    function cadastrar() {
       $f  = new funcionarioDAO($this->recebeJson());
       $f->insert();
    }

    function excluir() {
       $f  = new funcionarioDAO($this->recebeJson());
       $f->delete();
    }

    function pesquisa() {
        $consulta = $this->recebeJson();
        $f = new funcionarioDAO(NULL);
        $this->enviaJson($f->select($consulta->getNome()));
    }

?>

