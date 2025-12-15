# Sistem Evaluasi Tim Manajemen Proyek

Sistem Evaluasi Tim Manajemen Proyek adalah aplikasi berbasis web yang dirancang untuk membantu organisasi dalam mengelola dan mengevaluasi kinerja tim proyek. Aplikasi ini memungkinkan pengguna untuk membuat proyek, mengundang anggota tim, serta melakukan evaluasi terhadap kinerja tim secara efektif.

##  Tim Pengembang

| Peran | Nama | Tanggung Jawab |
|-------|------|----------------|
| *Project Manager* | Muh.Fahri Alamsyah_F55123099 | Koordinasi tim, pengawasan timeline, dokumentasi proyek |
| *Frontend Developer* | Muh. Fahri Alamsyah_F55123099 | Implementasi tampilan web menggunakan Blade dan Bootstrap |
| *Backend Developer* | Muh. Al Faiz_F55123085 | Pembuatan fitur CRUD |
| *UI/UX Designer* | Muh. Rayyan Nazmuddin_F55123076 | Mendesain tampilan dan pengalaman pengguna di Figma |
| *Database Enginer* | Dede Fauzan_F55123089 | Membuat dan mengontrol database |

## Fitur Utama

- **Manajemen Akun Pengguna**: Registrasi, login, dan verifikasi email untuk pengguna baru
- **Sistem Otentikasi Lengkap**: Login, reset password, dan konfirmasi password
- **Manajemen Proyek**: Pembuatan, pengeditan, dan penghapusan proyek oleh pemilik
- **Manajemen Anggota Tim**: Undangan anggota ke proyek dengan peran yang berbeda (pemilik, manajer, anggota)
- **Evaluasi Tim**: Penilaian terhadap produktivitas dan efektivitas sistem tim
- **Sistem Peran & Hak Akses**: Pembagian hak akses berdasarkan peran (admin, manager, user)
- **Responsif**: Tampilan yang dapat digunakan di berbagai jenis perangkat

## Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP Framework)
- **Frontend**: HTML, CSS dengan Tailwind CSS
- **JavaScript**: Alpine.js untuk interaktivitas
- **Database**: MySQL atau SQLite
- **Manajemen Paket**: Composer (PHP) dan NPM (JavaScript)
- **Build Tool**: Vite
- **Styling**: Tailwind CSS dengan plugin forms

## Prasyarat Sistem

Sebelum Anda memulai, pastikan sistem Anda telah dipasangi hal-hal berikut:

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM atau Yarn
- Database (MySQL, PostgreSQL, atau SQLite)

## Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi secara lokal:

### 1. Clone repositori

```bash
git clone https://github.com/Paiii21/webevaluasitimmanajemenproyek.git
cd webevaluasitimmanajemenproyek
```

### 2. Install dependensi

```bash
composer install
npm install
```

### 3. Konfigurasi lingkungan

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Lalu jalankan perintah untuk menghasilkan kunci aplikasi:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database

Ubah pengaturan koneksi database di file `.env` sesuai dengan konfigurasi lokal Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_database
DB_PASSWORD=password_database
```

Untuk menggunakan SQLite, buat file database kosong dan ubah konfigurasi menjadi:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite
```

### 5. Jalankan migrasi database

```bash
php artisan migrate
```

Jika ingin menyertakan data contoh:

```bash
php artisan migrate --seed
```

### 6. Jalankan server pengembangan

```bash
php artisan serve
npm run dev
```

Atau gunakan perintah setup otomatis dari composer:

```bash
composer run dev
```

Aplikasi akan tersedia di [http://localhost:8000](http://localhost:8000)

## Struktur Direktori

```
webevaluasitimmanajemenproyek/
├── app/                    # Kode sumber utama aplikasi
│   ├── Http/              # Controllers, middleware, dll
│   ├── Models/            # Model Eloquent
│   └── ...
├── database/              # Migrasi, seeder, factory
├── resources/             # Views, assets (CSS, JS)
├── routes/                # File rute aplikasi
├── storage/               # File yang diupload dan cache
├── tests/                 # File uji coba aplikasi
├── composer.json          # Dependensi PHP
├── package.json           # Dependensi JavaScript
└── ...
```

## Basis Data

Aplikasi ini menggunakan beberapa tabel penting:

- **users**: Menyimpan informasi akun pengguna (termasuk peran)
- **projects**: Menyimpan informasi proyek (nama, deskripsi, pemilik)
- **project_members**: Relasi antara pengguna dan proyek dengan peran masing-masing
- **project_evaluations**: Menyimpan data evaluasi kinerja tim
- **project_invitations**: Menyimpan informasi undangan proyek

## Cara Menggunakan

### Untuk Administrator/Superuser

1. Buat akun pengguna
2. Tetapkan peran sebagai admin di database (jika diperlukan)
3. Gunakan fitur manajemen proyek sepenuhnya

### Untuk Pemilik Proyek

1. Masuk ke aplikasi
2. Klik "Buat Proyek" untuk membuat proyek baru
3. Undang anggota tim melalui fitur undangan
4. Tetapkan peran (manajer/anggota) kepada anggota tim
5. Buat evaluasi untuk menilai kinerja tim

### Untuk Anggota Tim

1. Terima undangan proyek melalui email
2. Ikuti link undangan untuk bergabung dengan proyek
3. Lihat evaluasi dan aktivitas proyek sesuai hak akses

## Testing

Untuk menjalankan pengujian unit:

```bash
php artisan test
```

Atau dengan perintah Composer:

```bash
composer run test
```

## Deploy ke Production

1. Atur variabel lingkungan produksi
2. Jalankan migrasi database
3. Optimalkan autoloader: `composer install --optimize-autoloader --no-dev`
4. Bangun aset frontend: `npm run build`
5. Atur direktori web root ke folder `public/`
6. Pastikan izin file dan folder telah sesuai

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini:

1. Fork repositori
2. Buat branch fitur (`git checkout -b fitur/AwesomeFeature`)
3. Commit perubahan Anda (`git commit -m 'Add some AwesomeFeature'`)
4. Push ke branch (`git push origin fitur/AwesomeFeature`)
5. Buka pull request

## Lisensi

Proyek ini dilisensikan di bawah lisensi MIT - lihat file [LICENSE](LICENSE) untuk detail selengkapnya.

## Dukungan

Jika Anda mengalami masalah dengan aplikasi, silakan hubungi tim pengembang atau buka issue di repositori GitHub.

---

Dikembangkan dengan ❤️ menggunakan Laravel Framework.
