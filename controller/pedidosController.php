<?php

 
    @include_once '..\model\vo\pedidos.php';
    @include_once '..\model\dao\PedidosDAO.php';
  
    $json = file_get_contents('php://input');
    $array = json_decode($json);
    
    if($array->operacao == '1'){
        cadastrar($array);
    }
    if($array->operacao == '2'){
        atualizar($array);
    }
    if($array->operacao =='4'){
        pesquisa($array);
    }
    if($array->operacao =='5'){
        pesquisaId($array);
    }
    if($array->operacao =='6'){
        pesquisaAll();
    }
    if($array->operacao =='7'){
        excluir($array);
    }
    if($array->operacao =='8'){
       finaliza($array);
    }
    if($array->operacao =='9'){
        pesquisaAllF();
    }
    if($array->operacao =='10'){
       $f = new PedidosDAO(NULL);
       $f->insertPedidoProduto($array->id);
    }
    
 
    function recebeJson($array){
       print_r($array);   
       $classe = new Pedidos();
       
       $classe->setId((int)$array->id);
       echo (int)$array->id;
       $classe->setIdCliente((int)$array->id_cliente);
       $classe->setIdFuncionario((int)$array->id_funcionario);
       $classe->setData('2018-26-06');
       $classe->setValor_total((double)$array->valor_total);
       //$classe->setProdutos($id);

        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array) {
        $f  = new PedidosDAO(recebeJson($array));
        $f->update();
    }

    function cadastrar($array) {
      
       $f  = new PedidosDAO(recebeJson($array));
       $f->insert();
       
    }

    function excluir($array) {
       $f  = new PedidosDAO(recebeJson($array));
       $f->cancela();
    }

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new PedidosDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getNome())));
    }
    function pesquisaId($array) {
        $consulta = recebeJson($array);
        $f = new PedidosDAO(NULL);
        enviaJson($f->selectID($consulta->getNome()));
    }
    function pesquisaAll(){
        $f = new PedidosDAO(NULL);
        enviaJson($f->selectAll());
    }
    function pesquisaAllF(){
        $f = new PedidosDAO(NULL);
        enviaJson($f->selectAll());
    }
    function finaliza($array){
       $f  = new PedidosDAO(recebeJson($array));
       $f->finaliza();
    }

?>

