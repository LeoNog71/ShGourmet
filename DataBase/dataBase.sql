/*drop schema shgourmet;
create schema shgourmet;
use shgourmet;*/

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
    data_de_admissao Integer,
    cpf Integer(11) not null,
    email varchar(50) not null,
    id_pessoa Integer not null,
    foreign key (id_pessoa) references pessoa(id)
);
create table if not exists usuario(
	id integer auto_increment primary key,
    login varchar(50) not null,
    senha varchar(8) not null,
    id_funcionario integer not null,
    foreign key (id_funcionario) references funcionario (id)
);
create table if not exists cliente(
	id Integer auto_increment primary key,
    cpf Integer(11) not null,
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
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id),
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
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id),
    foreign key(id_sabor_pizza) references sabor_pizza (id),
    foreign key(id_pizza) references pizza (id)
);

create table if not exists porcao(
	id integer auto_increment primary key,
    tamanho varchar(10) not null,
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id)
);

create table if not exists venda (
	id integer auto_increment not null primary key,
    id_cliente integer not null,
    id_funcionario integer not null,
    data_venda date not null,
    valor_total double not null,
    valor_desconto double not null,
	foreign key (id_cliente) references cliente (id),
    foreign key (id_funcionario) references funcionario (id)
);

create table if not exists produto_venda(
	id_produto integer not null,
    id_venda integer not null,
    foreign key (id_produto) references produtos (id),
    foreign key (id_venda) references venda (id)
);

create table if not exists mesa(
	id integer auto_increment primary key not null,
    numero_mesa integer not null,
    id_venda integer not null,
    foreign key (id_venda) references venda(id)
);
create table if not exists entrega(
	id integer auto_increment primary key not null,
    id_endereco integer not null

);






