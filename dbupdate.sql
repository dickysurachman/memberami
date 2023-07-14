alter table visit modify nama varchar(100) NULL;
alter table demo modify nama varchar(100) NULL;
alter table training modify nama varchar(100) NULL;

alter table visit add ket text NULL;
alter table demo add ket text NULL;
alter table training add ket text NULL;


alter table profile modify logo varchar(250) NULL;


 composer require kartik-v/yii2-widget-fileinput "@dev"



CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode` varchar(9) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `ukuran` varchar(13) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);
  
 ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


START TRANSACTION;
  CREATE TABLE `barang_po` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode` varchar(15) NOT NULL,
  `dari` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `add_who` int(11) DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  `edit_who` int(11) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `barang_podetail` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_kode` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `barang_po`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `barang_podetail`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `barang_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `barang_podetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `barang_podetail`
  ADD CONSTRAINT  FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE;
COMMIT;

ALTER TABLE `barang_podetail`
  ADD CONSTRAINT  FOREIGN KEY (`id_kode`) REFERENCES `barang_po` (`id`) ON DELETE CASCADE;

ALTER TABLE `barang_podetail` ADD FOREIGN KEY (`id_kode`) REFERENCES `barang_po`(`id`) ON DELETE CASCADE;

alter table `barang` add harga double NULL;

alter table `barang_po` add id_project int(11) NULL;


create view `podetail` as select a.tanggal,b.nama,a.kode,c.qty * d.harga as total from barang_po a 
join costumer b on a.id_perusahaan=b.id 
  join barang_podetail c on c.id_kode=a.id 
  join barang d on c.id_barang=d.id ;

create view `podetailsum` as select tanggal,nama,kode,sum(total) as total from podetail
  group by tanggal,nama,kode;



create table `user_level`(id int(11), nama varchar(100), diskon double NULL, status int(2) DEFAULT '0');
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


alter table `user` add id_level int(11) NULL;

alter table `barang_podetail` add harga_d double NULL;
alter table `barang_podetail` add harga_m double NULL;

drop view  `podetail`;
drop view `podetailsum`;


create view `podetail` as select a.tanggal,b.nama,a.kode,c.qty * c.harga_m as total from barang_po a 
join costumer b on a.id_perusahaan=b.id 
  join barang_podetail c on c.id_kode=a.id 
  join barang d on c.id_barang=d.id ;

create view `podetailsum` as select tanggal,nama,kode,sum(total) as total from podetail
  group by tanggal,nama,kode;


alter table `profile` add `nama_s` varchar(100) NULL;
alter table `profile` add `telp_s` varchar(50) NULL;


alter table `profile` add `telp_c` varchar(50) NULL;
alter table `profile` add `email` varchar(100) NULL;
alter table `profile` add `email_s` varchar(100) NULL;


alter table `barang_po` add `nohp` varchar(30) NULL;
alter table `barang_po` add `payment` varchar(50) NULL;
alter table `barang_po` add `term` varchar(50) NULL;
alter table `barang_po` add `curr` varchar(10) NULL;

3-3-2023

alter table  `profile` add `akta` varchar(125) NULL, add `kemenkumham` varchar(125) NULL, add `nib` varchar(125),
add `npwp_f` varchar(125)


14-7-2023

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);
  
 ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  alter table `barang` add `id_kat` int(11) NULL;
  alter table `kategori` add `id_toko` int(11) NULL;