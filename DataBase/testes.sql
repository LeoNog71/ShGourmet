call insert_funcionario ('VENDAS BALCAO','2008-10-10', "55", "LSSA", '2008-10-10', "rua");
call select_funcionario('LEONARDO NOGUEIRA');
call update_funcionario(1,'LEONARDO N','2008-10-10', "55", "LSSA", '2008-10-10');

call insert_endereco('RUA', 3,'kk', 'kk', 'parana');

call insert_cliente('LEONARDO','2008-10-10', "55","rua");

call insert_suco('SUCO NATURAL', 'SUCO DE FRUTAS NATURAL', 5.00, 100, 3.50,'PROPRIO','CASA', 'UNICO','LARANJA');
call update_bebida(1,'SUC NATURAL', 'SUCO DE FRUTAS NATURAL', 5.00, 100, 3.50,'PROPRIO','CASA', 'UNICO');
call select_sucoID(1);
call insert_lanche('X-SALADA','X-SALADA',8.50,100,5.00,'CASA');

call select_lanche('2');
call insert_pizza('PIZZA SALGADA', 'SUCO DE FRUTAS NATURAL', 5.00, 100, 3.50,'CASA', 'GRANDE');
call insert_pizza('PIZZA DOCE', 'SUCO DE FRUTAS NATURAL', 5.00, 100, 3.50,'CASA', 'GRANDE');
call insert_sabor_pizza(1,' QUEIJ');
call insert_pedido(1,1,'2008-10-10');
call selectAll_pedido();
call insert_pedido_produto(1);
CALL cancela_pedido(1);

select * from pessoa;

select pedidos.id as pedido_id, pedidos.id_cliente as cliente_id,COUNT(produtos.id) as quantidade, produtos.nome as produto ,produtos.preco_venda, pedidos.valor_total
	from produto_pedido 
    join produtos on produtos.id = produto_pedido.id_produto
    left join pedidos on pedidos.id = produto_pedido.id_pedido
    where pedidos.situacao = false 
    and pedidos.cancelado = false  GROUP BY pedido_id asc ;
    
select sum(produtos.preco_venda)
	from produto_pedido 
    join produtos on produtos.id = produto_pedido.id_produto
    left join pedidos on pedidos.id = produto_pedido.id_pedido
    where pedidos.situacao = false and produto_pedido.id_pedido = 2;


select sum(produtos.preco_venda) from produtos;

call selectID_funcionario(1);