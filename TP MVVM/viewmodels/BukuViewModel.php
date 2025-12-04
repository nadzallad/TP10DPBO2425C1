<?php
require_once 'models/Buku.php';
require_once 'models/Kategori.php';

class BukuViewModel
{
    private $bukuModel;
    private $kategoriModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->kategoriModel = new KategoriModel();
    }

    // Mengambil semua data buku
    public function getBukuList()
    {
        return $this->bukuModel->getAll();
    }

    // Mengambil daftar kategori
    public function getKategoriList()
    {
        return $this->kategoriModel->getAll();
    }

    // Mengambil detail buku berdasarkan ID
    public function getBukuById($id_buku)
    {
        return $this->bukuModel->getById($id_buku);
    }

    // Menambah data buku
    public function addBuku($data)
    {
        // Validasi wajib
        if (empty($data['judul']) || empty($data['penulis'])) {
            throw new Exception("Judul dan penulis harus diisi");
        }
        
        // Default stok
        if (!isset($data['stok']) || $data['stok'] === '') {
            $data['stok'] = 1;
        }
        
        // Default tahun terbit
        if (!isset($data['tahun_terbit']) || empty($data['tahun_terbit'])) {
            $data['tahun_terbit'] = date('Y');
        }
        
        return $this->bukuModel->create($data);
    }

    // Update data buku
    public function updateBuku($id_buku, $data)
    {
        // Validasi wajib
        if (empty($data['judul']) || empty($data['penulis'])) {
            throw new Exception("Judul dan penulis harus diisi");
        }
        
        return $this->bukuModel->update($id_buku, $data);
    }

    // Menghapus data buku berdasarkan ID
    public function deleteBuku($id_buku)
    {
        return $this->bukuModel->delete($id_buku);
    }
}
?>
