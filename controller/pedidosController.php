<?php

 
    @include_once '..\model\vo\pedidos.php';
    @include_once '..\model\dao\PedidosDAO.php';
  
    $json = file_get_contents('php://input');
    $array = json_decode($json);
    
    $id = array();
    if($array->operacao == '1'){
        cadastrar($array,$id);
    }
    if($array->operacao == '2'){
        atualizar($array,$id);
    }
    if($array->operacao =='4'){
        pesquisa($array,$id);
    }
    if($array->operacao =='5'){
        pesquisaId($array,$id);
    }
    if($array->operacao =='6'){
        pesquisaAll();
    }
    if($array->operacao =='10'){
        array_push($id,(int)$array->id);
        print_t($id);
    }
    
 
    function recebeJson($array,$id){
       print_r($array);   
       $classe = new Pedidos();
       
       $classe->setId((int)$array->id);
       echo (int)$array->id;
       $classe->setIdCliente((int)$array->id_cliente);
       $classe->setIdFuncionario((int)$array->id_funcionario);
       $classe->setData('2017-10-10');
       $classe->setValor_total((double)$array->valor_total);
       $classe->setProdutos($id);

        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array,$id) {
        $f  = new PedidosDAO(recebeJson($array,$id));
        $f->update();
    }

    function cadastrar($array,$id) {
       $f  = new PedidosDAO(recebeJson($array,$id));
       $f->insert();
       $f->insertPedidoProduto();
    }

    function excluir($array,$id) {
       $f  = new PedidosDAO(recebeJson($array,$id));
       $f->delete();
    }

    function pesquisa($array,$id) {
        $consulta = recebeJson($array,$id);
        $f = new PedidosDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getNome())));
    }
    function pesquisaId($array,$id) {
        $consulta = recebeJson($array,$id);
        $f = new PedidosDAO(NULL);
        enviaJson($f->selectID($consulta->getNome()));
    }
    function pesquisaAll(){
        $f = new PedidosDAO(NULL);
        enviaJson($f->selectAll());
    }


?>

