# Aplikasi Pembayaran Listrik Pascabayar

Ini adalah aplikasi web yang dibangun untuk mensimulasikan alur pembayaran listrik pascabayar. Aplikasi ini memisahkan peran antara **Admin** yang mengelola data dan **Pelanggan** yang melakukan pembayaran. Proyek ini dibuat menggunakan Laravel Framework.

## 📝 Fitur Utama

Aplikasi ini memiliki beberapa fitur utama:

  * **Sistem Multi-Autentikasi**: Membedakan hak akses dan alur kerja antara Admin dan Pelanggan.
  * **Manajemen Penggunaan (Admin)**: Admin dapat melakukan operasi CRUD (Create, Read, Update, Delete) untuk data penggunaan meteran listrik setiap pelanggan.
  * **Pembuatan Tagihan Otomatis**: Setiap kali data penggunaan baru ditambahkan, sistem secara otomatis menghitung dan membuat tagihan untuk pelanggan.
  * **Alur Pembayaran Pelanggan**:
      * Pelanggan dapat melihat riwayat tagihan mereka.
      * Memilih metode pembayaran yang diinginkan (Bank Transfer, E-Wallet).
      * Mengunggah bukti pembayaran untuk verifikasi.
  * **Konfirmasi Pembayaran (Admin)**: Admin memiliki halaman khusus untuk melihat bukti bayar dan mengkonfirmasi tagihan untuk mengubah statusnya menjadi "Lunas".

## 🚀 Teknologi yang Digunakan

  * **[Laravel](https://laravel.com/)**: Framework PHP utama yang digunakan.
  * **[Bootstrap](https://getbootstrap.com/)**: Framework CSS untuk desain antarmuka.
  * **MySQL**: Database untuk menyimpan semua data aplikasi.
  * **Vite/Laravel Mix**: Untuk kompilasi aset CSS dan JavaScript.

## ⚙️ Cara Instalasi dan Setup

Untuk menjalankan proyek ini di lingkungan lokal, ikuti langkah-langkah berikut:

1.  **Clone repository**
    ```sh
    git clone https://github.com/NamaAnda/aplikasi-pembayaran-listrik.git
    cd aplikasi-pembayaran-listrik
    ```
2.  **Instal Dependensi PHP**
    ```sh
    composer install
    ```
3.  **Instal Dependensi JavaScript**
    ```sh
    npm install
    ```
4.  **Buat file `.env`**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
    ```sh
    cp .env.example .env
    ```
5.  **Generate Application Key**
    ```sh
    php artisan key:generate
    ```
6.  **Jalankan Migrasi dan Seeder**
    Perintah ini akan membuat semua tabel dan mengisi data awal (akun admin & pelanggan).
    ```sh
    php artisan migrate:fresh --seed
    ```
7.  **Buat Symbolic Link untuk Storage**
    ```sh
    php artisan storage:link
    ```
8.  **Jalankan Server**
      * Jalankan server aplikasi: `php artisan serve`
      * Di terminal lain, jalankan server aset: `npm run dev`

## 👨‍💻 Cara Menggunakan

Aplikasi memiliki dua peran dengan akun demo yang sudah dibuat oleh *seeder*:

#### **Akun Admin**

  * **Username**: `admin`
  * **Password**: `adminpassword`
  * **Akses**: Dapat mengelola data penggunaan dan mengkonfirmasi pembayaran.

#### **Akun Pelanggan**

  * **Username**: `jamal` 
  * **Password**: `jamal123`
  * **Akses**: Dapat melihat dan membayar tagihan.
