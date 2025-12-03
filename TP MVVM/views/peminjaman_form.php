<?php require_once 'views/template/header.php'; ?>

<!-- Judul halaman daftar kategori -->
<h2>Daftar Kategori</h2>

<!-- Tombol menuju halaman tambah kategori -->
<a href="index.php?entity=kategori&action=add" class="btn btn-primary">Tambah Kategori</a>

<table>
    <thead>
        <tr>
            <!-- Header nama kategori -->
            <th>Nama Kategori</th>

            <!-- Header deskripsi kategori -->
            <th>Deskripsi</th>

            <!-- Header kolom aksi -->
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loop untuk menampilkan semua kategori -->
        <?php foreach ($kategoriList as $kategori): ?>
        <tr>
            <!-- Nama kategori -->
            <td><?php echo htmlspecialchars($kategori['nama_kategori']); ?></td>

            <!-- Deskripsi kategori, jika kosong tampil '-' -->
            <td><?php echo htmlspecialchars($kategori['deskripsi'] ?? '-'); ?></td>

            <!-- Tombol Edit & Delete -->
            <td>
                <!-- Tombol edit kategori -->
                <a href="index.php?entity=kategori&action=edit&id=<?php echo $kategori['id_kategori']; ?>" class="btn">Edit</a>

                <!-- Tombol hapus kategori dengan konfirmasi -->
                <a href="index.php?entity=kategori&action=delete&id=<?php echo $kategori['id_kategori']; ?>" 
                   class="btn btn-danger" 
                   onclick="return confirm('Yakin hapus kategori ini?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'views/template/footer.php'; ?>
