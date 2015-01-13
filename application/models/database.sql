create table kos (
	id_kos int AUTO_INCREMENT,
	nama varchar(250),
	alamat varchar(250),
	latitude varchar(250),
	longitude varchar(250),	
	harga double,
	tampakdepan varchar(250),
	streetview varchar(250),
	primary key(id_kos)
);

create table keterangan (
	id_aturan int AUTO_INCREMENT,
	kos_id int,
	detail longtext,
	primary key (id_aturan),
	foreign key (kos_id) references kos (id_kos)
);

create table pengguna(
	id_pengguna int AUTO_INCREMENT,
	email varchar(250),
	pass varchar(250),
	primary key(id_pengguna)
);

insert into pengguna values (1, "samodrobagus@gmail.com", "123456");

insert into kos values(1,"Kost U-201","Jl. Teknik Kimia","-7.28191","112.79981",350000," "," ");
insert into keterangan values (1,1,"Kost – kostan pria");
insert into keterangan values (2,1,"Wanita tidak boleh menginap");
insert into keterangan values (3,1,"Mendapat tempat tidur dan kasur");
insert into keterangan values (4,1,"Bebas penggunaan listrik");
insert into keterangan values (5,1,"Kamar mandi luar");
insert into keterangan values (6,1,"Tempat tambal ban dan cuci motor dekat");

insert into kos values(2,"Kost U-197","Jl. Teknik Kimia","-7.2819","112.8001",350000," "," ");
insert into kos values(3,"Kost U-195","Jl. Teknik Kimia","-7.2819","112.8003",300000," "," ");
insert into kos values(4,"Kost U-193","Jl. Teknik Kimia","-7.282","112.80065",300000," "," ");






