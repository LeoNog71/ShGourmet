/*endereco
insert into endereco(rua,numero,bairro,cidade,estado)
values("AVENIDA RIO DE JANEIRO",528,"CENTRO","DIAMANTE D'OESTE","PARANÁ"); 
pessoa
INSERT INTO pessoa(nome, data_nascimento,id_endereco)
VALUES("LEONARDO NOGUEIRA",'2018-05-14',((SELECT ID FROM endereco ORDER BY ID DESC LIMIT 1)));
pegar o ultimo registro (SELECT ID FROM endereco ORDER BY ID DESC LIMIT 1)

INSERT INTO funcionario(data_de_admissao,cpf,email,id_pessoa)
values ('2018-05-14','078.112.009-88','leosil.2015@alunos.utfpr.edu.br',(SELECT ID FROM pessoa ORDER BY ID DESC LIMIT 1))

select *from funcionario where id_pessoa = (select id from pessoa where nome = 'LEONARDO NOGUEIRA')*/ 