<?php

 
    @include_once '..\model\vo\lanche.php';
    @include_once '..\model\dao\LancheDAO.php';
  
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
 
    function recebeJson($array){
            
       $classe = new Lanche();
       
       $classe->setId((int)$array->id);
       $classe->setNome($array->nome);
       $classe->setDescricao($array->descricao);
       $classe->setPreco_venda((double)$array->preco_venda);
       $classe->setQuantidade((int)$array->quantidade);
       
       $classe->setPreco_compra((double)$array->preco_compra);
       $classe->setFornecedor($array->fornecedor);
       

        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array) {
        $f  = new LacheDAO(recebeJson($array));
        $f->update();
    }

    function cadastrar($array) {
       $f  = new LancheDAO(recebeJson($array));
       $f->insert();
    }

    function excluir($array) {
       $f  = new LancheDAO(recebeJson($array));
       $f->delete();
    }

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new LancheDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getNome())));
    }


?>
