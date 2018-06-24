<?php

 
    #include_once '..\model\vo\funcionario.php';
    @include_once '..\model\dao\BebidaDAO.php';
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
       if($array->operacao =='4'){
           pesquisa($array);
       }
    }
    function recebeJson($array){
            
        $classe = new Bebida();
       
       $classe->setNome($array->nome);
       $classe->setDescricao($array->descricao);
       $classe->setPreco_venda((double)$array->preco_venda);
       $classe->setQuantidade((int)$array->quantidade);
       
       $classe->setPreco_compra((double));
        $f = $this->classe->getFornecedor();
        $stmt->bindParam(":fornecedor", $f);
        $g = $this->classe->getMarca();
        $stmt->bindParam(":marca", $g);
        $h = $this->classe->getTamanho();
        $stmt->bindParam(":tamanho", $h);
        

        

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
        $f = new BeibidaDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getNome())));
    }


?>