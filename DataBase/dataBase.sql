drop schema if exists shgourmet;
create schema shgourmet;
use shgourmet;


create table if not exists pessoa(
	id Integer auto_increment primary key,
    nome varchar(200) not null,
    data_nascimento date not null,
	situacao boolean not null,
    endereco varchar(500) not null

);
create table if not exists funcionario(
	id Integer auto_increment primary key,
    data_de_admissao date not null,
    cpf varchar(15) not null,
    email varchar(50) not null,
    id_pessoa Integer not null,
    foreign key (id_pessoa) references pessoa(id)
);
create table if not exists permissao(
	id integer auto_increment primary key,
    nome varchar(50) not null
);
create table if not exists usuario(
	id integer auto_increment primary key,
    login varchar(50) not null,
    senha varchar(8) not null,
    id_funcionario integer not null,
    id_permissao integer not null,
    situacao boolean not null,
    foreign key (id_funcionario) references funcionario (id),
    foreign key (id_permissao) references permissao (id)
);
create table if not exists cliente(
	id Integer auto_increment primary key,
    cpf varchar(14) not null,
    id_pessoa Integer not null,
    foreign key (id_pessoa) references pessoa (id)
);

create table if not exists produtos(
	id Integer auto_increment primary key not null,
    nome varchar(50) not null,
    descricao varchar(300),
    preco_venda double not null,
    quantidade integer ,
    preco_compra double not null,
    disponivel boolean not null,
    fornecedor varchar(50) not null
);
create table if not exists bebida(
	id integer auto_increment primary key,
    marca varchar(50) not null,
    tamanho varchar(10) not null,
    id_produto Integer not null,
    foreign key (id_produto) references produtos (id)
);
create table if not exists suco(
	id integer auto_increment primary key,
    sabor varchar(20) not null,
    id_bebida Integer not null,
    foreign key (id_bebida) references bebida (id)
);



create table if not exists lanche(
	id integer auto_increment primary key,
    id_produto integer not null,
    foreign key (id_produto) references produtos (id)
);

create table if not exists pizza(
	id integer auto_increment primary key,
    id_produtos integer not null,
	tamanho varchar(10) not null,
    foreign key (id_produtos) references produtos (id)
    
);


create table if not exists porcao(
	id integer auto_increment primary key,
    tamanho varchar(10) not null,
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id)
);

create table if not exists pedidos(
	id integer auto_increment not null primary key,
    id_cliente integer not null,
    id_funcionario integer not null,
    data_pedido date not null,
    valor_total double not null,
    situacao boolean not null,
    cancelado boolean not null,
	foreign key (id_cliente) references cliente (id),
    foreign key (id_funcionario) references funcionario (id)
);

create table if not exists produto_pedido(
	id_produto integer not null,
    id_pedido integer not null,
    foreign key (id_produto) references produtos (id),
    foreign key (id_pedido) references pedidos (id)
);


create table if not exists lancamentos(
	id integer auto_increment primary key not null, 
	valor double not null,
    descricao varchar(50) not null
);

create table if not exists livro_caixa(
	id integer auto_increment primary key not null,
    data_abertura datetime not null,
    data_fechamento datetime not null,
    id_funcionario integer not null,
    total double not null,
    foreign key (id_funcionario) references funcionario (id)
);
 create table if not exists lancamentos_livro_caixa(
	id_lancamentos integer not null,
    id_livro_caixa integer not null,
    foreign key (id_lancamentos) references lancamentos (id),
    foreign key (id_livro_caixa) references livro_caixa (id)
 );
 
INSERT INTO `shgourmet`.`permissao`
(nome)
VALUES
('CAIXA');
 INSERT INTO `shgourmet`.`permissao`
(nome)
VALUES
('GARÇOM');
 INSERT INTO `shgourmet`.`permissao`
(nome)
VALUES
('COZINHA');
 
