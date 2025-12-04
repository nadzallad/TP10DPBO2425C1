<?php
require_once 'views/template/header.php'; 
// Memanggil header template
?>

<h2>
    <?php 
    // Jika ada data $anggota → mode edit, kalau tidak → tambah baru
    echo isset($anggota) ? 'Edit Anggota' : 'Tambah Anggota Baru'; 
    ?>
</h2>

<form method="POST" 
      action="index.php?entity=anggota&action=<?php 
        // Menentukan action form (update atau save)
        echo isset($anggota) ? 'update&id=' . $anggota['id_anggota'] : 'save'; 
      ?>">
    
    <div>
        <label>Nama:</label>
        <!-- Input nama anggota -->
        <input type="text" name="nama" 
               value="<?php echo isset($anggota) ? $anggota['nama'] : ''; ?>" 
               required>
    </div>

    <div>
        <label>Email:</label>
        <!-- Input email anggota -->
        <input type="email" name="email" 
               value="<?php echo isset($anggota) ? $anggota['email'] : ''; ?>" 
               required>
    </div>

    <div>
        <label>Telepon:</label>
        <!-- Input nomor telepon -->
        <input type="text" name="no_telepon" 
               value="<?php echo isset($anggota) ? $anggota['no_telepon'] : ''; ?>">
    </div>

    <div>
        <label>Tanggal Daftar:</label>
        <!-- Tanggal daftar default hari ini jika tambah baru -->
        <input type="date" name="tanggal_daftar" 
               value="<?php echo isset($anggota) ? $anggota['tanggal_daftar'] : date('Y-m-d'); ?>">
    </div>

    <div>
        <label>Status:</label>
        <!-- Status anggota: aktif / nonaktif -->
        <select name="status">
            <option value="aktif" 
                <?php echo (isset($anggota) && $anggota['status'] == 'aktif') ? 'selected' : ''; ?>>
                Aktif
            </option>
            <option value="nonaktif" 
                <?php echo (isset($anggota) && $anggota['status'] == 'nonaktif') ? 'selected' : ''; ?>>
                Nonaktif
            </option>
        </select>
    </div>

    <!-- Tombol submit -->
    <button type="submit">Simpan</button>

    <!-- Tombol batal kembali ke list -->
    <a href="index.php?entity=anggota&action=list">Batal</a>
</form>

<?php
// Memanggil footer template
require_once 'views/template/footer.php'; 
?>
