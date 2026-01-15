# 📰 E-Paper Subscription Website

Website e-paper berbasis **Laravel 11** dengan sistem **langganan bulanan** dan integrasi **Midtrans Snap Payment Gateway**.  
User hanya dapat mengakses konten e-paper jika memiliki langganan aktif.

---

## ✨ Fitur
- Autentikasi user (Login, Register, Verifikasi Email)
- Sistem langganan:
  - 1 Bulan
  - 6 Bulan
  - 1 Tahun
- Integrasi Midtrans Snap
- Payment Notification / Callback Midtrans
- Aktivasi langganan otomatis setelah pembayaran sukses
- Middleware proteksi akses e-paper
- CRUD e-paper (Admin)
- Dashboard user

---

## 🛠️ Tech Stack
- Laravel 11
- PHP 8.2+
- MySQL / MariaDB
- Midtrans Snap API
- Blade Template
- ngrok (development webhook)

---

## 📦 Instalasi

### 1. Clone Repository
git clone https://github.com/username/epaper-subscription.git
cd epaper-subscription

### 2. Instal dependency
composer install
npm install
npm run build


### 3. Setup Environtment
cp .env.example .env
php artisan key:generate

### 4. Konfigurasi Database
DB_DATABASE=epaper
DB_USERNAME=root
DB_PASSWORD=

### 5. Konfigurasi Midtrans 
MIDTRANS_SERVER_KEY=SB-Mid-server-XXXXXXXXXXXX
MIDTRANS_CLIENT_KEY=SB-Mid-client-XXXXXXXXXXXX
MIDTRANS_IS_PRODUCTION=false

## Webhook development (ngrok)
php artisan serve
ngrok http 8000

## Alur Pembayaran
1. User memilih paket langganan
2. Sistem generate Snap Token
3. User melakukan pembayaran via Midtrans
4. Midtrans mengirim callback ke server
5. Status transaksi berubah menjadi settlement / capture
6. Langganan user otomatis aktif
7. User dapat mengakses e-paper
