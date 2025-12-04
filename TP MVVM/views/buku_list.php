<?php 
require_once 'views/template/header.php'; 
// Memanggil template header
?>

<h2>Daftar Buku</h2>

<!-- Tombol untuk menambah buku baru -->
<a href="index.php?entity=buku&action=add" class="btn btn-primary">Tambah Buku</a>

<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        // Loop menampilkan semua data buku
        foreach ($bukuList as $buku): 
        ?>
        <tr>
            <!-- Menampilkan judul buku -->
            <td><?php echo htmlspecialchars($buku['judul']); ?></td>

            <!-- Menampilkan penulis -->
            <td><?php echo htmlspecialchars($buku['penulis']); ?></td>

            <!-- Menampilkan penerbit, jika null tampil '-' -->
            <td><?php echo htmlspecialchars($buku['penerbit'] ?? '-'); ?></td>

            <!-- Tahun terbit -->
            <td><?php echo $buku['tahun_terbit']; ?></td>

            <!-- Stok buku -->
            <td><?php echo $buku['stok']; ?></td>

            <!-- Nama kategori, jika kosong tampil '-' -->
            <td><?php echo htmlspecialchars($buku['nama_kategori'] ?? '-'); ?></td>

            <!-- Tombol edit dan delete -->
            <td>
                <!-- Tombol edit buku -->
                <a href="index.php?entity=buku&action=edit&id=<?php echo $buku['id_buku']; ?>" class="btn">
                    Edit
                </a>

                <!-- Tombol hapus buku dengan konfirmasi -->
                <a href="index.php?entity=buku&action=delete&id=<?php echo $buku['id_buku']; ?>" 
                   class="btn btn-danger" 
                   onclick="return confirm('Yakin hapus buku ini?')">
                    Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
require_once 'views/template/footer.php'; 
// Memanggil template footer
?>
