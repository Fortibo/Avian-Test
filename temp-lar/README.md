# Manufacturing Dashboard

Web application untuk monitoring aktivitas produksi dan work order pada environment manufacturing.

## Tech Stack

- Laravel
- PHP 8.3
- MySQL/MariaDB
- Blade
- Tailwind CSS
- Chart.js
- Docker
- Nginx

## Features

### Dashboard

Dashboard menampilkan:

- Total machine
- Running work order
- Finished work order
- Production achievement
- Good quantity
- Reject quantity
- Production trend 7 hari
- Work order status breakdown
- Top 10 machine performance

### Production Orders

Halaman Production Orders menyediakan:

- Daftar work order
- Search berdasarkan WO number dan product
- Filter product
- Filter machine
- Filter employee
- Filter status
- Filter tanggal
- Sorting
- Pagination
- Query parameter

### Production Result

Form Production Result menyediakan:

- Work order selection
- Good quantity
- Reject quantity
- Production date
- Runtime
- Validation
- Perhitungan achievement

## Requirements

Pastikan komputer sudah memiliki:

- Docker Desktop
- Docker Compose

Tidak diperlukan instalasi PHP, Composer, MySQL, atau Nginx secara manual jika menggunakan Docker.

## Installation

### 1. Clone repository

```bash
git clone <REPOSITORY_URL>
cd <PROJECT_DIRECTORY>
```

### 2. Copy environment file

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

### 3. Build dan jalankan Docker

```bash
docker compose up -d --build
```

Docker akan menjalankan:

- Laravel/PHP
- Nginx
- MariaDB

Database `manufacturing_test` akan otomatis dibuat dan dataset akan di-import dari:

```text
database/manufacturing_test.sql
```

### 4. Generate application key

Jika `APP_KEY` masih kosong:

```bash
docker compose exec app php artisan key:generate
```

### 5. Clear Laravel cache

```bash
docker compose exec app php artisan config:clear
docker compose exec app php artisan view:clear
```

> Jangan menjalankan `php artisan migrate:fresh` karena aplikasi menggunakan dataset `manufacturing_test` yang telah disediakan.

## Access Application

Setelah container berjalan, buka:

```text
http://localhost:8000
```

## Database

Database yang digunakan:

```text
Database : manufacturing_test
Host     : db
Port     : 3306
Username : laravel
Password : laravel
```

Database terdiri dari:

- employee
- machine
- product
- work_order
- production_result
- downtime
- maintenance
- inventory_transaction

## API

### Dashboard

```text
GET /api/dashboard
```

Mengembalikan summary dashboard, production trend, status breakdown, dan top machine performance.

### Production Orders

```text
GET /api/production/orders
```

Mendukung query parameter untuk search, filtering, sorting, dan pagination.

Contoh:

```text
/api/production/orders?page=2&search=WO2026&status=FINISHED
```

### Production Result

```text
POST /api/production
```

Digunakan untuk menambahkan production result.

## Important Notes

Tanggal dashboard menggunakan tanggal produksi terbaru yang tersedia pada dataset, yaitu berdasarkan:

```text
MAX(production_result.actual_start)
```

bukan tanggal server (`CURDATE()`).

Dengan demikian hasil dashboard tetap konsisten ketika aplikasi dijalankan pada waktu yang berbeda.

## Stopping Application

Untuk menghentikan container:

```bash
docker compose down
```

Untuk menjalankan kembali:

```bash
docker compose up -d
```

## Database Reset

Jika database Docker perlu dibuat ulang dari file SQL:

```bash
docker compose down -v
docker compose up -d --build
```

> Perintah `down -v` akan menghapus volume database Docker. Jangan gunakan jika ingin mempertahankan data yang sedang tersimpan.
