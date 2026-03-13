# Instruksi Setup Project (Pertama Kali Clone)

Dokumen ini untuk developer yang baru pertama kali clone project ini.

## 1. Prasyarat

Pastikan tools berikut sudah terpasang:

1. PHP 8.2 atau lebih baru
2. Composer terbaru
3. Node.js 20+ dan npm
4. Git

Cara cek versi cepat:

- php -v
- composer -V
- node -v
- npm -v

## 2. Clone Repository

Jika belum clone:

1. git clone https://github.com/Bebek-Goreng-Haji-Slamet/lomba-pikmi.git
2. cd lomba-pikmi

## 3. Setup Cepat (Direkomendasikan)

Jalankan 1 perintah ini dari root project:

- composer run setup

Perintah di atas otomatis menjalankan:

1. install dependency PHP
2. copy .env dari .env.example (kalau belum ada)
3. generate APP_KEY
4. migrate database
5. install dependency frontend
6. build asset frontend

## 4. Setup Manual (Kalau Tidak Pakai Setup Cepat)

Jalankan berurutan:

1. composer install
2. copy .env.example .env
3. php artisan key:generate
4. php artisan migrate --seed
5. npm install
6. npm run build

Catatan Windows PowerShell:

- Jika perintah copy gagal, pakai: Copy-Item .env.example .env

## 5. Jalankan Project

### Opsi A - Sekali jalan semua service (direkomendasikan)

- composer run dev

Ini akan menjalankan:

1. Laravel server
2. queue listener
3. log watcher
4. Vite dev server

### Opsi B - Manual 2 terminal

Terminal 1:

- php artisan serve

Terminal 2:

- npm run dev

## 6. Akun Default Seeder

Setelah php artisan migrate --seed atau php artisan migrate:fresh --seed:

1. Admin
	Email: admin@sharemeal.test
	Password: password123
2. Donator
	Email: donator@sharemeal.test
	Password: password123

## 7. Menjalankan Test

- php artisan test

## 8. Troubleshooting Singkat

1. Error APP_KEY missing
	Jalankan: php artisan key:generate

2. Error database not found
	Pastikan file database/database.sqlite ada. Jika tidak ada, buat file kosong lalu jalankan migrate:
	php artisan migrate --seed

3. Asset tidak muncul
	Jalankan ulang:
	npm install
	npm run build

4. Ingin reset data ke kondisi awal
	Jalankan:
	php artisan migrate:fresh --seed

Selesai. Setelah setup berhasil, buka URL yang muncul dari php artisan serve (biasanya http://127.0.0.1:8000).
