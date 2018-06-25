call insert_funcionario ('VIVIANE','2008-10-10', "55", "LSSA", '2008-10-10', "rua");
call select_funcionario('LEONARDO');
call update_funcionario(1,'LEONARDO N','2008-10-10', "55", "LSSA", '2008-10-10');

call insert_endereco('RUA', 3,'kk', 'kk', 'parana');

call insert_cliente('LEONARDO','2008-10-10', "55","rua");

call insert_bebida('SUCO NATURAL', 'SUCO DE FRUTAS NATURAL', 5.00, 100, 3.50,'PROPRIO','CASA', 'UNICO');
call update_bebida(1,'SUC NATURAL', 'SUCO DE FRUTAS NATURAL', 5.00, 100, 3.50,'PROPRIO','CASA', 'UNICO');
call select_bebida('SUC NATURAL');
call insert_lanche('X-SALADA','X-SALADA',8.50,100,5.00,'CASA');

call select_lanche('X-SALADA');
call insert_pizza('PIZZA SALGADA', 'SUCO DE FRUTAS NATURAL', 5.00, 100, 3.50,'CASA', 'GRANDE');
call insert_sabor_pizza(1,' QUEIJ');


call select_all_pizza();
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
