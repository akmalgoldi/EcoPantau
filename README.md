# EcoPantau – Sistem Pemantauan Sampah RT/RW

EcoPantau adalah sebuah aplikasi berbasis web sederhana yang dirancang untuk mengatasi permasalahan penumpukan sampah liar di lingkungan Rukun Tetangga (RT) dan Rukun Warga (RW). Sistem ini memfasilitasi komunikasi dan koordinasi antara warga sebagai pelapor dan pengurus RT/RW sebagai pihak yang bertanggung jawab atas penanganan sampah.

## 🎯 Tujuan Proyek

* Menyediakan platform yang mudah diakses bagi warga untuk melaporkan lokasi dan deskripsi tumpukan sampah liar, dilengkapi dengan foto.
* Meningkatkan efisiensi dan efektivitas pengurus RT/RW dalam memantau, mengelola, dan menindaklanjuti laporan sampah secara terpusat dan *real-time*.
* Meningkatkan transparansi status penanganan laporan sampah kepada warga pelapor.
* Mendorong partisipasi aktif masyarakat dalam menjaga kebersihan lingkungan.

## ✨ Fitur Utama

**Untuk Warga (User):**
* **Registrasi & Login Akun:** Membuat dan mengakses akun pengguna.
* **Buat Laporan Sampah:** Mengisi form laporan dengan lokasi, deskripsi, dan melampirkan foto.
* **Pantau Status Laporan:** Melihat status laporan yang dibuat (Baru, Diproses, Selesai).
* **Riwayat Laporan:** Melihat daftar semua laporan yang pernah dibuat.
* **Manajemen Profil:** Mengedit informasi profil pribadi (nama, email, password).

**Untuk Admin RT:**
* **Login Akun:** Mengakses panel administrasi.
* **Manajemen Laporan:** Melihat daftar semua laporan masuk, melihat detail, mengubah status laporan, dan menambahkan catatan penanganan.
* **Dashboard Statistik:** Melihat ringkasan data laporan (jumlah per status) dalam format angka dan grafik.
* **Manajemen Pengguna:** Melihat daftar pengguna terdaftar, melihat detail profil, mengedit peran, dan menghapus pengguna.
* **Manajemen Profil:** Mengedit informasi profil admin sendiri.

## 💻 Teknologi yang Digunakan

🛠️ Teknologi yang Digunakan

* Backend: Laravel 11
* Frontend: Blade + Bootstrap 5 + Sass (SCSS)
* Database: MySQL
* Authentication: Laravel UI
* Version Control:
    * Git
    * GitHub (Hosting Repositori)

## 🚀 Panduan Instalasi Lokal (Untuk Developer)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek EcoPantau di lingkungan lokal Anda:

### Prasyarat

* PHP 8.x
* Composer
* Node.js & npm (Node Package Manager)
* MySQL Server
* Lingkungan server lokal seperti Laragon, XAMPP, WAMP, atau MAMP.

### Langkah-langkah Instalasi

1.  **Clone repositori:**
    ```bash
    git clone [https://github.com/akmalgoldi/EcoPantau.git](https://github.com/akmalgoldi/EcoPantau.git)
    cd EcoPantau
    ```

2.  **Instal dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment:**
    Buat salinan file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
    Buat kunci aplikasi:
    ```bash
    php artisan key:generate
    ```

4.  **Konfigurasi Database di `.env`:**
    Buka file `.env` dan sesuaikan detail koneksi database Anda:
    ```dotenv
    DB_DATABASE=ecopantau_db 
    DB_USERNAME=root         
    DB_PASSWORD=             
    ```

5.  **Jalankan Migrasi Database dan Seed Data:**
    Ini akan membuat tabel-tabel database dan mengisi data awal (roles, report statuses).
    ```bash
    php artisan migrate --seed
    ```

6.  **Instal dependensi Node.js:**
    ```bash
    npm install
    ```

7.  **Kompilasi Aset Frontend (CSS & JavaScript):**
    ```bash
    npm run dev
    ```
    (Biarkan perintah ini berjalan di terminal terpisah selama pengembangan)

8.  **Buat Symlink untuk Storage (untuk upload foto):**
    ```bash
    php artisan storage:link
    ```

9.  **Jalankan Server Laravel:**
    Buka terminal lain dan jalankan server pengembangan Laravel:
    ```bash
    php artisan serve
    ```

Aplikasi sekarang dapat diakses melalui `http://localhost:8000` (atau port lain yang ditampilkan oleh `php artisan serve`).

## 🤝 Kontributor Tim

Berikut adalah anggota tim yang berkontribusi pada proyek EcoPantau:

* **Akmal Goldi Bazarghan**
* **M.Alan Daulay** 
* **Muhammad Dzaky Danarta** 
* **Muhammad Yusran Abdullah** 

---