/*funcionario*/
DELIMITER $$
CREATE PROCEDURE insert_funcionario (in nome_f varchar(50),in data_nasc_f date, in cpf_f varchar(15), in email_f varchar(50), in data_admi_f date, in endereco_f varchar(500))
BEGIN

	INSERT INTO pessoa(nome, data_nascimento,endereco,situacao)
		VALUES(nome_f,data_nasc_f,endereco_f,true);

	INSERT INTO funcionario(data_de_admissao,cpf,email,id_pessoa)
	values (data_admi_f,cpf_f,email_f,(SELECT ID FROM pessoa ORDER BY ID DESC LIMIT 1));

END $$
DELIMITER ;
pessoa
DELIMITER $$
CREATE PROCEDURE select_funcionario(in nome_f varchar(50))
BEGIN
	SELECT
    funcionario.id,
	pessoa.nome,
	pessoa.data_nascimento,
	funcionario.cpf,
	funcionario.data_de_admissao,
	funcionario.email,
    pessoa.endereco
	from pessoa
	left join funcionario on pessoa.id = funcionario.id_pessoa
	where pessoa.nome = nome_f AND pessoa.situacao = true;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE selectID_funcionario(in id_f int)
BEGIN
	SELECT
    funcionario.id,
	pessoa.nome,
	pessoa.data_nascimento,
	funcionario.cpf,
	funcionario.data_de_admissao,
	funcionario.email,
    pessoa.endereco
	from pessoa
	left join funcionario on pessoa.id = funcionario.id_pessoa
	where funcionario.id = id_f AND pessoa.situacao = true;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE update_funcionario(in id_f int, in nome_f varchar(50),in data_nasc_f date, in cpf_f varchar(15), in email_f varchar(50), in data_admi_f date, endereco_f varchar(500))
BEGIN

	UPDATE pessoa
	SET
	nome = nome_f,
	data_nascimento = data_nasc_f,
    endereco = endereco_f
	WHERE id = id_f;
    
    UPDATE funcionario
	SET
	data_de_admissao = data_admi_f,
	cpf = cpf_f,
	email = email_f
	WHERE id = id_f;
	
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE delete_funcionario(in id_f int)
BEGIN
	UPDATE pessoa
	SET
	situacao = false
	WHERE id = id_f;
END $$
DELIMITER ;

/*cliente*/
DELIMITER $$
CREATE PROCEDURE insert_cliente (in nome_c varchar(50),in data_nasc_c date, in cpf_c varchar(14), in endereco_c varchar(500))
BEGIN

	INSERT INTO pessoa(nome, data_nascimento,endereco,situacao)
		VALUES(nome_c,data_nasc_c,endereco_c,true);

	INSERT INTO cliente(cpf,id_pessoa)
		values (cpf_c,(SELECT ID FROM pessoa ORDER BY ID DESC LIMIT 1));

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE select_cliente(in nome_c varchar(50))
BEGIN
	SELECT
    cliente.id,
	pessoa.nome,
	pessoa.data_nascimento,
	cliente.cpf,
	endereco.rua,
	endereco.numero,
	endereco.cidade,
	endereco.estado 
	from pessoa 
	left join cliente on pessoa.id = cliente.id_pessoa
	where pessoa.nome = nome_c AND pessoa.situacao = true;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE selectCPF_cliente(in cpf_c varchar(14))
BEGIN
	SELECT
    cliente.id,
	pessoa.nome,
	pessoa.data_nascimento,
	cliente.cpf,
	endereco.rua,
	endereco.numero,
	endereco.cidade,
	endereco.estado 
	from pessoa 
	left join cliente on pessoa.id = cliente.id_pessoa
	where pessoa.cpf = cpf_c AND pessoa.situacao = true;
END $$
DELIMITER ;
	

DELIMITER $$
CREATE PROCEDURE update_cliente(in id_c int, in nome_c varchar(50),in data_nasc_c date, in cpf_c varchar(14),in endereco_c varchar(500))
BEGIN

	UPDATE pessoa
	SET
	nome = nome_c,
	data_nascimento = data_nasc_c,
    endereco = endereco_c
	WHERE id = id_c;
    
    UPDATE cliente
	SET
	cpf = cpf_f
	WHERE id = id_f;
	

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE delete_cliente(in id_c int)
BEGIN
	UPDATE pessoa
	SET
	situacao = false
	WHERE id = id_c;
