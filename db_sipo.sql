drop database if exists db_sipo;

create database db_sipo;

use db_sipo;

create table level(
	nomor_level int auto_increment,
	nama_level varchar(20) not null,
	level_user int not null,
	constraint pk_nomor_level primary key(nomor_level),
	constraint uniq_nama_level unique(nama_level),
	constraint uniq_level_user unique(level_user)
);

insert into level values
(null, 'Administrator', 1),
(null, 'Guru', 2),
(null, 'Siswa', 3);

create table guru(
	nip varchar(20),
	nama varchar(50),
	gelar varchar(30),
	email varchar(50) not null,
	tempat varchar(50),
	tanggal_lahir date,
	alamat text,
	nomor_telepon varchar(12),
	constraint pk_nip primary key(nip),
	constraint uniq_email_guru unique(email),
	constraint uniq_nomor_telepon_guru unique(nomor_telepon)
);

insert into guru(nip, email) values
	('000000000000000001', 'rizki.cahyana@gmail.com'),
	('000000000000000002', 'tantri.hardianti@gmail.com'),
	('000000000000000003', 'ryan.widianto@gmail.com'),
	('000000000000000004', 'nuni.karlina@gmail.com'),
	('000000000000000005', 'anjar.rambari@gmail.com'),
	('000000000000000006', 'arief.novianto@gmail.com'),
	('000000000000000007', 'dimas.triadi@gmail.com'),
	('000000000000000008', 'sifa.nisa@gmail.com'),
	('000000000000000009', 'nur.putri@gmail.com'),
	('000000000000000010', 'wandy@gmail.com'),
	('000000000000000011', 'anggi.pratama@gmail.com'),
	('000000000000000012', 'tiara.dwi@gmail.com'),
	('000000000000000013', 'ferldy.verdina@gmail.com'),
	('000000000000000014', 'ihsan.arief@gmail.com'),
	('000000000000000015', 'farhan.novrizal@gmail.com'),
	('000000000000000016', 'riky.rizkiyana@gmail.com'),
	('000000000000000017', 'adelia.lubis@gmail.com'),
	('000000000000000018', 'shafira.marliana@gmail.com'),
	('000000000000000019', 'gunawan.busyaeri@gmail.com'),
	('000000000000000020', 'aris.darajat@gmail.com');

create table siswa(
	nis varchar(20),
	nama varchar(50),
	email varchar(50) not null,
	tempat varchar(50),
	tanggal_lahir date,
	alamat text,
	nomor_telepon varchar(12),
	constraint pk_nis primary key(nis),
	constraint uniq_email_siswa unique(email),
	constraint uniq_nomor_telepon_siswa unique(nomor_telepon)
);

