-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jan 2023 pada 04.08
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
(2, 1, '11001', 'HVS 80gr', 'Buah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_instansi`
--

CREATE TABLE `tb_instansi` (
  `id_instansi` int(11) NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `alamat_instansi` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `tahun` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_instansi`
--

INSERT INTO `tb_instansi` (`id_instansi`, `nama_instansi`, `alamat_instansi`, `no_telp`, `tahun`, `id_user`) VALUES
(7, 'Kecamatan Gajah', 'Jl. Raya Gajah No. 45 Demak', '(0291) 685250', '2021-07-24', 1),
(8, 'Kecamatan Mijen', 'Wedung', '089677017239', '2021-07-24', 2);

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
(1, 'Bahan Pakai Habis'),
(3, 'Bahan Cetak dan Jilid'),
(4, 'Bahan Cetak');

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
(1, 7, 'Drs. AGUNG WIDODO, MM', '197204021992031005', 'CAMAT GAJAH', 'Pembina Tk. I (IV/b)', 1);

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
  `tanggal_beli` date NOT NULL,
  `nama_rekanan` varchar(100) NOT NULL,
  `no_dokumen` varchar(50) NOT NULL,
  `tanggal_dokumen` date NOT NULL,
  `tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `id_instansi`, `id_user`, `kode_barang`, `volume`, `harga_satuan`, `jumlah_harga`, `tanggal_beli`, `nama_rekanan`, `no_dokumen`, `tanggal_dokumen`, `tahun`) VALUES
(3, 7, 1, '11001', '2', '68000', '136000', '2023-01-02', '', '', '0000-00-00', '2023');

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
  `tanggal_spb` date NOT NULL,
  `trx` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `id_instansi`, `id_user`, `id_pembelian`, `kode_barang`, `volume`, `harga_satuan`, `jumlah_harga`, `penanggungjawab`, `no_spb`, `tanggal_spb`, `trx`) VALUES
(7, 7, 1, 1, '11001', '2', '68000', '136000', '1', '1', '2023-01-26', 'TRX001'),
(9, 7, 1, 1, '11001', '1', '68000', '68000', '1', '2', '2023-01-24', 'TRX002'),
(10, 7, 1, 1, '11001', '2', '68000', '136000', '1', '2', '2023-01-26', 'TRX002');

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
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_saldo_awal`
--

INSERT INTO `tb_saldo_awal` (`id_saldo_awal`, `id_pembelian`, `id_instansi`, `id_user`, `kode_barang`, `volume`, `harga_satuan`, `jumlah_harga`, `tanggal`) VALUES
(1, 1, 7, 1, '11001', '2', '68000', '136000', '2023-01-02');

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
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'admin', '$2y$10$F4/LPUsdSi4KhqirDET2..tJAXXTyI.XYcqZxxhvvLiX/FQumVxeS', 'admin'),
(2, 'User', 'ngadmin', '$2y$10$06WOAEjDfLoa.maDGbGHZeTvSXq/f3VACWVPTQSHE1y4hSMb0fL6a', 'user');

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
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
