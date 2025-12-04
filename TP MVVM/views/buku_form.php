<?php 
require_once 'views/template/header.php'; 
// Memanggil header template
?>

<h2>
    <?php 
    // Jika variabel $buku ada → mode edit, jika tidak → tambah baru
    echo isset($buku) ? 'Edit Buku' : 'Tambah Buku Baru'; 
    ?>
</h2>

<!-- Form untuk tambah atau edit buku -->
<form method="POST" action="index.php?entity=buku&action=<?php echo isset($buku) ? 'update&id=' . $buku['id_buku'] : 'save'; ?>">

    <!-- Input judul buku -->
    <label>Judul:</label>
    <input type="text" name="judul" value="<?php echo isset($buku) ? $buku['judul'] : ''; ?>" required>

    <!-- Input penulis -->
    <label>Penulis:</label>
    <input type="text" name="penulis" value="<?php echo isset($buku) ? $buku['penulis'] : ''; ?>" required>

    <!-- Input penerbit (boleh kosong) -->
    <label>Penerbit:</label>
    <input type="text" name="penerbit" value="<?php echo isset($buku) ? $buku['penerbit'] : ''; ?>">

    <!-- Input tahun terbit, default tahun sekarang -->
    <label>Tahun Terbit:</label>
    <input type="number" name="tahun_terbit" 
           value="<?php echo isset($buku) ? $buku['tahun_terbit'] : date('Y'); ?>" 
           min="1900" max="<?php echo date('Y'); ?>">

    <!-- Input stok, minimal 0 -->
    <label>Stok:</label>
    <input type="number" name="stok" value="<?php echo isset($buku) ? $buku['stok'] : 1; ?>" min="0">

    <!-- Dropdown kategori -->
    <label>Kategori:</label>
    <select name="kategori_id">
        <option value="">-- Pilih Kategori --</option>

        <?php 
        // Loop daftar kategori
        foreach ($kategoriList as $kategori): 
        ?>
            <option value="<?php echo $kategori['id_kategori']; ?>"
                <?php 
                // Jika sedang edit dan kategori sama → auto-selected
                echo (isset($buku) && $buku['kategori_id'] == $kategori['id_kategori']) ? 'selected' : ''; 
                ?>>
                <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Tombol simpan -->
    <button type="submit">Simpan</button>

    <!-- Tombol batal kembali ke list buku -->
    <a href="index.php?entity=buku&action=list" class="btn">Batal</a>
</form>

<?php 
// Memanggil footer template
require_once 'views/template/footer.php'; 
?>
