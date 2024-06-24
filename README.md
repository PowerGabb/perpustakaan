# Laravel Perpustakaan UKK



Sebuah aplikasi web yang memfasilitasi peminjaman buku secara digital dengan integrasi database dan berbagai fitur yang mempermudah penggunaan.

## Daftar Isi

- [Cara Install](#cara-install)
- [Fitur](#fitur)
- [Tugas Kalian](#tugas-kalian)

## Cara Install

Berikut adalah langkah-langkah untuk menginstal dan menjalankan aplikasi:

1. Lakukan git clone repository ini:

    ```bash
    [git clone https://github.com/PowerGabb/perpustakaan-yasfat.git]
    ```

2. Pindah ke dalam folder yang telah di-clone:

    ```bash
    cd perpustakaan-yasfat
    ```

3. Buka terminal di folder tersebut dan jalankan:

    ```bash
    composer install
    ```

4. Setelah itu, jalankan:

    ```bash
    php artisan key:generate
    ```

5. Setelah itu, jalankan:

    ```bash
    npm install
    ```
6. Setelah itu, jalankan:

    ```bash
    npm run build
    ```

7. Buat database dan setup file `.env` dengan mengisi informasi yang diperlukan:

    ```bash
    cp .env
    ```

    Sesuaikan informasi database pada file `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=nama_pengguna_database
    DB_PASSWORD=sandi_database
    ```

8. Lakukan migration dan seeding:

    ```bash
    php artisan migrate:fresh
    ```

9. Buat symbolic link untuk storage:

    ```bash
    php artisan storage:link
    ```

## Fitur

- Login Register 
- 4 Role Administrator, Petugas, Peminjam, Guest
- Batas Meminjam 3 Hari
- Register Memerlukan Izin Admin atau petugas

## Tugas Kalian

- Buat 3 Akun Dan Setting Di Database Setiap rolenya admin, siswa, menunggu aktivasi
- coba pinjem buku pake akun siswa
- izinin pinjem buku pake akun admin
- pinjemin buku lewat fitur admin
- aktivasi user lewat admin
- coba tambah tambahin buku, categories dll sampe bisa nambahin buku
- pastiin gada masalah
- kalo ada yg ga rapih coba chat di gtub
- jangan lupa coba balikin buku

