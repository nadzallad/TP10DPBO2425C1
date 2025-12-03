<?php 
require_once 'views/template/header.php'; 
// Memanggil template header
?>

<h2>Daftar Kategori</h2>

<!-- Tombol tambah kategori baru -->
<a href="index.php?entity=kategori&action=add" class="btn btn-primary">Tambah Kategori</a>

<table>
    <thead>
        <tr>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($kategoriList as $kategori): ?>
        <!-- Loop menampilkan setiap kategori -->
        <tr>
            <!-- Menampilkan nama kategori -->
            <td><?php echo htmlspecialchars($kategori['nama_kategori']); ?></td>

            <!-- Menampilkan deskripsi atau tanda '-' jika kosong -->
            <td><?php echo htmlspecialchars($kategori['deskripsi'] ?? '-'); ?></td>

            <td>
                <!-- Tombol edit -->
                <a href="index.php?entity=kategori&action=edit&id=<?php echo $kategori['id_kategori']; ?>" 
                   class="btn">
                    Edit
                </a>

                <!-- Tombol delete dengan konfirmasi -->
                <a href="index.php?entity=kategori&action=delete&id=<?php echo $kategori['id_kategori']; ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Yakin hapus kategori ini?')">
                    Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>

<?php 
// Memanggil template footer
require_once 'views/template/footer.php'; 
?>
