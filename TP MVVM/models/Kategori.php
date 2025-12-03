<?php
require_once "config/Database.php";

class KategoriModel
{
    private $conn;                 // Koneksi database
    private $table = "kategori";   // Nama tabel kategori

    public function __construct()
    {
        // Membuat koneksi ke database
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Mengambil seluruh data kategori
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nama_kategori";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // Mengembalikan semua data kategori
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil data kategori berdasarkan ID
    public function getById($id_kategori)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_kategori = :id_kategori";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_kategori', $id_kategori);
        $stmt->execute();

        // Mengembalikan satu baris data kategori
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menambah kategori baru
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (nama_kategori, deskripsi)
                  VALUES (:nama_kategori, :deskripsi)";
        
        $stmt = $this->conn->prepare($query);

        // Binding value ke query
        $stmt->bindParam(':nama_kategori', $data['nama_kategori']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        
        // Eksekusi insert
        return $stmt->execute();
    }

    // Mengupdate data kategori berdasarkan ID
    public function update($id_kategori, $data)
    {
        $query = "UPDATE " . $this->table . " 
                  SET nama_kategori = :nama_kategori, 
                      deskripsi = :deskripsi 
                  WHERE id_kategori = :id_kategori";
        
        $stmt = $this->conn->prepare($query);

        // Binding parameter
        $stmt->bindParam(':id_kategori', $id_kategori);
        $stmt->bindParam(':nama_kategori', $data['nama_kategori']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        
        // Menjalankan update
        return $stmt->execute();
    }

    // Menghapus kategori berdasarkan ID
    public function delete($id_kategori)
    {
        // Mengecek apakah kategori masih digunakan oleh tabel buku
        $checkQuery = "SELECT COUNT(*) as count FROM buku WHERE kategori_id = :id_kategori";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':id_kategori', $id_kategori);
        $checkStmt->execute();

        $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

        // Jika masih digunakan, kategori tidak boleh dihapus
        if ($result['count'] > 0) {
            return false;
        }
        
        // Menghapus kategori jika tidak digunakan
        $query = "DELETE FROM " . $this->table . " WHERE id_kategori = :id_kategori";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_kategori', $id_kategori);

        return $stmt->execute();
    }
}
?>
