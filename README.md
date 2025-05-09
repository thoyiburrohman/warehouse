# Warehouse Management System

Warehouse Management System ini adalah aplikasi berbasis web yang dibuat menggunakan Laravel. Aplikasi ini dirancang untuk membantu pengelolaan gudang, termasuk pengaturan data barang, kategori, supplier, transaksi masuk dan keluar barang, serta laporan.

## 📦 Fitur Utama

- Manajemen Data Barang
- Kategori Barang
- Supplier
- Transaksi Barang Masuk
- Transaksi Barang Keluar
- Laporan Stok
- Otentikasi dan Role Pengguna (Admin & Staff ( Area & SO ))

## 🚀 Teknologi yang Digunakan

- **Laravel 10**
- **Blade Template + Bootstrap**
- **MySQL** sebagai database
- **Laravel Herd** (local environment)


## ⚙️ Cara Instalasi

1. Clone repository:
   ```bash
   git clone https://github.com/thoyiburrohman/warehouse.git
   cd warehouse

2. Install dependensi PHP:
   ```bash
   composer install

3. Copy file .env dan generate key:
   ```bash
   cp .env.example .env
   php artisan key:generate

4. Sesuaikan konfigurasi database di .env lalu jalankan migrasi:
   ```bash
   php artisan migrate

5. Jalankan seeder jika tersedia:
   ```bash
   php artisan db:seed

6. Jalankan server lokal:
   ```bash
   php artisan serve

## 📌 Catatan
Proyek ini masih dalam tahap pengembangan. Beberapa fitur mungkin masih dalam proses penyempurnaan.

## 📃 Lisensi
Proyek ini adalah proyek pribadi dan tidak diizinkan untuk digunakan, disalin, atau dimodifikasi tanpa izin tertulis dari pemilik repository.
