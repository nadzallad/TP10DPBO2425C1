<?php
require_once 'models/Kategori.php';

class KategoriViewModel
{
    private $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    // Mengambil semua data kategori
    public function getKategoriList()
    {
        return $this->kategoriModel->getAll();
    }

    // Mengambil kategori berdasarkan ID
    public function getKategoriById($id_kategori)
    {
        return $this->kategoriModel->getById($id_kategori);
    }

    // Menambah kategori baru
    public function addKategori($data)
    {
        // Validasi data
        if (empty($data['nama_kategori'])) {
            throw new Exception("Nama kategori harus diisi");
        }
        
        return $this->kategoriModel->create($data);
    }

    // Update kategori
    public function updateKategori($id_kategori, $data)
    {
        // Validasi data
        if (empty($data['nama_kategori'])) {
            throw new Exception("Nama kategori harus diisi");
        }
        
        return $this->kategoriModel->update($id_kategori, $data);
    }

    // Menghapus kategori berdasarkan ID
    public function deleteKategori($id_kategori)
    {
        return $this->kategoriModel->delete($id_kategori);
    }
}
?>
