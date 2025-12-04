CREATE DATABASE IF NOT EXISTS db_library;
USE db_library;


CREATE TABLE anggota (
    id_anggota INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    no_telepon VARCHAR(15),
    tanggal_daftar DATE NOT NULL,
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif'
);

CREATE TABLE kategori (
    id_kategori INT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(50) UNIQUE NOT NULL,
    deskripsi TEXT
);

CREATE TABLE buku (
    id_buku INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(200) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100),
    tahun_terbit YEAR,
    stok INT DEFAULT 1,
    kategori_id INT,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id_kategori)
);

CREATE TABLE peminjaman (
    id_peminjaman INT PRIMARY KEY AUTO_INCREMENT,
    anggota_id INT NOT NULL,
    buku_id INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE,
    status ENUM('dipinjam', 'dikembalikan') DEFAULT 'dipinjam',
    FOREIGN KEY (anggota_id) REFERENCES anggota(id_anggota),
    FOREIGN KEY (buku_id) REFERENCES buku(id_buku)
);

-- Data kategori
INSERT INTO kategori (nama_kategori, deskripsi) VALUES
('Teknologi', 'Buku tentang teknologi dan pemrograman'),
('Fiksi', 'Novel dan cerita fiksi'),
('Pendidikan', 'Buku pelajaran dan pendidikan'),
('Bisnis', 'Buku tentang bisnis dan ekonomi');

-- Data buku
INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, stok, kategori_id) VALUES
('Pemrograman PHP', 'Budi Santoso', 'Informatika', 2023, 5, 1),
('Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 3, 2);

-- Data anggota
INSERT INTO anggota (nama, email, no_telepon, tanggal_daftar, status) VALUES
('Ahmad Fauzi', 'ahmad@email.com', '081234567890', '2024-01-15', 'aktif'),
('Siti Rahma', 'siti@email.com', '081298765432', '2024-02-20', 'aktif');


INSERT INTO peminjaman (anggota_id, buku_id, tanggal_pinjam, tanggal_kembali, status) VALUES
(1, 1, '2024-12-01', '2024-12-15', 'dipinjam'),   
(2, 2, '2024-12-05', '2024-12-19', 'dipinjam'),   
(1, 1, '2024-12-10', '2024-12-24', 'dipinjam');
