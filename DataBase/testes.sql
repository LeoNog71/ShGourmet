call insert_endereco('RUA', 2,'kk', 'kk', 'parana');

call insert_funcionario('LEONARDO','2008-10-10', "55", "LSSA", '2008-10-10');


call update_funcionario(1,'LEONARDO N','2008-10-10', "55", "LSSA", '2008-10-10');

call insert_endereco('RUA', 3,'kk', 'kk', 'parana');

call insert_cliente('LEONARDO','2008-10-10', "55");

call select_cliente('LEONARDO');
INSERT INTO `shgourmet`.`permissao`
(`nome`)
VALUES
("teste");

select usuario.login, usuario.senha, usuario.id_permissao
from usuario
where usuario.id_funcionario = 1;

