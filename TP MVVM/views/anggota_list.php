<?php 
require_once 'views/template/header.php'; 
// Memanggil header template
?>

<h2>Daftar Anggota</h2>

<!-- Tombol menuju form tambah anggota -->
<a href="index.php?entity=anggota&action=add" class="btn btn-primary">Tambah Anggota</a>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Tanggal Daftar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        // Melakukan loop untuk menampilkan setiap anggota
        foreach ($anggotaList as $anggota): 
        ?>
        <tr>
            <!-- Menampilkan nama anggota -->
            <td><?php echo htmlspecialchars($anggota['nama']); ?></td>

            <!-- Menampilkan email anggota -->
            <td><?php echo htmlspecialchars($anggota['email']); ?></td>

            <!-- Telepon  -->
            <td><?php echo htmlspecialchars($anggota['no_telepon'] ?? '-'); ?></td>

            <!-- Menampilkan tanggal daftar -->
            <td><?php echo $anggota['tanggal_daftar']; ?></td>

            <td>
                <!-- Warna hijau untuk aktif, merah untuk nonaktif -->
                <span style="color: <?php echo $anggota['status'] == 'aktif' ? 'green' : 'red'; ?>">
                    <?php echo $anggota['status']; ?>
                </span>
            </td>

            <td>
                <!-- Tombol edit -->
                <a href="index.php?entity=anggota&action=edit&id=<?php echo $anggota['id_anggota']; ?>" 
                   class="btn">
                    Edit
                </a>

                <!-- Tombol delete dengan konfirmasi -->
                <a href="index.php?entity=anggota&action=delete&id=<?php echo $anggota['id_anggota']; ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Yakin hapus anggota ini?')">
                    Delete
                </a>
            </td>
        </tr>
        <?php endforeach; // Akhir loop ?>
    </tbody>
</table>

<?php 
require_once 'views/template/footer.php'; 
// Memanggil footer template
?>
