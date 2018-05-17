drop schema shgourmet;
create schema shgourmet;
use shgourmet;

create table if not exists endereco(
	id Integer auto_increment primary key,
    rua varchar(200) not null,
    numero Integer not null,
    bairro varchar(50) not null,
    cidade varchar(50) not null,
    estado varchar(50) not null
    
);
create table if not exists pessoa(
	id Integer auto_increment primary key,
    nome varchar(200) not null,
    data_nascimento date not null,
    id_endereco Integer not null,
    FOREIGN KEY (id_endereco)     
	REFERENCES endereco (id)
);
create table if not exists funcionario(
	id Integer auto_increment primary key,
    data_de_admissao date not null,
    cpf varchar(15) not null,
    email varchar(50) not null,
    id_pessoa Integer not null,
    foreign key (id_pessoa) references pessoa(id)
);
create table if not exists usuario(
	id integer auto_increment primary key,
    login varchar(50) not null,
    senha varchar(8) not null,
    id_funcionario integer not null,
    permissao integer not null,
    foreign key (id_funcionario) references funcionario (id)
);
create table if not exists cliente(
	id Integer auto_increment primary key,
    cpf varchar(14) not null,
    situacao boolean,
    id_pessoa Integer not null,
    foreign key (id_pessoa) references pessoa (id)
);
create table if not exists fornecedor(
	id Integer auto_increment primary key,
    cnpj Integer not null,
    id_pessoa Integer not null,
    foreign key (id_pessoa) references pessoa (id)
);
create table if not exists produtos(
	id Integer auto_increment primary key not null,
    nome varchar(50) not null,
    descricao varchar(300),
    preco_venda double not null,
    preco_compra double not null,
    disponivel boolean not null,
    id_fornecedor Integer not null,
    foreign key (id_fornecedor) references fornecedor (id)
);
create table if not exists bebida(
	id integer auto_increment primary key,
    marca varchar(50) not null,
    tamanho varchar(10) not null,
	quantidade double not null,
    id_produto Integer not null,
    foreign key (id_produto) references produtos (id)
);
create table if not exists suco(
	id integer auto_increment primary key,
    sabor varchar(20) not null,
    id_bebida Integer not null,
    id_produto Integer not null,
    foreign key (id_produto) references produtos (id),
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
    id_endereco integer not null,
    id_venda integer not null,
    foreign key (id_venda) references venda (id),
    foreign key (id_endereco) references endereco (id),
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
 
 /*insert*/
DELIMITER $$
CREATE PROCEDURE insert_funcionario (in nome_f varchar(50),in data_nasc_f date, in cpf_f varchar(15), in email_f varchar(50), in data_admi_f date)
BEGIN

	INSERT INTO pessoa(nome, data_nascimento,id_endereco)
		VALUES(nome_f,data_nasc_f,((SELECT ID FROM endereco ORDER BY ID DESC LIMIT 1)));

	INSERT INTO funcionario(data_de_admissao,cpf,email,id_pessoa)
	values (data_admi_f,cpf_f,email_f,(SELECT ID FROM pessoa ORDER BY ID DESC LIMIT 1));

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_cliente (in nome_c varchar(50),in data_nasc_c date, in cpf_c varchar(14), in situacao_c boolean)
BEGIN

	INSERT INTO pessoa(nome, data_nascimento,id_endereco)
		VALUES(nome_c,data_nasc_c,(SELECT ID FROM endereco ORDER BY ID DESC LIMIT 1));

	INSERT INTO cliente(cpf,situacao,id_pessoa)
		values (cpf_c,situacao_c,(SELECT ID FROM pessoa ORDER BY ID DESC LIMIT 1));

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_usuario (in login_u varchar(50), in senha_u varchar(8), in id_funcionario_u integer,in permissao_u integer)
BEGIN

	INSERT INTO usuario (`login`,`senha`,`id_funcionario`,`permissao`)
		VALUES (login_u, senha_u, id_funcionario_u , permissao_u);


END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_fornecedor(in nome_f varchar(50),in data_nasc_f date, in cnpj varchar(20) )
BEGIN

	INSERT INTO pessoa(nome, data_nascimento,id_endereco)
		VALUES(nome_f, data_nasc_f, (SELECT ID FROM endereco ORDER BY ID DESC LIMIT 1));
        
    INSERT INTO fornecedor ( cnpj, id_pessoa )
		VALUES(cnpj, (SELECT ID FROM pessoa ORDER BY ID DESC LIMIT 1));
    
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_endereco(rua_e varchar(200), numero_e integer, bairro_e varchar(50), cidade_e varchar(50), estado_e varchar(50))
BEGIN
	INSERT INTO endereco(rua, numero, bairro, cidade, estado)
	VALUES(rua_e, numero_e, bairro_e, cidade_e, estado_e);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE select_funcionario(nome_f varchar(50))
BEGIN
	SELECT 
	pessoa.nome,
	pessoa.data_nascimento,
	funcionario.cpf,
	funcionario.data_de_admissao,
	funcionario.email,
	endereco.rua,
	endereco.numero,
	endereco.cidade,
	endereco.estado 
	from pessoa
	left join funcionario on pessoa.id = funcionario.id_pessoa
	inner join endereco on endereco.id = pessoa.id_endereco 
	where pessoa.nome = nome_f;
END $$
DELIMITER ;