END $$
DELIMITER ;

/*usuario*/

DELIMITER $$
CREATE PROCEDURE insert_usuario (in login_u varchar(50), in senha_u varchar(8), in id_funcionario_u integer,in id_permissao_u integer)
BEGIN

	INSERT INTO usuario (`login`,`senha`,`id_funcionario`,`id_permissao`,situacao)
		VALUES (login_u, senha_u, id_funcionario_u , id_permissao_u, true);


END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE select_usuario(in login_u varchar(50), in senha_u varchar(8))
BEGIN
	select usuario.login, usuario.senha, usuario.id_permissao
	from usuario
	where usuario.login =login_u
    AND usuario.senha = senha_u
    AND usuario.situacao = true;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE update_usuario(in id_u int, in login_u varchar(50), in senha_u varchar(8),in id_permissao_u integer)
BEGIN
	UPDATE usuario
	SET
	`login` = login_u,
	`senha` = senha_u,
	`id_permissao` = id_permissao_u
	WHERE `id` = id_u;

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE delete_usuario(in id_u int)
BEGIN
	UPDATE usuario
	SET
	situacao = false
	WHERE id = id_u;
END $$
DELIMITER ;

/*bebida*/
DELIMITER $$
CREATE PROCEDURE insert_bebida(in nome_p varchar(50), in descricao_p varchar(300), in preco_venda_p double, in quantidade_p integer, in preco_compra_p double, in fornecedor_p varchar(50), in marca_b varchar(50), in tamanho_b varchar(10))
BEGIN
	INSERT INTO produtos(nome, descricao, preco_venda, quantidade, preco_compra, disponivel, fornecedor)
		VALUES(nome_p, descricao_p, preco_venda_p, quantidade_p, preco_compra_p, true, fornecedor_p);
	INSERT INTO bebida (marca, tamanho, id_produto)
		VALUES (marca_b, tamanho_b,(SELECT id FROM produtos ORDER BY id DESC LIMIT 1) );

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE update_bebida(in id_b int, in nome_p varchar(50), in descricao_p varchar(300), in preco_venda_p double, in quantidade_p integer, in preco_compra_p double, in fornecedor_p varchar(50), in marca_b varchar(50), in tamanho_b varchar(10))
BEGIN
	
    UPDATE produtos
	SET
	`nome` = nome_p,
	`descricao` = descricao_p,
	`preco_venda` = preco_venda_p,
	`quantidade` = quantidade_p,
	`preco_compra` = preco_compra_p,
	`fornecedor` = fornecedor_p
	WHERE `id` = id_b ;


	UPDATE bebida
	SET
	`marca` = marca_b,
	`tamanho` = tamanho_b
	WHERE `id` = id_b;


