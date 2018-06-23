drop schema shgourmet;
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
    quantidade integer not null,
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
create table if not exists adicionais(
	id integer auto_increment primary key,
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id)
);
create table if not exists adicionais_suco(
	id_suco integer not null,
    id_adicionais integer not null,
    foreign key (id_suco) references suco (id),
    foreign key (id_adicionais) references adicionais (id)
);

create table if not exists lanche(
	id integer auto_increment primary key,
    id_produto integer not null,
    foreign key (id_produto) references produtos (id)
);

create table if not exists adicionais_lache(
	id_adicionais integer not null,
    id_lanche integer not null,
    foreign key (id_adicionais) references adicionais (id),
    foreign key (id_lanche) references lanche (id)
);

create table if not exists sabor_pizza(
	id integer auto_increment primary key,
	id_produtos integer not null,
    foreign key (id_produtos) references produtos (id)
);
create table if not exists pizza(
	id integer auto_increment primary key,
    tamanho varchar(10) not null,
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id)
    
);

create table if not exists sabores_pizza(
	id_sabor_pizza integer not null,
    id_pizza integer not null,
    foreign key(id_sabor_pizza) references sabor_pizza (id),
    foreign key(id_pizza) references pizza (id)
);

create table if not exists porcao(
	id integer auto_increment primary key,
    tamanho varchar(10) not null,
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id)
);

create table if not exists mesa(
	id integer auto_increment primary key not null,
    num_mesa integer not null
);

create table if not exists venda (
	id integer auto_increment not null primary key,
    id_cliente integer not null,
    id_funcionario integer not null,
    id_mesa integer not null,
    data_venda date not null,
    valor_total double not null,
    valor_desconto double not null,
    situacao boolean not null,
	foreign key (id_cliente) references cliente (id),
    foreign key (id_funcionario) references funcionario (id),
    foreign key (id_mesa) references mesa (id)
);

create table if not exists produto_venda(
	id_produto integer not null,
    id_venda integer not null,
    foreign key (id_produto) references produtos (id),
    foreign key (id_venda) references venda (id)
);

create table if not exists entrega(
	id integer auto_increment primary key not null,
    endereco varchar(500) not null,
    id_venda integer not null,
    foreign key (id_venda) references venda (id)
);
create table if not exists pedidos(
	id integer auto_increment primary key not null,
    id_venda integer not null,
    data_pedido datetime not null,
    situacao boolean not null,
    foreign key (id_venda) references venda (id)
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
CREATE PROCEDURE select_ususario(in id_f int)
BEGIN
	select usuario.login, usuario.senha, usuario.id_permissao
	from usuario
	where usuario.id_funcionario =id_f
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

/*produtos*/
DELIMITER $$
CREATE PROCEDURE insert_produto(nome_p varchar(50), descricao_p varchar(300), preco_venda_p double, quantidade_p integer, preco_compra_p double,
								disponivel_p boolean, id_fonecedor_p int)
BEGIN
	INSERT INTO produtos(nome, descricao, preco_venda, quantidade, preco_compra, disponivel, id_fornecedor)
		VALUES(nome_p, descricao_p, preco_venda_p, quantidade_p, preco_compra_p, disponivel_p, id_fornecedor_p);

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
CREATE PROCEDURE insert_suco(sabor_s varchar(20))
BEGIN
	INSERT INTO suco (sabor,id_bebida)
		values (sabor_s, (SELECT id FROM bebida ORDER BY id DESC LIMIT 1));
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_adicionais()
BEGIN
	INSERT INTO adicionais(id_produto)
		VALUES ((SELECT id FROM produto ORDER BY id DESC LIMIT 1));
END $$
DELIMITER ;
/*
DELIMITER $$
CREATE PROCEDURE insert_
BEGIN
	INSERT INTO 

END $$
DELIMITER ;

*/
/*SELECT*/







