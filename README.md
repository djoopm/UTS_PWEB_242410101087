## Pengelolaan Buku Perpustakaan
### Layout Web :
<h2>Login</h2>
<div style="display: flex; gap: 20px;">
  <img src="assets/login_desktop.png" width="45%" alt="Login Desktop">
  <img src="assets/login_mobile.png" width="20%" alt="Login Mobile">
</div>

<h2>Dashboard</h2>
<div style="display: flex; gap: 20px;">
  <img src="assets/dashboard_desktop.png" width="45%" alt="Dashboard Desktop">
  <img src="assets/dashboard_mobile.png" width="20%" alt="Dashboard Mobile">
</div>

<h2>Profil</h2>
<div style="display: flex; gap: 20px;">
  <img src="assets/profile_desktop.png" width="45%" alt="Profil Desktop">
  <img src="assets/profile_mobile.png" width="20%" alt="Profil Mobile">
</div>

<h2>Pengelolaan</h2>
<div style="display: flex; gap: 20px;">
  <img src="assets/pengelolaan_desktop.png" width="45%" alt="Pengelolaan Desktop">
  <img src="assets/pengelolaan_mobile.png" width="20%" alt="Pengelolaan Mobile">
</div>

### Deskripsi :
<p style="text-align: justify;" >

Saya mengembangkan proyek UTS PWEB B yang berfokus pada alur penggunaan Controller dalam aplikasi web. Proses dimulai dari fitur login, di mana pengguna diminta memasukkan username. Sistem juga dilengkapi dengan validasi untuk menampilkan pesan error apabila username tidak diisi.

Selanjutnya, saya membuat fitur pengelolaan peminjaman buku yang terdiri dari halaman dashboard. Pada halaman ini ditampilkan data buku serta username pengguna yang sebelumnya diinput saat proses login. untuk isinya yaitu :
<ol>
    <li>Judul</li>
    <li>Pengarang</li>
    
</ol>
Untuk datanya ada dalam array di PageController.

<br>
Setelah itu ada Profil yang menampilkan username dari profil dan juga data array yaitu :
<ol>
    <li>Username</li>
    <li>Email</li>
    <li>Role</li>
    <li>Tahun Gabung</li>
</ol>

Lalu ada pengelolaan disini untuk melihat status buku dipinjam atau tersedia dan juga get data username dari login isi dari pengelolaan :
<ol>
    <li>Judul</li>
    <li>Pengarang</li>
    <li>Jenis</li>
    <li>Status</li>
</ol>

Terakhir ada logout setelah selesai user bisa logout dan semua sesi login atau username akan direset
</p>