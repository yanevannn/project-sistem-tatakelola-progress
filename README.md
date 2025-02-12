# Sistem Informasi Tata Kelola UKM

Sistem ini dikembangkan menggunakan Laravel 11 dan MySQL sebagai basis data. Proyek ini dibuat sebagai bagian dari tugas akhir skripsi.

## Teknologi yang Digunakan
- **Framework:** Laravel 11
- **Database:** MySQL
- **Web Server:** Nginx

## Persyaratan Sistem
- PHP 8.3 atau lebih baru
- Composer
- MySQL
- Node.js & NPM (untuk frontend jika diperlukan)
- Web server Nginx

## Instalasi
1. Clone repository ini:
   ```bash
   git clone https://github.com/username/sistem-ukm.git
   cd sistem-ukm
   ```

2. Instal dependensi dengan Composer:
   ```bash
   composer install
   ```

3. Duplikat file `.env.example` dan ubah namanya menjadi `.env`:
   ```bash
   cp .env.example .env
   ```

4. Konfigurasi database pada file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sita
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Jalankan migrasi database:
   ```bash
   php artisan migrate --seed
   ```

6. Generate application key:
   ```bash
   php artisan key:generate
   ```

7. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

## Kontribusi
Jika ingin berkontribusi, silakan buat pull request atau hubungi saya melalui email.

## Lisensi
Proyek ini dilindungi oleh lisensi MIT.

---

**Penulis:** Evan
**Tahun:** 2025

