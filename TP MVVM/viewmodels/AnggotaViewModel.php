<?php
require_once 'models/Anggota.php';

class AnggotaViewModel
{
    private $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    // Mengambil daftar seluruh anggota
    public function getAnggotaList()
    {
        return $this->anggotaModel->getAll();
    }

    // Mengambil data anggota berdasarkan ID
    public function getAnggotaById($id_anggota)
    {
        return $this->anggotaModel->getById($id_anggota);
    }

    // Menambah data anggota
    public function addAnggota($data)
    {
        // Validasi data
        if (empty($data['nama']) || empty($data['email'])) {
            throw new Exception("Nama dan email harus diisi");
        }
        
        // Format tanggal daftar jika tidak ada
        if (!isset($data['tanggal_daftar']) || empty($data['tanggal_daftar'])) {
            $data['tanggal_daftar'] = date('Y-m-d');
        }
        
        // Default status
        if (!isset($data['status'])) {
            $data['status'] = 'aktif';
        }
        
        return $this->anggotaModel->create($data);
    }

    // Mengupdate data anggota
    public function updateAnggota($id_anggota, $data)
    {
        // Validasi data
        if (empty($data['nama']) || empty($data['email'])) {
            throw new Exception("Nama dan email harus diisi");
        }
        
        return $this->anggotaModel->update($id_anggota, $data);
    }

    // Menghapus data anggota berdasarkan ID
    public function deleteAnggota($id_anggota)
    {
        return $this->anggotaModel->delete($id_anggota);
    }
}
?>
