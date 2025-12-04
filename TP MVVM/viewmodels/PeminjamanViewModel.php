<?php
require_once 'models/Peminjaman.php';
require_once 'models/Anggota.php';
require_once 'models/Buku.php';

class PeminjamanViewModel
{
    private $peminjamanModel;
    private $anggotaModel;
    private $bukuModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->anggotaModel = new AnggotaModel();
        $this->bukuModel = new BukuModel();
    }

    // Mengambil semua data peminjaman
    public function getPeminjamanList()
    {
        return $this->peminjamanModel->getAll();
    }

    // Mengambil peminjaman berdasarkan ID
    public function getPeminjamanById($id_peminjaman)
    {
        return $this->peminjamanModel->getById($id_peminjaman);
    }

    // Mengambil daftar anggota
    public function getAnggotaList()
    {
        return $this->anggotaModel->getAll();
    }

    // Mengambil daftar buku
    public function getBukuList()
    {
        return $this->bukuModel->getAll();
    }

    // Menambah data peminjaman baru
    public function addPeminjaman($data)
    {
        // Default tanggal pinjam
        if (empty($data['tanggal_pinjam'])) {
            $data['tanggal_pinjam'] = date('Y-m-d');
        }
        
        // Default status
        if (empty($data['status'])) {
            $data['status'] = 'dipinjam';
        }
        
        // Simpan ke model
        return $this->peminjamanModel->create($data);
    }

    // Update status peminjaman
    public function updateStatusPeminjaman($id_peminjaman, $status, $tanggal_kembali = null)
    {
        if ($status == 'dikembalikan') {
            if ($tanggal_kembali === null || $tanggal_kembali == '') {
                $tanggal_kembali = date('Y-m-d');
            }
        }
        return $this->peminjamanModel->updateStatus($id_peminjaman, $status, $tanggal_kembali);
    }

    // Menghapus peminjaman berdasarkan ID
    public function deletePeminjaman($id_peminjaman)
    {
        return $this->peminjamanModel->delete($id_peminjaman);
    }
}
?>
