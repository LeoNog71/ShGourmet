<?php

    #include_once '..\model\vo\funcionario.php';
    @include_once '..\model\dao\FuncionarioDAO.php';
   # include_once '..\Interfaces\IDAO.php';
   
    if(file_get_contents('php://input')){
       $json = file_get_contents('php://input');
       $array = json_decode($this->json);
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
            
        $classe = new Funcionario();
        

        $classe->setId($array->id);
        $classe->setNome($array->nome);
        $classe->setData_nascimento($array->data_nascimento);
        $classe->setCpf($array->cpf);
        $classe->setData_admissao($array->data_admissao);
        $classe->setEmail($array->email);
        $endereco = new Endereco($array->id_endereco, $array->rua, $array->bairro, $array->cidade, $array->numero);

        $classe->setEndereco($endereco);

        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array) {
        $f  = new funcionarioDAO(recebeJson($array));
        $f->update();
    }

    function cadastrar($array) {
       $f  = new funcionarioDAO(recebeJson($array));
       $f->insert();
    }

    function excluir($array) {
       $f  = new funcionarioDAO(recebeJson($array));
       $f->delete();
    }

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new funcionarioDAO(NULL);
        enviaJson($f->select($consulta->getNome()));
    }
    $f = new FuncionarioDAO(null);
    enviaJson($f->select('LEONARDO'));
?>

