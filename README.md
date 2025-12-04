# ManajemenProyek_A_SistemEvaluasiTim

###  Just Celebes
**Just Celebes** adalah aplikasi web berbasis Laravel yang menampilkan dan mengelola daftar tempat wisata yang ada di wilayah Sulawesi.  
Website ini bertujuan untuk memperkenalkan keindahan dan potensi wisata Sulawesi kepada masyarakat luas dengan cara yang menarik, informatif, dan mudah diakses.

---

##  Tujuan Proyek
- Menyediakan platform yang menampilkan informasi tempat wisata di Sulawesi  
- Memudahkan pengguna dalam mencari dan memahami tempat wisata berdasarkan kategori dan lokasi  
- Meningkatkan promosi pariwisata daerah Sulawesi melalui media digital  

---

##  Fitur Utama
- Halaman utama (Landing Page) dengan tampilan modern  
- Daftar tempat wisata dengan kategori, lokasi, deskripsi, dan gambar  
- Halaman detail wisata  
- Fitur pencarian dan filter data wisata  
- CRUD (Create, Read, Update, Delete) untuk data wisata oleh admin  
- Desain responsif yang optimal di berbagai perangkat  

---

##  Teknologi yang Digunakan

| Komponen | Teknologi |
|-----------|------------|
| **Framework** | Laravel 11 |
| **Database** | MySQL |
| **Frontend** | Blade Template, Bootstrap 5 |
| **Desain** | Figma |
| **Version Control** | Git & GitHub |

---

##  Tim Pengembang

| Peran | Nama | Tanggung Jawab |
|-------|------|----------------|
| **Project Manager** | Halim | Koordinasi tim, pengawasan timeline, dokumentasi proyek |
| **Frontend Developer** | Fitri | Implementasi tampilan web menggunakan Blade dan Bootstrap |
| **Backend Developer** | Aqilah | Pembuatan fitur CRUD dan pengelolaan data tempat wisata |
| **UI/UX Designer** | Ari | Mendesain tampilan dan pengalaman pengguna di Figma |

---

## 🗓️ Timeline Proyek (4 Minggu)

| Minggu | Capaian Utama | Kegiatan |
|--------|----------------|----------|
| **1** | Perencanaan & Persiapan Awal | Menentukan konsep, struktur database, dan setup repository Laravel |
| **2** | Implementasi Awal | Membuat tampilan utama, halaman wisata, dan integrasi database |
| **3** | Pengujian Internal | Testing CRUD, perbaikan bug, dan peningkatan tampilan |
| **4** | Penyempurnaan & Pengujian | Uji fitur, perbaikan akhir, dan dokumentasi proyek |

---

##  Cara Menjalankan Proyek (Local)

1. Clone repository ini:
   ```bash
   git clone https://github.com/ForLimm/ManajemenProyek_A_Just-Celebes.git
2. Masuk ke folder proyek:
   ```bash
   cd just-celebes
3. Install dependencies:
   ```bash
   composer install
4. Buat file .env dan sesuaikan konfigurasi database.
5. Jalankan migration:
   ```bash
   php artisan migrate
6. Jalankan seeder
   ```bash
   php artisan db:seed
7. Melakukan generate key
    ```bash
    php artisan key:generate
8. Jalankan server:
   ```bash
   php artisan serve
   
9. Buka di browser:[http://127.0.0.1:8000](http://127.0.0.1:8000)


## 🎨 UI/UX Design Contribution

**UI/UX Designer** pada proyek **Just Celebes** adalah membuat desain antarmuka website secara lengkap menggunakan Figma, mulai dari layout, style visual, hingga prototype interaktif.

### **Halaman yang Telah Di Desain**
- Login  
- Sign Up  
- Homepage  
- About  
- More Destination  
- Contact Us  
- Profile  
- Profile Page 2  
- Danau Poso  
- Tugu Perdamaian  
- Air Terjun Salodik  
- Pulau Togean  
- Danau Tambing  
- Pantai Sabang  

### **Link Desain Figma**
Link Figma: [Klik di sini](https://www.figma.com/design/k5Me90RbstmmLEnQRxL7uI/Just-Celebes?node-id=0-1&t=iUIA9FQHEYccpdgM-1)

### **Tools yang Digunakan**
- Figma (High-fidelity design & prototyping)
- Plugins pendukung (ikon, grid, UI kits, dll.)

### **Peran & Tanggung Jawab**
- Mendesain struktur UI seluruh halaman website  
- Menentukan gaya visual (warna, tipografi, layout)  
- Membuat wireframe & high-fidelity mockup  
- Menyusun prototype alur pengguna  
- Berkolaborasi dengan developer untuk implementasi desain