/*buat data siswa sebanyak 100*/
insert into siswa(nis, email) values
	('0000001', 'asep.hidayat@gmail.com'),
	('0000002', 'fitri.ana.dewi@gmail.com'),
	('0000003', 'firman.utina@gmail.com'),
	('0000004', 'makan.konate@gmail.com'),
	('0000005', 'kosin.hatairatanakul@gmail.com'),
	('0000006', 'supardi.nasir@gmail.com'),
	('0000007', 'made.wirawan@gmail.com'),
	('0000008', 'cecep.supriatna@gmail.com'),
	('0000009', 'aziz.priatna@gmail.com'),
	('0000010', 'miljan.radovic@gmail.com'),
	('0000011', 'haryono@gmail.com'),
	('0000012', 'tony.sucipto@gmail.com'),
	('0000013', 'yugi@gmail.com'),
	('0000014', 'bakura@gmail.com'),
	('0000015', 'honda@gmail.com'),
	('0000016', 'jounochi@gmail.com'),
	('0000017', 'kaiba@gmail.com'),
	('0000018', 'spasojevic@gmail.com'),
	('0000019', 'rahmaniansyah@gmail.com'),
	('0000020', 'yudha@gmail.com'),
	('0000021', 'yusril.mahendra@gmail.com'),
	('0000022', 'jokowi@gmail.com'),
	('0000023', 'jusuf.kalla@gmail.com'),
	('0000024', 'setya.novanto@gmail.com'),
	('0000025', 'luhut.panjaitan@gmail.com'),
	('0000026', 'anies.baswedan@gmail.com'),
	('0000027', 'fitri.rahmah@gmail.com'),
	('0000028', 'taufik.sulaksana@gmail.com'),
	('0000029', 'yessi@gmail.com'),
	('0000030', 'vini@gmail.com'),
	('0000031', 'maulana.firdaus@gmail.com'),
	('0000032', 'ilham.muhkarom@gmail.com'),
	('0000033', 'regina.triani@gmail.com'),
	('0000034', 'mass.agung@gmail.com'),
	('0000035', 'farras.naufal@gmail.com'),
	('0000036', 'adi.pradipta@gmail.com'),
	('0000037', 'intan.permatasari@gmail.com'),
	('0000038', 'mailuz.zulfa@gmail.com'),
	('0000039', 'desi.nurhidayati@gmail.com'),
	('0000040', 'qori.halimatul@gmail.com'),
	('0000041', 'nurul.nurjannah@gmail.com'),
	('0000042', 'jeihan.hafidz@gmail.com'),
	('0000043', 'nida@gmail.com'),
	('0000044', 'farah.wihda@gmail.com'),
	('0000045', 'tyas.dhiba@gmail.com'),
	('0000046', 'nissa.alda@gmail.com'),
	('0000047', 'fambi.alda@gmail.com'),
	('0000048', 'annisa.rahmayanti@gmail.com'),
	('0000049', 'annisa.larasati@gmail.com'),
	('0000050', 'gun.supriatno@gmail.com'),
	('0000051', 'ronaldo.simanjuntak@gmail.com'),
	('0000052', 'azis.darojat@gmail.com'),
	('0000053', 'davialdo@gmail.com'),
	('0000054', 'tandry@gmail.com'),
	('0000055', 'fathurrachman.damar@gmail.com'),
	('0000056', 'fakhri.abdullah@gmail.com'),
	('0000057', 'beni.handoko@gmail.com'),
	('0000058', 'alifia.chinka@gmail.com'),
	('0000059', 'siti.hanifah@gmail.com'),
	('0000060', 'agna.suhadna@gmail.com'),
	('0000061', 'riski.andika@gmail.com'),
	('0000062', 'rizki.egi@gmail.com'),
	('0000063', 'rima.yuliana@gmail.com'),
	('0000064', 'reno.redianto@gmail.com'),
	('0000065', 'yusuf.andrianto@gmail.com'),
	('0000066', 'irsyad.riandri@gmail.com'),
	('0000067', 'ahmad.zainal@gmail.com'),
	('0000068', 'faisal.syaiful@gmail.com'),
	('0000069', 'muhammad.ridwan@gmail.com'),
	('0000070', 'bilal@gmail.com'),
	('0000071', 'risna@gmail.com'),
	('0000072', 'ruqoyah@gmail.com'),
	('0000073', 'yolanda.shamawati@gmail.com'),
	('0000074', 'irnanda.maulidya@gmail.com'),
	('0000075', 'putut.wijayanto@gmail.com'),
	('0000076', 'syukriyansyah@gmail.com'),
	('0000077', 'szalsza@gmail.com'),
	('0000078', 'ayu.nabila@gmail.com'),
	('0000079', 'salamah@gmail.com'),
	('0000080', 'darmawansyah@gmail.com'),
	('0000081', 'nurul.audina@gmail.com'),
	('0000082', 'mutia.riska@gmail.com'),
	('0000083', 'rossy.agustriyanda@gmail.com'),
	('0000084', 'liza.mustika@gmail.com'),
	('0000085', 'yusri.purnama@gmail.com'),
	('0000086', 'muhammad.dafit@gmail.com'),
	('0000087', 'mustafa.ramadhan@gmail.com'),
	('0000088', 'ikhsan@gmail.com'),
	('0000089', 'anzir.tanjung@gmail.com'),
	('0000090', 'helmi.akbar@gmail.com'),
	('0000091', 'toto.septiyana@gmail.com'),
	('0000092', 'nur.haifa@gmail.com'),
	('0000093', 'fidela.zhafira@gmail.com'),
	('0000094', 'aulia.fahmi@gmail.com'),
	('0000095', 'muhammad.auliya@gmail.com'),
	('0000096', 'silmi.nur.asmi@gmail.com'),
	('0000097', 'dita.apriliani@gmail.com'),
	('0000098', 'hazmi.fadhilah@gmail.com'),
	('0000099', 'rahmadi.pambayun@gmail.com'),
	('0000100', 'komaria@gmail.com');

create table akun(
	id_akun int auto_increment,
	email varchar(50) not null,
	username varchar(50) not null,
	password varchar(255) not null,
	nama varchar(50),
	foto varchar(255),
	nomor_level int,
	status_akun varchar(15) not null,
	nip varchar(20),
	nis varchar(20),
	constraint pk_id_akun primary key(id_akun),
	constraint uniq_email_akun unique(email),
	constraint uniq_username unique(username),
	constraint fk_nomor_level foreign key(nomor_level) references level(nomor_level) on delete set null,
	constraint chk_nomor_level check(nomor_level in(1, 2, 3)),
	constraint chk_status_akun check(status_akun in('Aktif', 'Pending'))
);

