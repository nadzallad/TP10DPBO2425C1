<?php
require_once "config/Database.php";

class AnggotaModel
{
    private $conn;              // Menyimpan koneksi database
    private $table = "anggota"; // Nama tabel yang digunakan

    public function __construct()
    {
        // Membuat instance database dan mengambil koneksi
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Mengambil seluruh data anggota
    public function getAll()
    {
        // Query mengambil semua data anggota, urut berdasarkan tanggal daftar terbaru
        $query = "SELECT * FROM " . $this->table . " ORDER BY tanggal_daftar DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // Mengambil semua hasil sebagai array associative
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil data anggota berdasarkan ID
    public function getById($id_anggota)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_anggota = :id_anggota";
        $stmt = $this->conn->prepare($query);

        // Binding parameter ID untuk keamanan
        $stmt->bindParam(':id_anggota', $id_anggota);
        $stmt->execute();

        // Mengambil satu data anggota
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menambah data anggota baru
    public function create($data)
    {
        // Query insert data anggota baru
        $query = "INSERT INTO " . $this->table . " 
                  (nama, email, no_telepon, tanggal_daftar, status) 
                  VALUES (:nama, :email, :no_telepon, :tanggal_daftar, :status)";

        $stmt = $this->conn->prepare($query);

        // Binding nilai ke parameter query
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':no_telepon', $data['no_telepon']);
        $stmt->bindParam(':tanggal_daftar', $data['tanggal_daftar']);
        $stmt->bindParam(':status', $data['status']);

        // Eksekusi query
        return $stmt->execute();
    }

    // Mengupdate data anggota berdasarkan ID
    public function update($id_anggota, $data)
    {
        $query = "UPDATE " . $this->table . " 
                  SET nama = :nama, 
                      email = :email, 
                      no_telepon = :no_telepon,
                      status = :status 
                  WHERE id_anggota = :id_anggota";

        $stmt = $this->conn->prepare($query);

        // Binding parameter
        $stmt->bindParam(':id_anggota', $id_anggota);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':no_telepon', $data['no_telepon']);
        $stmt->bindParam(':status', $data['status']);

        // Menjalankan update
        return $stmt->execute();
    }

    // Menghapus data anggota berdasarkan ID
    public function delete($id_anggota)
    {
        // Query delete anggota berdasarkan ID
        $query = "DELETE FROM " . $this->table . " WHERE id_anggota = :id_anggota";
        $stmt = $this->conn->prepare($query);

        // Binding ID anggota
        $stmt->bindParam(':id_anggota', $id_anggota);

        // Menjalankan delete
        return $stmt->execute();
    }
}
?>
