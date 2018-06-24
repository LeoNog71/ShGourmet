<?php

    @include_once '..\model\vo\funcionario.php';
    @include_once '..\model\dao\FuncionarioDAO.php';
   # include_once '..\Interfaces\IDAO.php';
   

       $json = file_get_contents('php://input');
       $array = json_decode($json);
       
       if($array->operacao == '1'){
           cadastrar($array);
       }
       if($array->operacao == '2'){
           atualizar($array);
       }
       if($array->operacao == '3'){
           excluir($array);
       }
       if($array->operacao =='4'){
           pesquisa($array);
       }

    function recebeJson($array){
            
        $classe = new Funcionario();
        

        $classe->setId((int)$array->data->funcionario->id);
        $classe->setNome(strtoupper($array->data->funcionario->nome));
        $classe->setData_nascimento($array->data->funcionario->data_nascimento);
        $classe->setCpf($array->data->funcionario->cpf);
        $classe->setData_admissao($array->data->funcionario->data_admissao);
        $classe->setEmail($array->data->funcionario->email);
        $classe->setEndereco(strtoupper($array->data->funcionario->endereco));

        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array) {
        $f  = new FuncionarioDAO(recebeJson($array));
        $f->update();
    }

    function cadastrar($array) {
       $f  = new FuncionarioDAO(recebeJson($array));
       $f->insert();
    }

    function excluir($array) {
       $f  = new FuncionarioDAO(recebeJson($array));
       $f->delete();
    }

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new FuncionarioDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getNome())));
    }
    /*$f = new FuncionarioDAO(null);
    enviaJson($f->select('LEONARDO'));*/
?>