create table jurusan(
	id_jurusan int auto_increment,
	nama varchar(30) not null,
	constraint pk_id_jurusan primary key(id_jurusan),
	constraint chk_nama_jurusan check(nama in('MIA', 'IIS'))
);

insert into jurusan values
	(null, 'MIA'),
	(null, 'IIS');

create table semester(
	id_semester int auto_increment,
	keterangan varchar(10) not null,
	constraint pk_id_semester primary key(id_semester),
	constraint chk_keterangan check(keterangan in('Ganjil', 'Genap'))
);

insert into semester values
	(null, 'Ganjil'),
	(null, 'Genap');

create table kelas(
	id_kelas int auto_increment,
	id_jurusan int,
	nama varchar(10) not null,
	constraint pk_id_kelas primary key(id_kelas),
	constraint fk_id_jurusan foreign key(id_jurusan) references jurusan(id_jurusan) on delete set null,
	constraint chk_nama_kelas check(nama in('X-MIA-1', 'X-MIA-2', 'X-IIS-1', 'X-IIS-2', 'XI-MIA-1', 'XI-MIA-2', 'XI-IIS-1', 'XI-IIS-2', 'XII-MIA-1', 'XII-MIA-2', 'XII-IIS-1', 'XII-IIS-2'))
);

insert into kelas values
	(null, 1, 'X-MIA-1'),
	(null, 1, 'X-MIA-2'),
	(null, 1, 'XI-MIA-1'),
	(null, 1, 'XI-MIA-2'),
	(null, 1, 'XII-MIA-1'),
	(null, 1, 'XII-MIA-2'),
	(null, 2, 'X-IIS-1'),
	(null, 2, 'X-IIS-2'),
	(null, 2, 'XI-IIS-1'),
	(null, 2, 'XI-IIS-2'),
	(null, 2, 'XII-IIS-1'),
	(null, 2, 'XII-IIS-2');

create table mapel(
	id_mapel int auto_increment,
	nama varchar(50) not null,
	constraint pk_id_mapel primary key(id_mapel),
	constraint chk_nama_mapel check(nama in('Matematika', 'Fisika', 'Kimia', 'Biologi', 'TIK', 'Sejarah', 'Sosiologi', 'Geografi', 'Ekonomi', 'Bahasa Indonesia', 'Bahasa Inggris', 'Pendidikan Agama Islam', 'Pendidikan Pancasila dan Kewarganegaraan', 'Seni Budaya'))
);

insert into mapel values
	(null, 'Matematika'),
	(null, 'Fisika'),
	(null, 'Kimia'),
	(null, 'Biologi'),
	(null, 'TIK'),
	(null, 'Sejarah'),
	(null, 'Sosiologi'),
	(null, 'Geografi'),
	(null, 'Ekonomi'),
	(null, 'Bahasa Indonesia'),
	(null, 'Bahasa Inggris'),
	(null, 'Pendidikan Agama Islam'),
	(null, 'Pendidikan Pancasila dan Kewarganegaraan'),
	(null, 'Seni Budaya');

create table spesialisasi(
	id_spesialisasi int auto_increment,
	nip varchar(20),
	id_mapel int,
	constraint pk_id_spesialisasi primary key(id_spesialisasi),
	constraint fk_nip_spesialisasi foreign key(nip) references guru(nip) on delete set null,
	constraint fk_id_mapel_spesialisasi foreign key(id_mapel) references mapel(id_mapel) on delete set null
);

create table spesialisasi_siswa(
	id_spesialisasi_siswa int auto_increment,
	nis varchar(20),
	id_kelas int,
	id_semester int,
	constraint pk_id_spesialisasi_siswa primary key(id_spesialisasi_siswa),
	constraint fk_nis_spesialisasi foreign key(nis) references siswa(nis) on delete set null,
	constraint fk_id_kelas_spes foreign key(id_kelas) references kelas(id_kelas) on delete set null,
	constraint fk_id_semester_spes foreign key(id_semester) references semester(id_semester) on delete set null
);

create table bahan_ajar(
	id_bahan_ajar int auto_increment,
	id_spesialisasi int,
	id_kelas int,
	id_semester int,
	nama varchar(50) not null,
	bahan_ajar varchar(255) not null,
	keterangan text not null,
	constraint pk_id_bahan_ajar primary key(id_bahan_ajar),
	constraint fk_id_spesialisasi foreign key(id_spesialisasi) references spesialisasi(id_spesialisasi) on delete set null,
	constraint fk_id_kelas foreign key(id_kelas) references kelas(id_kelas) on delete set null,
	constraint fk_id_semester_bahan foreign key(id_semester) references semester(id_semester) on delete set null
);