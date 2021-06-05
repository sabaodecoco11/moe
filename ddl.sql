create table empresa
(
	id int auto_increment
		primary key,
	endereco varchar(300) not null,
	nome varchar(100) null,
	descricao varchar(300) null,
	produtos varchar(500) null
);

create table usuario
(
	id int auto_increment
		primary key,
	email varchar(255) not null,
	password varchar(600) not null,
	tipoConta varchar(30) not null
);

create table empregador
(
	id int,
	nome varchar(255) not null,
	empresa_fk int null,
	usuario_fk int null,
	constraint empresa_fk
		foreign key (empresa_fk) references empresa (id),
	constraint usuario_fk
		foreign key (usuario_fk) references usuario (id)
);

create index empresa_fk_idx
	on empregador (id);

alter table empregador modify id int auto_increment;

create table estagiario
(
	id int auto_increment
		primary key,
	nome varchar(255) not null,
	ano_ingresso varchar(10) not null,
	minicurriculo varchar(400) not null,
	usuario_fk int null,
	constraint usuario_fk_ct
		foreign key (usuario_fk) references usuario (id)
);

create table vaga
(
	id int auto_increment
		primary key,
	descricao varchar(300) null,
	semestre varchar(8) null,
	atividades varchar(500) null,
	habilidades varchar(500) null,
	carga_horaria int null,
	remuneracao double null,
	empresa_fk int null,
	constraint empresa___fk
		foreign key (empresa_fk) references empresa (id)
);

create table interesse_estagiario
(
	id int auto_increment
		primary key,
	estagiario_fk int null,
	empresa_fk int null,
	vaga_fk int null,
	constraint empresa__fk
		foreign key (empresa_fk) references empresa (id),
	constraint estagiario__fk
		foreign key (estagiario_fk) references estagiario (id),
	constraint vaga__fk
		foreign key (vaga_fk) references vaga (id)
);

create table interesse_empresa
(
	id int auto_increment
		primary key,
	estagiario_fk int null,
	empresa_fk int null,

	constraint empresa____fk
		foreign key (empresa_fk) references empresa (id),
	constraint estagiario____fk
		foreign key (estagiario_fk) references estagiario (id)
);




