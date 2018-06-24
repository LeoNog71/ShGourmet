
call insert_funcionario ('VIVIANE','2008-10-10', "55", "LSSA", '2008-10-10', "rua");
call select_funcionario('LEONARDO');
call update_funcionario(1,'LEONARDO N','2008-10-10', "55", "LSSA", '2008-10-10');

call insert_endereco('RUA', 3,'kk', 'kk', 'parana');

call insert_cliente('LEONARDO','2008-10-10', "55");
call insert_suco('SUCO NATURAL', 'SUCO DE FRUTA', 5.00, 1, 3.50, 'PROPRIO','DA CASA', 'UNICO','LARANJA');


SELECT suco.id, produtos.nome, produtos.descricao,suco.sabor,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor,
    bebida.marca
    FROM suco
    JOIN bebida on bebida.id = suco.id_bebida
    left join produtos on produtos.id = bebida.id_produto
    Where produtos.nome = 'SUCO NATURAL';

/*
call select_cliente('LEONARDO');
INSERT INTO `shgourmet`.`permissao`
(`nome`)
VALUES
("teste");

select usuario.login, usuario.senha, usuario.id_permissao
from usuario
where usuario.id_funcionario = 1;
select *from endereco;
select *from endereco where rua = 'RUA' and numero = 2 ;
*/
