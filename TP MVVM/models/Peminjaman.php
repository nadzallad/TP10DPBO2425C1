<?php
require_once "config/Database.php";

class PeminjamanModel
{
    private $conn;
    private $table = "peminjaman";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT p.*, 
                         a.nama as nama_anggota, 
                         b.judul as judul_buku
                  FROM " . $this->table . " p
                  JOIN anggota a ON p.anggota_id = a.id_anggota
                  JOIN buku b ON p.buku_id = b.id_buku
                  ORDER BY p.tanggal_pinjam DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_peminjaman)
    {
        $query = "SELECT p.*, 
                         a.nama as nama_anggota, 
                         b.judul as judul_buku
                  FROM " . $this->table . " p
                  JOIN anggota a ON p.anggota_id = a.id_anggota
                  JOIN buku b ON p.buku_id = b.id_buku
                  WHERE p.id_peminjaman = :id_peminjaman";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_peminjaman', $id_peminjaman);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        // 1. Kurangi stok buku
        $updateStokQuery = "UPDATE buku SET stok = stok - 1 WHERE id_buku = :buku_id";
        $updateStmt = $this->conn->prepare($updateStokQuery);
        $updateStmt->bindParam(':buku_id', $data['buku_id']);
        $updateStmt->execute();
        
        // 2. Simpan peminjaman
        $query = "INSERT INTO " . $this->table . " 
                  (anggota_id, buku_id, tanggal_pinjam, tanggal_kembali, status) 
                  VALUES (:anggota_id, :buku_id, :tanggal_pinjam, :tanggal_kembali, :status)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':anggota_id', $data['anggota_id']);
        $stmt->bindParam(':buku_id', $data['buku_id']);
        $stmt->bindParam(':tanggal_pinjam', $data['tanggal_pinjam']);
        
        // Tanggal kembali (bisa null)
        $tanggal_kembali = !empty($data['tanggal_kembali']) ? $data['tanggal_kembali'] : null;
        $stmt->bindParam(':tanggal_kembali', $tanggal_kembali);
        
        // Status
        $status = !empty($data['status']) ? $data['status'] : 'dipinjam';
        $stmt->bindParam(':status', $status);
        
        return $stmt->execute();
    }

    public function updateStatus($id_peminjaman, $status, $tanggal_kembali = null)
    {
        // Jika dikembalikan, tambah stok buku
        if ($status == 'dikembalikan') {
            $peminjaman = $this->getById($id_peminjaman);
            $updateStokQuery = "UPDATE buku SET stok = stok + 1 WHERE id_buku = :buku_id";
            $updateStmt = $this->conn->prepare($updateStokQuery);
            $updateStmt->bindParam(':buku_id', $peminjaman['buku_id']);
            $updateStmt->execute();
        }
        
        $query = "UPDATE " . $this->table . " 
                  SET status = :status";
        
        // Tambah tanggal kembali jika ada
        if ($tanggal_kembali !== null && $tanggal_kembali != '') {
            $query .= ", tanggal_kembali = :tanggal_kembali";
        }
        
        $query .= " WHERE id_peminjaman = :id_peminjaman";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_peminjaman', $id_peminjaman);
        $stmt->bindParam(':status', $status);
        
        if ($tanggal_kembali !== null && $tanggal_kembali != '') {
            $stmt->bindParam(':tanggal_kembali', $tanggal_kembali);
        }
        
        return $stmt->execute();
    }

    public function delete($id_peminjaman)
    {
        // Tambah stok buku jika masih dipinjam
        $peminjaman = $this->getById($id_peminjaman);
        if ($peminjaman['status'] == 'dipinjam') {
            $updateStokQuery = "UPDATE buku SET stok = stok + 1 WHERE id_buku = :buku_id";
            $updateStmt = $this->conn->prepare($updateStokQuery);
            $updateStmt->bindParam(':buku_id', $peminjaman['buku_id']);
            $updateStmt->execute();
        }
        
        $query = "DELETE FROM " . $this->table . " WHERE id_peminjaman = :id_peminjaman";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_peminjaman', $id_peminjaman);
        return $stmt->execute();
    }

}
?>