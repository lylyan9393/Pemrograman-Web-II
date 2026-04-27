-- create Database
CREATE DATABASE perpustakaan;
USE perpustakaan;

-- create tabel
--1. tabel kategori buku
CREATE TABLE kategori_buku (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL UNIQUE,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--2. tabel penerbit
CREATE TABLE penerbit (
    id_penerbit INT AUTO_INCREMENT PRIMARY KEY,
    nama_penerbit VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--3. tabel buku
CREATE TABLE buku (
    id_buku INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    penulis VARCHAR(100),
    tahun_terbit YEAR,
    id_kategori INT,
    id_penerbit INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_kategori) REFERENCES kategori_buku(id_kategori),
    FOREIGN KEY (id_penerbit) REFERENCES penerbit(id_penerbit)
);

--insert data
--1. data kategori
INSERT INTO kategori_buku (nama_kategori, deskripsi) VALUES
('Novel', 'Buku cerita'),
('Pendidikan', 'Buku pelajaran'),
('Teknologi', 'Buku IT'),
('Sejarah', 'Buku sejarah'),
('Agama', 'Buku keagamaan');

--2. data penerbit
INSERT INTO penerbit (nama_penerbit, alamat, telepon, email) VALUES
('Erlangga', 'Jakarta', '08123456789', 'erlangga@email.com'),
('Gramedia', 'Jakarta', '08234567890', 'gramedia@email.com'),
('Informatika', 'Bandung', '08345678901', 'info@email.com'),
('Mizan', 'Bandung', '08456789012', 'mizan@email.com'),
('Andi Offset', 'Yogyakarta', '08567890123', 'andi@email.com');

--3. data buku
INSERT INTO buku (judul, penulis, tahun_terbit, id_kategori, id_penerbit) VALUES
('Laskar Pelangi', 'Andrea Hirata', 2005, 1, 2),
('Bumi', 'Tere Liye', 2014, 1, 2),
('Matematika Dasar', 'Budi', 2018, 2, 1),
('Fisika SMA', 'Andi', 2019, 2, 1),
('Pemrograman Java', 'Rudi', 2020, 3, 3),
('Database MySQL', 'Sari', 2021, 3, 3),
('Sejarah Indonesia', 'Ahmad', 2017, 4, 4),
('Sejarah Dunia', 'John', 2016, 4, 4),
('Fiqih Islam', 'Umar', 2015, 5, 5),
('Tafsir Quran', 'Ali', 2013, 5, 5),
('Algoritma', 'Dewi', 2022, 3, 3),
('Bahasa Indonesia', 'Sinta', 2020, 2, 1),
('Novel Cinta', 'Rina', 2018, 1, 2),
('Teknologi AI', 'Bayu', 2023, 3, 3),
('Sejarah Islam', 'Hasan', 2014, 4, 4);

-- Query join
--1. JOIN untuk tampilkan buku dengan nama kategori dan penerbit
SELECT 
    buku.judul,
    kategori_buku.nama_kategori,
    penerbit.nama_penerbit
FROM buku
JOIN kategori_buku ON buku.id_kategori = kategori_buku.id_kategori
JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit;

--2. Jumlah buku per kategori
SELECT 
    kategori_buku.nama_kategori,
    COUNT(buku.id_buku) AS jumlah_buku
FROM buku
JOIN kategori_buku ON buku.id_kategori = kategori_buku.id_kategori
GROUP BY kategori_buku.nama_kategori;

--3. Jumlah buku per penerbit
SELECT 
    penerbit.nama_penerbit,
    COUNT(buku.id_buku) AS jumlah_buku
FROM buku
JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
GROUP BY penerbit.nama_penerbit;

--4. Buku beserta detail lengkap (kategori + penerbit)
SELECT 
    buku.*,
    kategori_buku.nama_kategori,
    penerbit.nama_penerbit
FROM buku
JOIN kategori_buku ON buku.id_kategori = kategori_buku.id_kategori
JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit;
