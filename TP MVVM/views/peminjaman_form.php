<?php require_once 'views/template/header.php'; ?>

<h2><?php echo isset($peminjaman) ? 'Edit Peminjaman' : 'Tambah Peminjaman Baru'; ?></h2>

<form method="POST" action="index.php?entity=peminjaman&action=<?php echo isset($peminjaman) ? 'update&id=' . $peminjaman['id_peminjaman'] : 'save'; ?>">
    
    <div style="margin-bottom: 15px;">
        <label>Anggota:</label>
        <select name="anggota_id" required style="width: 100%; padding: 8px;">
            <option value="">-- Pilih Anggota --</option>
            <?php foreach ($anggotaList as $anggota): ?>
                <option value="<?php echo $anggota['id_anggota']; ?>"
                    <?php echo (isset($peminjaman) && $peminjaman['anggota_id'] == $anggota['id_anggota']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($anggota['nama']); ?>
                    <?php if ($anggota['status'] != 'aktif'): ?>
                        (<?php echo ucfirst($anggota['status']); ?>)
                    <?php endif; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div style="margin-bottom: 15px;">
        <label>Buku:</label>
        <select name="buku_id" required style="width: 100%; padding: 8px;">
            <option value="">-- Pilih Buku --</option>
            <?php foreach ($bukuList as $buku): ?>
                <option value="<?php echo $buku['id_buku']; ?>"
                    <?php echo (isset($peminjaman) && $peminjaman['buku_id'] == $buku['id_buku']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($buku['judul']); ?>
                    (Stok: <?php echo $buku['stok']; ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div style="margin-bottom: 15px;">
        <label>Tanggal Pinjam:</label>
        <input type="date" name="tanggal_pinjam" 
               value="<?php echo isset($peminjaman) ? $peminjaman['tanggal_pinjam'] : date('Y-m-d'); ?>" 
               style="width: 100%; padding: 8px;" required>
    </div>
    
    <div style="margin-bottom: 15px;">
        <label>Tanggal Kembali:</label>
        <input type="date" name="tanggal_kembali" 
               value="<?php 
                   if (isset($peminjaman) && !empty($peminjaman['tanggal_kembali'])) {
                       echo $peminjaman['tanggal_kembali'];
                   } else {
                       echo '';
                   }
               ?>"
               style="width: 100%; padding: 8px;">
        <small style="color: #666;">Isi tanggal perkiraan pengembalian (bisa dikosongkan)</small>
    </div>
    
    <?php if (isset($peminjaman)): ?>
        <div style="margin-bottom: 15px;">
            <label>Status:</label>
            <select name="status" style="width: 100%; padding: 8px;">
                <option value="dipinjam" <?php echo ($peminjaman['status'] == 'dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
                <option value="dikembalikan" <?php echo ($peminjaman['status'] == 'dikembalikan') ? 'selected' : ''; ?>>Dikembalikan</option>
            </select>
        </div>
    <?php endif; ?>
    
    <div style="margin-top: 20px;">
        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            Simpan
        </button>
        <a href="index.php?entity=peminjaman&action=list" class="btn" style="margin-left: 10px;">Batal</a>
    </div>
</form>

<?php require_once 'views/template/footer.php'; ?>