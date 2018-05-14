/*create schema shgourmet;
use shgourmet;*/

create table endereco(
	id Integer auto_increment primary key,
    rua varchar(200) not null,
    numero Integer not null,
    bairro varchar(50) not null,
    cidade varchar(50) not null,
    estado varchar(50) not null
    
);
create table pessoa(
	id Integer auto_increment primary key,
    nome varchar(200) not null,
    data_nascimento date not null,
    id_endereco Integer not null,
    FOREIGN KEY (id_endereco)     
	REFERENCES endereco (id)
);
create table funcionario(
	id Integer auto_increment primary key,
    data_de_admissao Integer,
    cpf Integer(11) not null,
    id_pessoa Integer not null,
    foreign key (id_pessoa) references pessoa(id)
);
create table cliente(
	id Integer auto_increment primary key,
    cpf Integer(11) not null,
    situacao boolean,
    id_pessoa Integer not null,
    foreign key (id_pessoa) references pessoa (id)
);
create table fornecedor(
	id Integer auto_increment primary key,
    cnpj Integer not null,
    id_pessoa Integer not null,
    foreign key (id_pessoa) references pessoa (id)
);
create table produtos(
	id Integer auto_increment primary key not null,
    nome varchar(50) not null,
    descricao varchar(300),
    preco_venda double not null,
    preco_compra double not null,
    disponivel boolean not null,
    id_fornecedor Integer not null,
    foreign key (id_fornecedor) references fornecedor (id)
);
create table bebida(
	id integer auto_increment primary key,
    marca varchar(50) not null,
    tamanho varchar(10) not null,
	quantidade double not null,
    id_produto Integer not null,
    foreign key (id_produto) references produtos (id)
);
create table suco(
	id integer auto_increment primary key,
    sabor varchar(20) not null,
    id_bebida Integer not null,
    id_produto Integer not null,
    foreign key (id_produto) references produtos (id),
    foreign key (id_bebida) references bebida (id)
);
create table adicionais(
	id integer auto_increment primary key,
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id)
);

create table lanche(
	id integer auto_increment primary key,
    id_produto integer not null,
    foreign key (id_produto) references produtos (id)
);

create table adicionais_lache(
	id_adicionais integer not null,
    id_lanche integer not null,
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id),
    foreign key (id_adicionais) references adicionais (id),
    foreign key (id_lanche) references lanche (id)
);

create table sabor_pizza(
	id integer auto_increment primary key,
	id_produtos integer not null,
    foreign key (id_produtos) references produtos (id)
);
create table pizza(
	id integer auto_increment primary key,
    tamanho varchar(10) not null,
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id)
    
);

create table sabores_pizza(
	id_sabor_pizza integer not null,
    id_pizza integer not null,
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id),
    foreign key(id_sabor_pizza) references sabor_pizza (id),
    foreign key(id_pizza) references pizza (id)
);

create table porcao(
	id integer auto_increment primary key,
    tamanho varchar(10) not null,
    id_produtos integer not null,
    foreign key (id_produtos) references produtos (id)
);