END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE select_bebida(nome_p varchar(50))
BEGIN
	
	SELECT bebida.id, produtos.nome, produtos.descricao,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor,
    bebida.marca,bebida.tamanho
    FROM bebida
    JOIN produtos on produtos.id = bebida.id_produto
    Where produtos.nome = nome_p;

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE selectID_bebida(id_b int)
BEGIN
	
	SELECT bebida.id, produtos.nome, produtos.descricao,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor,
    bebida.marca,bebida.tamanho
    FROM bebida
    JOIN produtos on produtos.id = bebida.id_produto
    Where bebida.id = id_b;

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_suco(in nome_p varchar(50), in descricao_p varchar(300), in preco_venda_p double, in quantidade_p integer, in preco_compra_p double, in fornecedor_p varchar(50), in marca_b varchar(50), in tamanho_b varchar(10),sabor_s varchar(20))
BEGIN
	INSERT INTO produtos(nome, descricao, preco_venda, quantidade, preco_compra, disponivel, fornecedor)
		VALUES(nome_p, descricao_p, preco_venda_p, quantidade_p, preco_compra_p, true, fornecedor_p);
	INSERT INTO bebida (marca, tamanho, id_produto)
		VALUES (marca_b, tamanho_b,(SELECT id FROM produtos ORDER BY id DESC LIMIT 1) );
	INSERT INTO suco (sabor,id_bebida)
		values (sabor_s, (SELECT id FROM bebida ORDER BY id DESC LIMIT 1));
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE select_suco(in nome_s varchar(50))
BEGIN

	SELECT suco.id, produtos.nome, produtos.descricao,suco.sabor,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor,
    bebida.marca
    FROM suco
    JOIN bebida on bebida.id = suco.id_bebida
    left join produtos on produtos.id = bebida.id_produto
    Where produtos.nome = nome_s;

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE select_sucoID(in id_s int)
BEGIN

	SELECT suco.id, produtos.nome, produtos.descricao,suco.sabor,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor,
    bebida.marca
    FROM suco
    JOIN bebida on bebida.id = suco.id_bebida
    left join produtos on produtos.id = bebida.id_produto
    Where suco.id = id_s;

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE update_suco(in id_s int, in nome_p varchar(50), in descricao_p varchar(300), in preco_venda_p double, in quantidade_p integer, in preco_compra_p double, in fornecedor_p varchar(50), in marca_b varchar(50), in tamanho_b varchar(10),sabor_s varchar(20))
BEGIN
	
    UPDATE produtos
	SET
	`nome` = nome_p,
	`descricao` = descricao_p,
	`preco_venda` = preco_venda_p,
	`quantidade` = quantidade_p,
	`preco_compra` = preco_compra_p,
	`fornecedor` = fornecedor_p
	WHERE `id` = id_s ;


	UPDATE bebida
	SET
	`marca` = marca_b,
	`tamanho` = tamanho_b
	WHERE `id` = id_s;
	
    UPDATE `shgourmet`.`suco`
	SET
	`sabor` = sabor_s
	WHERE `id` = id_s;


END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_lanche(in nome_p varchar(50), in descricao_p varchar(300), in preco_venda_p double, in quantidade_p integer, in preco_compra_p double, in fornecedor_p varchar(50))
BEGIN
	INSERT INTO produtos(nome, descricao, preco_venda, quantidade, preco_compra, disponivel, fornecedor)
		VALUES(nome_p, descricao_p, preco_venda_p, quantidade_p, preco_compra_p, true, fornecedor_p);
	INSERT INTO lanche(id_produto)
		VALUES((SELECT id FROM produtos ORDER BY id DESC LIMIT 1));
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE update_lanche(in id_l int, in nome_p varchar(50), in descricao_p varchar(300), in preco_venda_p double, in quantidade_p integer, in preco_compra_p double, in fornecedor_p varchar(50))
BEGIN
	
	UPDATE produtos
	SET
	`nome` = nome_p,
	`descricao` = descricao_p,
	`preco_venda` = preco_venda_p,
	`quantidade` = quantidade_p,
	`preco_compra` = preco_compra_p,
	`fornecedor` = fornecedor_p
	WHERE `id` = id_l ;

END $$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE select_lanche(in nome_l varchar(50))
BEGIN
	SELECT lanche.id, produtos.nome, produtos.descricao,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor
    from lanche
    join produtos on produtos.id = lanche.id_produto
    where produtos.nome = nome_l;

END $$
DELIMITER 

DELIMITER $$
CREATE PROCEDURE selectID_lanche(in id_l int)
BEGIN
	SELECT lanche.id, produtos.nome, produtos.descricao,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor
    from lanche
    join produtos on produtos.id = lanche.id_produto
    where produtos.nome = id_l;

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_pizza(in nome_p varchar(50), in descricao_p varchar(300), in preco_venda_p double, in quantidade_p integer, in preco_compra_p double, in fornecedor_p varchar(50), in tamanho_p varchar(10))
BEGIN
	INSERT INTO produtos(nome, descricao, preco_venda, quantidade, preco_compra, disponivel, fornecedor)
		VALUES(nome_p, descricao_p, preco_venda_p, quantidade_p, preco_compra_p, true, fornecedor_p);
	INSERT INTO pizza(id_produtos,tamanho)
		VALUES((SELECT id FROM produtos ORDER BY id DESC LIMIT 1), tamanho_p);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE update_pizza(in id_p int, in nome_p varchar(50), in descricao_p varchar(300), in preco_venda_p double, in quantidade_p integer, in preco_compra_p double, in fornecedor_p varchar(50), in tamanho_p varchar(10))
