# Laravel Project

Ini adalah project Laravel yang berfungsi untuk perusahaan penerbit buku memanage buku-buku yang mereka terbitkan secara sederhana

## Prasyarat
- PHP >= 8.2 (karena laravel 11)
- Composer
- MySQL atau database lain yang kompatibel

## Cara Instalasi

1. Clone repository ini:

Buka git bash lalu tulis code dibawah ini:
git clone https://github.com/username/laravel-project.git](https://github.com/setya433/Buku_penerbit
cd laravel-project

2. buat database dengan nama buku
   masuk ke phpmyadmin lalu buat database dengan nama buku.
    
3. Jalankan konfigurasi .env lalu jalankan composer
   ubah difile .env.example menjadi .env lalu setting seperti dibawah ini(jangan menghapus sytax lainnya):
   <p>DB_CONNECTION=mysql</p>
    <p>DB_HOST=127.0.0.1</p>
    <p>DB_PORT=3306</p>
    <p>DB_DATABASE=buku</p>
    <p>DB_USERNAME=root</p>
    <p>DB_PASSWORD=</p>

   lalu jalankan <b>composer install</b> dan <b>composer update</b> diterminal

   jangan lupa untuk menjalankan <b>php artisan generate:key</b>

5. Buka Xampp Atau laragon
   jalankankan apache server dan mysql server

6. jalankan semua syntax dibawah ini menggunakan terminal ataupun CMD
   # copy and paste:
       - php artisan migrate
       - php artisan storage:link
       - php artisan db:seed
       - php artisan serve
  
8. paste link/ip yang anda dapat
    setelah menjalankan syntax
   - php artidan serve
     maka kita akan mendapatkan link atau ip seperti berikut    http://127.0.0.1:8000/   (link dapat berubah-ubah sesuai port yang digunakan).

# AKUN untuk Login
username :
    - herlambang
    <p>- putri </p>
    <p>- hilmi </p>
    <p>- admin </p>
password: <b>password123</b>

