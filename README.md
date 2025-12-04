// Janji

Saya Nadzalla Diva Asmara Sutedja dengan Nim 2408095 mengerjakan Tugas Praktikum  10 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan

// Desain Program 

<img width="949" height="787" alt="image" src="https://github.com/user-attachments/assets/04d656ab-8fd3-41ff-a6b0-8bb6806cd5a2" />


Folder Config berisi konfigurasi yang mengatur pengaturan dasar aplikasi seperti koneksi database diperlukan untuk menjalankan website dengan benar. File Database.php dalam folder ini khusus menangani pembuatan dan pengelolaan koneksi ke database MySQL.

Folder Database menyimpan SQL yang berisi skema database lengkap termasuk struktur tabel, relasi antar tabel, dan data awal yang diperlukan. File db_library.sql di sini bisa langsung diimpor ke MySQL untuk membuat database dengan semua tabel yang dibutuhkan yaitu tabel anggota, buku, kategori, dan peminjaman beserta hubungan antar tabelnya.

Folder Model berisi kelas-kelas yang bertanggung jawab langsung berinteraksi dengan database. Setiap kelas Model seperti Anggota.php, Buku.php, Kategori.php dan Peminjaman.php menangani operasi CRUD (Create, Read, Update, Delete) untuk  masing-masing. Mereka menjalankan query SQL, menangani database, dan mengembalikan data dalam format yang siap diproses.

Folder ViewModels berisi kelas-kelas yang menjadi penghubung antara Model dan Views. ViewModel menerima permintaan dari antarmuka pengguna, memproses logika kemudian memanggil Model yang sesuai untuk operasi database. Setelah data diproses, ViewModel menyiapkannya dalam format yang mudah ditampilkan di View.

Folder Views berisi file-file template yang menampilkan antarmuka pengguna. Setiap file seperti anggota_list.php, buku_form.php, atau peminjaman_form.php hanya fokus pada presentasi data dengan HTML, CSS sederhana, dan looping PHP untuk menampilkan data yang diterima dari ViewModel. Views tidak berinteraksi langsung dengan database.

File index.php berfungsi sebagai router utama yang menerima semua permintaan HTTP. Berdasarkan parameter entity dan action di URL, index.php menentukan ViewModel mana yang harus dipanggil dan View mana yang harus ditampilkan. File ini mengatur alur dan hanya mengarahkan permintaan ke komponen yang tepat.

// Alur Program 

1. Dimulai ketika pengguna mengakses website melalui browser. File index.php menjadi titik masuk pertama yang membaca parameter URL untuk menentukan apa yang harus ditampilkan. Parameter utama ada dua: entity menentukan modul (anggota, buku, kategori, atau peminjaman), dan action menentukan aksi (lihat daftar, tambah, edit, simpan, hapus).

2. Misalnya pengguna klik menu "Tambah Peminjaman", browser akan membuka URL dengan parameter entity=peminjaman dan action=add. Index.php menerima parameter ini, membuat objek PeminjamanViewModel, dan memanggil method yang sesuai.

3. ViewModel kemudian bekerja untuk menyiapkan data yang dibutuhkan form. Ia memanggil Model Anggota untuk mengambil daftar anggota, dan Model Buku untuk mengambil daftar buku. Data ini dikembalikan ke index.php yang kemudian memuat file View peminjaman_form.php.

4. Di browser, pengguna melihat form dengan dropdown pilihan anggota dan buku, serta field tanggal. Setelah mengisi form dan klik "Simpan", data dikirim kembali ke server dengan parameter action=save.

5. Index.php menerima data POST dan memanggil method save pada PeminjamanViewModel. ViewModel ini melakukan validasi data, memastikan semua field terisi, lalu memanggil Model Peminjaman untuk menyimpan data ke database. Setelah penyimpanan berhasil, index.php mengarahkan pengguna kembali ke halaman daftar peminjaman.

6. Untuk menampilkan daftar peminjaman, index.php dengan parameter action=list memanggil ViewModel yang kemudian meminta data dari Model. Model mengambil data dari database, ViewModel mengolahnya, dan View menampilkan dalam format tabel HTML.

7. View hanya bertugas menampilkan data dalam format HTML, tidak melakukan logika bisnis atau akses database. ViewModel menangani semua logika dan aturan bisnis. Model khusus berinteraksi dengan database. Index.php sebagai pengatur alur yang menghubungkan semua komponen.

8. Struktur ini berlaku sama untuk semua modul. Untuk anggota, buku, dan kategori, alurnya identik: index.php terima request, panggil ViewModel sesuai entity, ViewModel proses logika, panggil Model untuk akses data, lalu View tampilkan hasilnya. File konfigurasi di folder Config menyimpan setting koneksi database yang digunakan oleh semua Model, sementara folder Database berisi script SQL untuk membuat struktur database awal.


// Dokumentasi 

1. Dokumentasi CRUD tabel Kategori

https://github.com/user-attachments/assets/33536d83-9e5c-46d6-affe-a9371cc98d0e

2. Dokumentasi CRUD tabel Buku
   

https://github.com/user-attachments/assets/6e29df41-02a6-417b-af1c-ade6e228b99d

3. Dokumentasi CRUD tabel Anggota

https://github.com/user-attachments/assets/32e977af-2608-4f71-b85d-81f9247f751e

4. Dokumentasi CRUD tabel Peminjaman

https://github.com/user-attachments/assets/d06945aa-6281-4427-aca5-15856c2aeba8




   


