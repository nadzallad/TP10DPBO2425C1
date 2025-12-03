<?php require_once 'views/template/header.php'; ?>

<!-- Judul halaman daftar peminjaman -->
<h2>Daftar Peminjaman</h2>

<!-- Tombol untuk menambah data peminjaman baru -->
<a href="index.php?entity=peminjaman&action=add" class="btn btn-primary">Tambah Peminjaman</a>

<table>
    <thead>
        <tr>
            <!-- Header kolom anggota -->
            <th>Anggota</th>

            <!-- Header kolom buku -->
            <th>Buku</th>

            <!-- Header tanggal pinjam -->
            <th>Tanggal Pinjam</th>

            <!-- Header tanggal kembali -->
            <th>Tanggal Kembali</th>

            <!-- Header status peminjaman -->
            <th>Status</th>

            <!-- Header aksi -->
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

        <!-- Jika tidak ada data peminjaman -->
        <?php if (empty($peminjamanList)): ?>
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">
                    Tidak ada data peminjaman
                </td>
            </tr>

        <!-- Jika ada data peminjaman -->
        <?php else: ?>
            <?php foreach ($peminjamanList as $peminjaman): ?>
            <tr>

                <!-- Nama anggota -->
                <td><?php echo htmlspecialchars($peminjaman['nama_anggota']); ?></td>

                <!-- Judul buku -->
                <td><?php echo htmlspecialchars($peminjaman['judul_buku']); ?></td>

                <!-- Tanggal pinjam (format d-m-Y) -->
                <td><?php echo date('d-m-Y', strtotime($peminjaman['tanggal_pinjam'])); ?></td>

                <!-- Tanggal kembali (jika ada), jika tidak tampil '-' -->
                <td>
                    <?php echo $peminjaman['tanggal_kembali'] 
                        ? date('d-m-Y', strtotime($peminjaman['tanggal_kembali'])) 
                        : '-'; ?>
                </td>

                <!-- Status peminjaman dengan warna -->
                <td>
                    <?php 
                    // Menentukan warna dan teks berdasarkan status
                    $status_color = '';
                    $status_text = '';

                    if ($peminjaman['status'] == 'dipinjam') {
                        $status_color = 'orange';
                        $status_text = 'Dipinjam';
                    } elseif ($peminjaman['status'] == 'dikembalikan') {
                        $status_color = 'green';
                        $status_text = 'Dikembalikan';
                    } elseif ($peminjaman['status'] == 'terlambat') {
                        $status_color = 'red';
                        $status_text = 'Terlambat';
                    }
                    ?>

                    <!-- Tampilkan status dengan warna -->
                    <span style="color: <?php echo $status_color; ?>; font-weight: bold;">
                        <?php echo $status_text; ?>
                    </span>
                </td>

                <!-- Tombol aksi Edit & Hapus -->
                <td>
                    <!-- Tombol edit -->
                    <a href="index.php?entity=peminjaman&action=edit&id=<?php echo $peminjaman['id_peminjaman']; ?>" class="btn">
                        Edit
                    </a>

                    <!-- Tombol hapus dengan konfirmasi -->
                    <a href="index.php?entity=peminjaman&action=delete&id=<?php echo $peminjaman['id_peminjaman']; ?>" 
                       class="btn btn-danger" 
                       onclick="return confirm('Yakin hapus peminjaman ini?')">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once 'views/template/footer.php'; ?>