BEGIN
	
	UPDATE produtos
	SET
	`nome` = nome_p,
	`descricao` = descricao_p,
	`preco_venda` = preco_venda_p,
	`quantidade` = quantidade_p,
	`preco_compra` = preco_compra_p,
	`fornecedor` = fornecedor_p
	WHERE `id` = id_p ;
    
    UPDATE `shgourmet`.`pizza`
	SET
	`tamanho` = tamanho_p
	WHERE `id` = id_p;


END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE select_pizza (in nome_p varchar(50))
BEGIN
	SELECT pizza.id, produtos.nome, pizza.tamanho, produtos.descricao,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor
    from pizza
    join produtos on produtos.id = pizza.id_produtos
    where produtos.nome = nome_p;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE selectID_pizza (in id_p int)
BEGIN
	SELECT pizza.id, produtos.nome, pizza.tamanho, produtos.descricao,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor
    from pizza
    join produtos on produtos.id = pizza.id_produtos
    where pizza.id = id_p;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE select_all_pizza ()
BEGIN
	SELECT pizza.id, produtos.nome, pizza.tamanho, produtos.descricao,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor
    from pizza
    join produtos on produtos.id = pizza.id_produtos;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_porcao(in nome_p varchar(50), in descricao_p varchar(300), in preco_venda_p double, in quantidade_p integer, in preco_compra_p double, in fornecedor_p varchar(50), in tamanho_p varchar(10))
BEGIN
	INSERT INTO produtos(nome, descricao, preco_venda, quantidade, preco_compra, disponivel, fornecedor)
		VALUES(nome_p, descricao_p, preco_venda_p, quantidade_p, preco_compra_p, true, fornecedor_p);
	INSERT INTO porcao(id_produtos,tamanho)
		VALUES((SELECT id FROM produtos ORDER BY id DESC LIMIT 1), tamanho_p);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE update_porcao(in id_p int, in nome_p varchar(50), in descricao_p varchar(300), in preco_venda_p double, in quantidade_p integer, in preco_compra_p double, in fornecedor_p varchar(50), in tamanho_p varchar(10))
BEGIN
	
	UPDATE produtos
	SET
	`nome` = nome_p,
	`descricao` = descricao_p,
	`preco_venda` = preco_venda_p,
	`quantidade` = quantidade_p,
	`preco_compra` = preco_compra_p,
	`fornecedor` = fornecedor_p
	WHERE `id` = id_p ;
    
    UPDATE `shgourmet`.`porcao`
	SET
	`tamanho` = tamanho_p
	WHERE `id` = id_p;


END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE select_porcao (in nome_p varchar(50))
BEGIN
	SELECT porcao.id, produtos.nome, porcao.tamanho, produtos.descricao,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor
    from porcao
    join produtos on produtos.id = porcao.id_produtos
    where produtos.nome = nome_p;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE selectID_porcao (in id_p int)
BEGIN
	SELECT porcao.id, produtos.nome, porcao.tamanho, produtos.descricao,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor
    from porcao
    join produtos on produtos.id = porcao.id_produtos
    where porcao.id = id_p;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE select_all_porcao ()
BEGIN
	SELECT porcao.id, produtos.nome, porcao.tamanho, produtos.descricao,
    produtos.preco_venda,produtos.quantidade, produtos.fornecedor
    from porcao
    join produtos on produtos.id = porcao.id_produtos
    where produtos.nome = nome_p;
END $$
DELIMITER ;


