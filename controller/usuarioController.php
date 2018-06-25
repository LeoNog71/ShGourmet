<?php

 
    @include_once '..\model\vo\usuario.php';
    @include_once '..\model\dao\UsuarioDAO.php';
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
            
        $classe = new Usuario();
       
        $classe->setId((int)$array->id);
        $classe->setLogin(strtoupper($array->login));
        $classe->setSenha($array->senha);
        $classe->setIdFuncionario((int)$array->id_funcionario);
        $classe->setPermissao((int)$array->id_permissao);
        

        

        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array) {
        $f  = new UsuarioDAO(recebeJson($array));
        $f->update();
    }

    function cadastrar($array) {
       $f  = new UsuarioDAO(recebeJson($array));
       $f->insert();
    }

    function excluir($array) {
       $f  = new UsuarioDAO(recebeJson($array));
       $f->delete();
    }

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new UsuarioDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getLogin()),$consulta->getSenha()));
    }


?>
