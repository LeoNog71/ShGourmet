<?php

 
    @include_once '..\model\vo\usuario.php';
    @include_once '..\model\dao\UsuarioDAO.php';
   # include_once '..\Interfaces\IDAO.php';
   
  
    $json = file_get_contents('php://input');
    $array = json_decode($json);
    if($array->operacao =='1'){
       echo ($_SESSION['permissao'] == 1); 
    }
    if($array->operacao =='2'){
        echo ($_SESSION['permissao'] == 2);
    }
    if($array->operacao =='3'){
        echo ($_SESSION['permissao'] == 3);
    }
    if($array->operacao =='4'){
        echo pesquisa($array);
    }
    if($array->operacao =='4'){
        echo quit();
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

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new UsuarioDAO(NULL);
        $r = $f->select(strtoupper($consulta->getLogin()),$consulta->getSenha());
        if ($r != NULL){
            session_start();
            $_SESSION['login'] = $r['login'];
            $_SESSION['senha'] = $r['senha'];
            $_SESSION['permissao'] = $r['id_permissao'];
            return true;
        }else{
            return false;
        }
    }
    function quit(){
        session_destroy();
    }
?>
