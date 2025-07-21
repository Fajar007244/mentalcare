# MentalCare: Platform Dukungan Kesehatan Mental Berbasis Web

**MentalCare** adalah sebuah aplikasi web yang dikembangkan sebagai proyek akhir untuk mata kuliah Pemrograman Web 2. Platform ini dirancang untuk menyediakan dukungan komprehensif bagi individu dalam menjaga dan meningkatkan kesehatan mental mereka melalui berbagai fitur interaktif dan informatif.

## Deskripsi Proyek

Proyek ini bertujuan untuk membangun sebuah sistem informasi yang memfasilitasi akses terhadap layanan dan sumber daya kesehatan mental. Dengan fokus pada antarmuka pengguna yang intuitif dan fungsionalitas yang relevan, MentalCare diharapkan dapat menjadi alat bantu yang efektif dalam perjalanan kesehatan mental pengguna.

## Fitur Fungsionalitas

Aplikasi MentalCare mengimplementasikan beberapa fitur utama, antara lain:

*   **Tes Kesehatan Mental:** Menyediakan serangkaian tes skrining (misalnya, PHQ-9) untuk membantu pengguna melakukan refleksi diri dan mendapatkan pemahaman awal mengenai kondisi mental mereka. Hasil tes disajikan sebagai informasi pendukung, bukan diagnosis klinis.
*   **Kursus Online:** Modul pembelajaran interaktif yang mencakup berbagai topik terkait kesehatan mental, dirancang untuk meningkatkan literasi dan keterampilan koping pengguna.
*   **Janji Temu dengan Psikolog:** Sistem penjadwalan yang memungkinkan pengguna untuk membuat janji temu konsultasi secara daring dengan psikolog profesional yang terdaftar dan terverifikasi.
*   **Jurnal Mood:** Fitur pencatatan harian yang memungkinkan pengguna untuk melacak dan menganalisis pola suasana hati mereka dari waktu ke waktu.
*   **Forum Diskusi:** Platform komunitas yang aman dan suportif bagi pengguna untuk berbagi pengalaman, mencari dukungan, dan berinteraksi dengan sesama.

## Lingkungan Pengembangan

Proyek ini dikembangkan menggunakan teknologi berikut:

*   **Framework:** Laravel (PHP)
*   **Frontend:** Blade, Tailwind CSS, JavaScript
*   **Database:** MySQL
*   **Manajemen Dependensi:** Composer (PHP), npm (Node.js)

## Panduan Instalasi Lokal

Untuk mengimplementasikan dan menjalankan proyek MentalCare di lingkungan lokal Anda, ikuti langkah-langkah berikut:

1.  **Kloning Repositori:**
    ```bash
    git clone https://github.com/Fajar007244/mentalcare.git
    cd mentalcare
    ```

2.  **Instal Dependensi Backend:**
    ```bash
    composer install
    ```

3.  **Instal Dependensi Frontend:**
    ```bash
    npm install
    ```

4.  **Konfigurasi Lingkungan:**
    Buat salinan file `.env.example` dan ganti namanya menjadi `.env`.
    ```bash
    cp .env.example .env
    ```

5.  **Generate Kunci Aplikasi:**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi Database:**
    Buka file `.env` dan sesuaikan pengaturan koneksi database (DB_DATABASE, DB_USERNAME, DB_PASSWORD) sesuai dengan konfigurasi MySQL lokal Anda.

7.  **Migrasi dan Seeding Database:**
    Jalankan perintah berikut untuk membuat tabel database dan mengisi data awal yang diperlukan:
    ```bash
    php artisan migrate:fresh --seed
    ```

8.  **Jalankan Server Pengembangan:**
    ```bash
    php artisan serve
    ```

9.  **Kompilasi Aset Frontend:**
    Buka terminal baru dan jalankan perintah ini untuk mengkompilasi aset CSS dan JavaScript:
    ```bash
    npm run dev
    ```

Aplikasi MentalCare akan dapat diakses melalui peramban web Anda di `http://localhost:8000`.