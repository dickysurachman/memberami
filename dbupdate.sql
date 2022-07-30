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


alter table `barang` add harga double NULL;