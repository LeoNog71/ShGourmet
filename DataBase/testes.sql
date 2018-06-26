call insert_funcionario ('VIVIANE','2008-10-10', "55", "LSSA", '2008-10-10', "rua");
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
call selectAll_pedido();
call insert_pedido(1, 1, '2008-10-10');

select * from pedi


select sum(produtos.preco_venda) from produtos;

call selectID_funcionario(1);