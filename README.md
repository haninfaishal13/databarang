## Tentang Aplikasi
Projek ini adalah sarana latihan untuk membuat sebuah aplikasi RestFul API menggunakan autentikasi Sanctum. Aplikasi ini memberikan fitur CRUD data barang yang dilindungi oleh autentikasi token Sanctum. 

## Requirement

- PHP 7.4.*
- PostgreSQL 14
- Composer

## Instalasi

- Clone Project
- Siapkan environment database, lalu jalankan `php artisan migrate` untuk migrasi database dan `php artisan db:seed` untuk seeding data
- Sebagai opsional, buat virtual host jika tidak ingin menjalankan `php artisan serve` saat ingin melakukan testing
