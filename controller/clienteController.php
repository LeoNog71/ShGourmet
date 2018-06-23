<?php

    #include_once '..\model\vo\funcionario.php';
    @include_once '..\model\dao\ClienteDAO.php';
   # include_once '..\Interfaces\IDAO.php';
   
    if(file_get_contents('php://input')){
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
    }
    function recebeJson($array){
            
        $classe = new Cliente();
        

        $classe->setId($array->id);
        $classe->setNome(strtoupper($array->nome));
        $classe->setData_nascimento($array->data_nascimento);
        $classe->setCpf($array->cpf);
        $classe->setEndereco(strtoupper($array->endereco));

        

        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array) {
        $f  = new ClienteDAO(recebeJson($array));
        $f->update();
    }

    function cadastrar($array) {
       $f  = new ClienteDAO(recebeJson($array));
       $f->insert();
    }

    function excluir($array) {
       $f  = new ClienteDAO(recebeJson($array));
       $f->delete();
    }

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new ClienteDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getNome())));
    }
    
?>

