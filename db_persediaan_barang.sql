-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2023 pada 15.32
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_persediaan_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan_barang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `id_kategori`, `kode_barang`, `nama_barang`, `satuan_barang`) VALUES
(1, 1, '11001', 'HVS 80 gr', 'Rim'),
(2, 2, '11002', 'Ballpoint Standart', 'Dus'),
(3, 2, '11003', 'Buku Tulis', 'Buah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_instansi`
--

CREATE TABLE `tb_instansi` (
  `id_instansi` int(11) NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `alamat_instansi` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `kd_pos` varchar(10) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tahun` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_instansi`
--

INSERT INTO `tb_instansi` (`id_instansi`, `nama_instansi`, `alamat_instansi`, `no_telp`, `kd_pos`, `website`, `email`, `tahun`, `id_user`) VALUES
(7, 'Kecamatan Gajah', 'Jl. Raya Gajah No. 45 Demak', '(0291) 685250', '59581', 'https://kecgajah.demakkab.go.id', 'office.kec.gajah@gmail.com', '2021-07-24', 1),
(8, 'Kecamatan Mijen', 'Mijen', '089677017239', '59551', 'https://kecmijen.demakkab.go.id', 'kecmijen@gmail.com', '2021-07-24', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Alat Tulis Kantor (ATK)'),
(2, 'Bahan Cetak'),
(3, 'Bahan Material');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `pangkat` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `id_instansi`, `nama_pegawai`, `nip`, `jabatan`, `pangkat`, `id_user`) VALUES
(1, 7, 'Drs. AGUNG WIDODO, MM', '197204021992031005', 'Camat Gajah', 'Pembina Tk. I (IV/b)', 1),
(3, 7, 'HARTINI', '19671010 199009 2 002', 'Staf', 'Penata Muda Tk. I (III/b)', 1),
(4, 7, 'SITI ASLIMAH, S.Sos, MM', '19750128 199703 2 002', 'Kasubag Program Kec. Gajah', 'Penata Tk.I (III/d)', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `volume` varchar(10) NOT NULL,
  `harga_satuan` varchar(20) NOT NULL,
  `jumlah_harga` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_rekanan` varchar(100) NOT NULL,
  `no_dokumen` varchar(50) NOT NULL,
  `tanggal_dokumen` date NOT NULL,
  `tahun` date NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `id_instansi`, `id_user`, `kode_barang`, `volume`, `harga_satuan`, `jumlah_harga`, `tanggal`, `nama_rekanan`, `no_dokumen`, `tanggal_dokumen`, `tahun`, `id_kategori`) VALUES
(1, 7, 1, '11001', '7', '68000', '680000', '2023-02-02', '', '', '0000-00-00', '2023-02-02', 1),
(2, 7, 1, '11002', '5', '5000', '60000', '2023-02-05', '', '', '0000-00-00', '2023-02-05', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian_detail`
--

CREATE TABLE `tb_pembelian_detail` (
  `id_pembelian` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `volume` varchar(10) NOT NULL,
  `harga_satuan` varchar(20) NOT NULL,
  `jumlah_harga` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_rekanan` varchar(100) NOT NULL,
  `no_dokumen` varchar(50) NOT NULL,
  `tanggal_dokumen` date NOT NULL,
  `tahun` date NOT NULL,
  `regdate` datetime NOT NULL DEFAULT current_timestamp(),
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembelian_detail`
--

INSERT INTO `tb_pembelian_detail` (`id_pembelian`, `id_instansi`, `id_user`, `kode_barang`, `volume`, `harga_satuan`, `jumlah_harga`, `tanggal`, `nama_rekanan`, `no_dokumen`, `tanggal_dokumen`, `tahun`, `regdate`, `id_kategori`) VALUES
(1, 7, 1, '11001', '10', '68000', '680000', '2023-02-02', '', '', '0000-00-00', '2023-02-02', '2023-03-07 21:48:44', 1),
(2, 7, 1, '11002', '12', '5000', '60000', '2023-02-05', '', '', '0000-00-00', '2023-02-05', '2023-03-07 21:49:33', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `volume` varchar(10) NOT NULL,
  `harga_satuan` varchar(20) NOT NULL,
  `jumlah_harga` varchar(20) NOT NULL,
  `penanggungjawab` varchar(50) NOT NULL,
  `no_spb` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `trx` varchar(50) NOT NULL,
  `ket` varchar(15) NOT NULL,
  `tahun` date DEFAULT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `id_instansi`, `id_user`, `id_pembelian`, `kode_barang`, `volume`, `harga_satuan`, `jumlah_harga`, `penanggungjawab`, `no_spb`, `tanggal`, `trx`, `ket`, `tahun`, `id_kategori`) VALUES
(2, 7, 1, 1, '11001', '3', '68000', '204000', '4', '02', '2023-02-13', 'TRX002', '-', '2023-02-13', 0),
(3, 7, 1, 2, '11002', '5', '5000', '25000', '4', '02', '2023-02-15', 'TRX002', '-', '2023-02-15', 0),
(4, 7, 1, 3, '11003', '1', '7000', '7000', '1', '03', '2023-03-02', 'TRX003', 'Saldo Awal', '2023-03-02', 2),
(5, 7, 1, 3, '11003', '2', '7000', '14000', '3', '04', '2023-02-13', 'TRX004', 'Saldo Awal', '2023-02-13', 2),
(6, 7, 1, 2, '11002', '2', '5000', '10000', '1', '05', '2023-03-02', 'TRX005', '-', '2023-03-02', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran_detail`
--

CREATE TABLE `tb_pengeluaran_detail` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `volume` varchar(10) NOT NULL,
  `harga_satuan` varchar(20) NOT NULL,
  `jumlah_harga` varchar(20) NOT NULL,
  `penanggungjawab` varchar(50) NOT NULL,
  `no_spb` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `trx` varchar(50) NOT NULL,
  `ket` varchar(15) NOT NULL,
  `tahun` date DEFAULT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengeluaran_detail`
--

INSERT INTO `tb_pengeluaran_detail` (`id_pengeluaran`, `id_instansi`, `id_user`, `id_pembelian`, `kode_barang`, `volume`, `harga_satuan`, `jumlah_harga`, `penanggungjawab`, `no_spb`, `tanggal`, `trx`, `ket`, `tahun`, `id_kategori`) VALUES
(2, 7, 1, 1, '11001', '3', '68000', '204000', '4', '02', '2023-02-13', 'TRX002', '-', '2023-02-13', 1),
(3, 7, 1, 2, '11002', '5', '5000', '25000', '4', '02', '2023-02-15', 'TRX002', '-', '2023-02-15', 2),
(4, 7, 1, 3, '11003', '1', '7000', '7000', '1', '03', '2023-03-02', 'TRX003', 'Saldo Awal', '2023-03-02', 2),
(5, 7, 1, 3, '11003', '2', '7000', '14000', '3', '04', '2023-02-13', 'TRX004', 'Saldo Awal', '2023-02-13', 2),
(6, 7, 1, 2, '11002', '2', '5000', '10000', '1', '05', '2023-03-02', 'TRX005', '-', '2023-03-02', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saldo_awal`
--

CREATE TABLE `tb_saldo_awal` (
  `id_saldo_awal` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `volume` varchar(10) NOT NULL,
  `harga_satuan` varchar(20) NOT NULL,
  `jumlah_harga` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_saldo_awal`
--

INSERT INTO `tb_saldo_awal` (`id_saldo_awal`, `id_pembelian`, `id_instansi`, `id_user`, `kode_barang`, `volume`, `harga_satuan`, `jumlah_harga`, `tanggal`, `id_kategori`) VALUES
(1, 3, 7, 1, '11003', '3', '7000', '21000', '2023-01-02', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saldo_awal_detail`
--

CREATE TABLE `tb_saldo_awal_detail` (
  `id_saldo_awal` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `volume` varchar(10) NOT NULL,
  `harga_satuan` varchar(20) NOT NULL,
  `jumlah_harga` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_saldo_awal_detail`
--

INSERT INTO `tb_saldo_awal_detail` (`id_saldo_awal`, `id_pembelian`, `id_instansi`, `id_user`, `kode_barang`, `volume`, `harga_satuan`, `jumlah_harga`, `tanggal`, `id_kategori`) VALUES
(1, 3, 7, 1, '11003', '0', '7000', '21000', '2023-01-02', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id_setting` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `pangkat` varchar(20) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_setting`
--

INSERT INTO `tb_setting` (`id_setting`, `id_instansi`, `id_user`, `nama`, `nip`, `jabatan`, `pangkat`, `id_pegawai`) VALUES
(1, 7, 1, 'Drs. AGUNG WIDODO, MM', '19641154411448', 'Pengguna Barang', 'Pembina Tk.I (IV/b)', 1),
(2, 7, 1, 'SITI ASLIMAH, S.Sos, MM', '19641154411448', 'Penatausaha Barang', 'Penata Tk.I (III/d)', 4),
(3, 7, 1, 'HARTINI', '19641154411448', 'Pengurus Barang', 'Penata Muda Tk. I (I', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `tgl_aktivasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`, `tgl_aktivasi`) VALUES
(1, 'Admin', 'admin', '$2y$10$F4/LPUsdSi4KhqirDET2..tJAXXTyI.XYcqZxxhvvLiX/FQumVxeS', 'admin', '9999-12-31'),
(2, 'Kecamatan Mijen', 'ngadmin', '$2y$10$27akh4zDida09TGgTC3qeuyfcheSKiVrsTyiIfDbRYELCOwJSZCfi', 'user', '2023-03-05'),
(3, 'Kecamatan Dempet', 'dempet', '$2y$10$6w15MI6fCtOV1X/cMFzhzOcgzx4Fb5vE.qf02zVHM4RW9v1HifXUm', 'user', '2023-04-05');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tb_pengeluaran_detail`
--
ALTER TABLE `tb_pengeluaran_detail`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tb_saldo_awal`
--
ALTER TABLE `tb_saldo_awal`
  ADD PRIMARY KEY (`id_saldo_awal`);

--
-- Indeks untuk tabel `tb_saldo_awal_detail`
--
ALTER TABLE `tb_saldo_awal_detail`
  ADD PRIMARY KEY (`id_saldo_awal`);

--
-- Indeks untuk tabel `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran_detail`
--
ALTER TABLE `tb_pengeluaran_detail`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_saldo_awal`
--
ALTER TABLE `tb_saldo_awal`
  MODIFY `id_saldo_awal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_saldo_awal_detail`
--
ALTER TABLE `tb_saldo_awal_detail`
  MODIFY `id_saldo_awal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
