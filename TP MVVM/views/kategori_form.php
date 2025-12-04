<?php 
require_once 'views/template/header.php'; 
// Memanggil template header
?>

<!-- Judul halaman: berubah sesuai mode edit atau tambah -->
<h2><?php echo isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori Baru'; ?></h2>

<!-- Form tambah atau update kategori -->
<form method="POST" 
      action="index.php?entity=kategori&action=<?php echo isset($kategori) 
          ? 'update&id=' . $kategori['id_kategori']   // Jika edit
          : 'save';                                   // Jika tambah baru
      ?>">

    <!-- Input nama kategori -->
    <label>Nama Kategori:</label>
    <input type="text" name="nama_kategori" 
           value="<?php echo isset($kategori) ? $kategori['nama_kategori'] : ''; ?>" 
           required>

    <!-- Input deskripsi kategori -->
    <label>Deskripsi:</label>
    <textarea name="deskripsi" rows="4"><?php 
        echo isset($kategori) ? $kategori['deskripsi'] : ''; 
    ?></textarea>

    <!-- Tombol simpan -->
    <button type="submit">Simpan</button>

    <!-- Tombol batal kembali ke daftar kategori -->
    <a href="index.php?entity=kategori&action=list" class="btn">Batal</a>
</form>

<?php 
require_once 'views/template/footer.php'; 
// Memanggil template footer
?>