delimiter $$
create procedure decrementa_estoque(in id_p int)
 begin

 DECLARE done INT DEFAULT 0;
 DECLARE var1 BIGINT;

 DECLARE curs CURSOR FOR (SELECT produto_pedido.id_produto FROM produto_pedido WHERE produto_pedido.id_pedido = id_p);

 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

 OPEN curs;

 REPEAT

 	FETCH curs INTO var1;
		IF NOT done THEN
			UPDATE produtos
			SET
			quantidade = (quantidade - 1)
			WHERE `id` = var1 ;
		END IF;
 UNTIL done END REPEAT;

 CLOSE curs;

 end $$
delimiter ;

DELIMITER $$
CREATE PROCEDURE insert_pedido(in id_cliente_v integer, id_funcionario_v integer, in data_venda_v date )
BEGIN
	INSERT INTO `shgourmet`.`pedidos`(
	`id_cliente`,
	`id_funcionario`,
	`data_pedido`,
	`valor_total`,
	`situacao`,
	`cancelado`)
	VALUES
	(id_cliente_v, id_funcionario_v, data_venda_v,0.0, false,false);

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE update_pedidos(in id_v int,in id_cliente_v integer, id_funcionario_v integer, in data_venda_v date )
BEGIN
	UPDATE pedidos
	SET
	`id_cliente` = id_cliente_v,
	`id_funcionario` = id_funcionario_v,
	`data_venda` = data_venda_v
	WHERE `id` = id_v;

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE cancela_pedido(in id_v int)
BEGIN
		Update`shgourmet`.`pedidos`
		set `cancelado` = true
        Where id = id_v;
END $$
delimiter $$

delimiter $$
create procedure soma_pedido (in id_v int)
 begin

 DECLARE var2 double ;
 set var2 = (select sum(produtos.preco_venda)
	from produto_pedido 
    join produtos on produtos.id = produto_pedido.id_produto
    left join pedidos on pedidos.id = produto_pedido.id_pedido
    where pedidos.situacao = false and produto_pedido.id_pedido = id_v);
 
            UPDATE `shgourmet`.`pedidos`
			SET
			`valor_total` = var2
			WHERE `id` = id_v;

 end $$
delimiter ;

DELIMITER $$
CREATE PROCEDURE insert_pedido_produto( in id_pr int )
BEGIN
	declare id_f integer;
    set id_f = (SELECT id FROM pedidos ORDER BY id DESC LIMIT 1);
	INSERT INTO `shgourmet`.`produto_pedido`
	(`id_produto`, `id_pedido`)
	VALUES
	(id_pr, id_f);
    call soma_pedido(id_f);

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE finalizar_pedido(in id_pe int)
BEGIN

    declare total double;
    set total = (select valor_total from pedidos where id = id_pe);
    
    INSERT INTO `shgourmet`.`lancamentos`
	(`valor`,
	`descricao`)
	VALUES
	(total,id_pe);


END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE selectAll_pedido()
BEGIN
	
	select pedidos.id as pedido_id, pedidos.id_cliente as cliente_id,COUNT(produtos.id) as quantidade, produtos.nome as produto ,produtos.preco_venda, pedidos.valor_total
	from produto_pedido 
    join produtos on produtos.id = produto_pedido.id_produto
    left join pedidos on pedidos.id = produto_pedido.id_pedido
    where pedidos.situacao = false
    and pedidos.cancelado = false  GROUP BY pedidos.id asc;
        
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE selectAll_pedido_finalizado()
BEGIN
	
	select pedidos.id as pedido_id, pedidos.id_cliente as cliente_id,produtos.id as id_produto, produtos.nome as produto ,produtos.preco_venda, pedidos.valor_total
	from produto_pedido 
    join produtos on produtos.id = produto_pedido.id_produto
    left join pedidos on pedidos.id = produto_pedido.id_pedido
    where pedidos.situacao = true
    and pedidos.cancelado = false order by pedidos.id asc;
        
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE selectID_pedido(in id_p int)
BEGIN
	
	select * from pedidos where id = id_p;
        
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE finaliza_pedido(in id_pe int)
BEGIN
	
	Update`shgourmet`.`pedidos`
	set situacao = true
    where id = id_pe;
        call decrementa_estoque(id_pe);
        call finalizar_pedido(id_pe);
        
END $$
DELIMITER ;










