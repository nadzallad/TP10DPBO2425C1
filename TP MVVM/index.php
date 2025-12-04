<?php

require_once 'viewmodels/AnggotaViewModel.php';
require_once 'viewmodels/BukuViewModel.php';
require_once 'viewmodels/KategoriViewModel.php';
require_once 'viewmodels/PeminjamanViewModel.php';

$entity = isset($_GET['entity']) ? $_GET['entity'] : 'anggota';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

if ($entity === 'anggota') {
    $anggotaVM = new AnggotaViewModel();

    switch ($action) {
        case 'list':
            $anggotaList = $anggotaVM->getAnggotaList();
            require_once 'views/anggota_list.php';
            break;
        case 'add':
            require_once 'views/anggota_form.php';
            break;
        case 'edit':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $anggota = $anggotaVM->getAnggotaById($id);
            require_once 'views/anggota_form.php';
            break;
        case 'save':
            $nama = $_POST['nama'] ?? '';
            $email = $_POST['email'] ?? '';
            $no_telepon = $_POST['no_telepon'] ?? '';
            $tanggal_daftar = $_POST['tanggal_daftar'] ?? date('Y-m-d');
            $status = $_POST['status'] ?? 'aktif';

            $data = [
                'nama' => $nama,
                'email' => $email,
                'no_telepon' => $no_telepon,
                'tanggal_daftar' => $tanggal_daftar,
                'status' => $status
            ];

            $anggotaVM->addAnggota($data);
            header('Location: index.php?entity=anggota&action=list');
            exit();
        case 'update':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $nama = $_POST['nama'] ?? '';
            $email = $_POST['email'] ?? '';
            $no_telepon = $_POST['no_telepon'] ?? '';
            $status = $_POST['status'] ?? 'aktif';

            $data = [
                'nama' => $nama,
                'email' => $email,
                'no_telepon' => $no_telepon,
                'status' => $status
            ];

            $anggotaVM->updateAnggota($id, $data);
            header('Location: index.php?entity=anggota&action=list');
            exit();

        case 'delete':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $anggotaVM->deleteAnggota($id);
            header('Location: index.php?entity=anggota&action=list');
            exit();

        default:
            echo "Invalid action.";
            break;
    }
} elseif ($entity === 'buku') {
    $bukuVM = new BukuViewModel();

    switch ($action) {
        case 'list':
            $bukuList = $bukuVM->getBukuList();
            require_once 'views/buku_list.php';
            break;
        case 'add':
            $kategoriList = $bukuVM->getKategoriList();
            require_once 'views/buku_form.php';
            break;
        case 'edit':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $buku = $bukuVM->getBukuById($id);
            $kategoriList = $bukuVM->getKategoriList();
            require_once 'views/buku_form.php';
            break;
        case 'save':
            $judul = $_POST['judul'] ?? '';
            $penulis = $_POST['penulis'] ?? '';
            $penerbit = $_POST['penerbit'] ?? '';
            $tahun_terbit = $_POST['tahun_terbit'] ?? date('Y');
            $stok = $_POST['stok'] ?? 1;
            $kategori_id = $_POST['kategori_id'] ?? null;

            $data = [
                'judul' => $judul,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun_terbit,
                'stok' => $stok,
                'kategori_id' => $kategori_id
            ];

            $bukuVM->addBuku($data);
            header('Location: index.php?entity=buku&action=list');
            exit();

        case 'update':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $judul = $_POST['judul'] ?? '';
            $penulis = $_POST['penulis'] ?? '';
            $penerbit = $_POST['penerbit'] ?? '';
            $tahun_terbit = $_POST['tahun_terbit'] ?? date('Y');
            $stok = $_POST['stok'] ?? 1;
            $kategori_id = $_POST['kategori_id'] ?? null;

            $data = [
                'judul' => $judul,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun_terbit,
                'stok' => $stok,
                'kategori_id' => $kategori_id
            ];

            $bukuVM->updateBuku($id, $data);
            header('Location: index.php?entity=buku&action=list');
            exit();

        case 'delete':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $bukuVM->deleteBuku($id);
            header('Location: index.php?entity=buku&action=list');
            exit();
        default:
            echo "Invalid action.";
            break;
    }
} elseif ($entity === 'kategori') {
    $kategoriVM = new KategoriViewModel();

    switch ($action) {
        case 'list':
            $kategoriList = $kategoriVM->getKategoriList();
            require_once 'views/kategori_list.php';
            break;
        case 'add':
            require_once 'views/kategori_form.php';
            break;
        case 'edit':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $kategori = $kategoriVM->getKategoriById($id);
            require_once 'views/kategori_form.php';
            break;
        case 'save':
            $nama_kategori = $_POST['nama_kategori'] ?? '';
            $deskripsi = $_POST['deskripsi'] ?? '';

            $data = [
                'nama_kategori' => $nama_kategori,
                'deskripsi' => $deskripsi
            ];

            $kategoriVM->addKategori($data);
            header('Location: index.php?entity=kategori&action=list');
            exit();

        case 'update':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $nama_kategori = $_POST['nama_kategori'] ?? '';
            $deskripsi = $_POST['deskripsi'] ?? '';

            $data = [
                'nama_kategori' => $nama_kategori,
                'deskripsi' => $deskripsi
            ];

            $kategoriVM->updateKategori($id, $data);
            header('Location: index.php?entity=kategori&action=list');
            exit();

        case 'delete':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $kategoriVM->deleteKategori($id);
            header('Location: index.php?entity=kategori&action=list');
            exit();

        default:
            echo "Invalid action.";
            break;
    }
} elseif ($entity === 'peminjaman') {
    $peminjamanVM = new PeminjamanViewModel();

    switch ($action) {
        case 'list':
            $peminjamanList = $peminjamanVM->getPeminjamanList();
            require_once 'views/peminjaman_list.php';
            break;

        case 'add':
            $anggotaList = $peminjamanVM->getAnggotaList();
            $bukuList = $peminjamanVM->getBukuList();
            require_once 'views/peminjaman_form.php';
            break;

        case 'edit':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $peminjaman = $peminjamanVM->getPeminjamanById($id);
            $anggotaList = $peminjamanVM->getAnggotaList();
            $bukuList = $peminjamanVM->getBukuList();
            require_once 'views/peminjaman_form.php';
            break;

        case 'save':
            // SIMPLE SAVE - TANPA ERROR HANDLING KOMPLEKS
            $anggota_id = $_POST['anggota_id'];
            $buku_id = $_POST['buku_id'];
            $tanggal_pinjam = $_POST['tanggal_pinjam'];

            // Tanggal kembali boleh kosong
            $tanggal_kembali = '';
            if (isset($_POST['tanggal_kembali']) && $_POST['tanggal_kembali'] != '') {
                $tanggal_kembali = $_POST['tanggal_kembali'];
            }

            $data = [
                'anggota_id' => $anggota_id,
                'buku_id' => $buku_id,
                'tanggal_pinjam' => $tanggal_pinjam,
                'tanggal_kembali' => $tanggal_kembali,
                'status' => 'dipinjam'
            ];

            // Simpan data
            $peminjamanVM->addPeminjaman($data);

            // Redirect ke list
            header('Location: index.php?entity=peminjaman&action=list');
            exit();

        case 'update':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $status = $_POST['status'];

            // Tanggal kembali untuk update
            $tanggal_kembali = '';
            if (isset($_POST['tanggal_kembali']) && $_POST['tanggal_kembali'] != '') {
                $tanggal_kembali = $_POST['tanggal_kembali'];
            }

            $peminjamanVM->updateStatusPeminjaman($id, $status, $tanggal_kembali);
            header('Location: index.php?entity=peminjaman&action=list');
            exit();

        case 'delete':
            if (!isset($_GET['id'])) {
                die('Error: ID tidak ditemukan');
            }
            $id = $_GET['id'];
            $peminjamanVM->deletePeminjaman($id);
            header('Location: index.php?entity=peminjaman&action=list');
            exit();

        default:
            echo "Invalid action.";
            break;
    }
} else {
    echo "Invalid entity. Entity yang valid: anggota, buku, kategori, peminjaman";
}