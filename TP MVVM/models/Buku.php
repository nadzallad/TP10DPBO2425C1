<?php
require_once "config/Database.php";

class BukuModel
{
    private $conn;            // Koneksi database
    private $table = "buku";  // Nama tabel buku

    public function __construct()
    {
        // Membuat koneksi ke database
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Mengambil seluruh data buku beserta nama kategori
    public function getAll()
    {
        // Query join ke tabel kategori untuk mengambil nama kategori
        $query = "SELECT b.*, k.nama_kategori 
                  FROM " . $this->table . " b
                  LEFT JOIN kategori k ON b.kategori_id = k.id_kategori
                  ORDER BY b.judul";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // Mengembalikan seluruh hasil dalam bentuk array associative
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil satu data buku berdasarkan ID
    public function getById($id_buku)
    {
        $query = "SELECT b.*, k.nama_kategori 
                  FROM " . $this->table . " b
                  LEFT JOIN kategori k ON b.kategori_id = k.id_kategori
                  WHERE b.id_buku = :id_buku";

        $stmt = $this->conn->prepare($query);

        // Binding parameter id buku
        $stmt->bindParam(':id_buku', $id_buku);
        $stmt->execute();

        // Mengembalikan satu baris data
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menambah buku baru
    public function create($data)
    {
        // Query insert buku baru
        $query = "INSERT INTO " . $this->table . " 
                  (judul, penulis, penerbit, tahun_terbit, stok, kategori_id) 
                  VALUES (:judul, :penulis, :penerbit, :tahun_terbit, :stok, :kategori_id)";
        
        $stmt = $this->conn->prepare($query);

        // Binding parameter ke query
        $stmt->bindParam(':judul', $data['judul']);
        $stmt->bindParam(':penulis', $data['penulis']);
        $stmt->bindParam(':penerbit', $data['penerbit']);
        $stmt->bindParam(':tahun_terbit', $data['tahun_terbit']);
        $stmt->bindParam(':stok', $data['stok']);
        $stmt->bindParam(':kategori_id', $data['kategori_id']);
        
        // Eksekusi insert
        return $stmt->execute();
    }

    // Mengupdate data buku berdasarkan ID
    public function update($id_buku, $data)
    {
        // Query update
        $query = "UPDATE " . $this->table . " 
                  SET judul = :judul, 
                      penulis = :penulis, 
                      penerbit = :penerbit,
                      tahun_terbit = :tahun_terbit,
                      stok = :stok,
                      kategori_id = :kategori_id
                  WHERE id_buku = :id_buku";
        
        $stmt = $this->conn->prepare($query);

        // Binding parameter
        $stmt->bindParam(':id_buku', $id_buku);
        $stmt->bindParam(':judul', $data['judul']);
        $stmt->bindParam(':penulis', $data['penulis']);
        $stmt->bindParam(':penerbit', $data['penerbit']);
        $stmt->bindParam(':tahun_terbit', $data['tahun_terbit']);
        $stmt->bindParam(':stok', $data['stok']);
        $stmt->bindParam(':kategori_id', $data['kategori_id']);
        
        // Menjalankan update
        return $stmt->execute();
    }

    // Menghapus data buku berdasarkan ID
    public function delete($id_buku)
    {
        // Query delete berdasarkan ID buku
        $query = "DELETE FROM " . $this->table . " WHERE id_buku = :id_buku";

        $stmt = $this->conn->prepare($query);

        // Binding ID buku
        $stmt->bindParam(':id_buku', $id_buku);

        // Eksekusi delete
        return $stmt->execute();
    }
}
?>
