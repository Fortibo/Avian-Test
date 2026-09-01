# Manufacturing Dashboard

## Requirements

Pastikan sudah terinstall:

- Git
- Docker Desktop
- Docker Compose

Tidak diperlukan instalasi PHP, Composer, MySQL/MariaDB, Node.js, atau Nginx secara manual.

## Instalasi

### 1. Clone Repo

```bash
git clone https://github.com/Fortibo/Avian-Test.git
cd Avian-Test
cd temp-lar
```

### 2. Setup Env

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

Pastikan konfigurasi database pada `.env` menggunakan konfigurasi Docker berikut:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=manufacturing_test
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

### 3. Build and Run Docker

```bash
docker-compose up -d --build
```

Docker akan menjalankan:

- Laravel / PHP-FPM
- Nginx
- MariaDB

Database menggunakan dataset yang tersedia pada:

```text
database/manufacturing_test.sql
```

### 4. Generate Application Key

Jika `APP_KEY` masih kosong:

```bash
docker-compose exec app php artisan key:generate
```

### 5. Clear Laravel Cache

```bash
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan view:clear
```

> Tidak perlu menjalankan `php artisan migrate:fresh` karena aplikasi menggunakan dataset `manufacturing_test` yang telah disediakan.

## Access

Setelah container berjalan, aplikasi dapat diakses melalui:

```text
http://localhost:8000
```

## API

### Dashboard

```http
GET /api/dashboard
```

Mengembalikan data dashboard termasuk summary, production trend, status breakdown, dan top machine performance.

### Production Orders

```http
GET /api/production/orders
```

Mendukung search, filtering, sorting, dan pagination.

Parameter:

- `page`
- `search`
- `product`
- `machine`
- `employee`
- `status`
- `date`
- `sort`
- `dir`
- `per_page`

Contoh:

```text
/api/production/orders?page=2&search=WO2026&status=FINISHED
```

### Production Result

```http
POST /api/production
```

Digunakan untuk menambahkan production result.

## Database

Database:

```text
manufacturing_test
```

Konfigurasi koneksi Docker:

```text
Host     : db
Port     : 3306
Username : laravel
Password : laravel
```

Dataset awal tersedia pada:

```text
database/manufacturing_test.sql
```

Tabel yang digunakan:

```text
employee
machine
product
work_order
production_result
downtime
maintenance
inventory_transaction
```

## Docker Commands

### Start

```bash
docker-compose up -d
```

### Stop

```bash
docker-compose down
```

### Rebuild

```bash
docker-compose up -d --build
```

### Check Container Status

```bash
docker-compose ps
```

### View Application Logs

```bash
docker-compose logs app --tail=100
```

### Access Laravel Container

```bash
docker-compose exec app bash
```

## Database Reset

Untuk membuat ulang database menggunakan dataset SQL:

```bash
docker-compose down -v
docker-compose up -d --build
```

> `docker-compose down -v` akan menghapus Docker volume database beserta seluruh data yang tersimpan di dalamnya. Gunakan hanya jika database perlu dibuat ulang.

## Notes

Tanggal referensi dashboard menggunakan tanggal produksi terbaru yang tersedia pada dataset.

Tanggal referensi ditentukan berdasarkan:

```text
MAX(production_result.actual_start)
```

bukan berdasarkan tanggal server (`CURDATE()`).

Dengan demikian, hasil dashboard tetap konsisten ketika aplikasi dijalankan pada waktu yang berbeda.
