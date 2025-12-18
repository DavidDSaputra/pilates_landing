# Panduan Deployment Laravel ke Subdirektori cPanel (Project `pilates`)

Panduan ini akan membantu Anda mengupload project Laravel `pilates_landing` ke hosting cPanel agar bisa diakses di `https://joulwinn.com/pilates`, tanpa mengganggu project utama di `public_html`.

## 1. Persiapan di Komputer Lokal (Laptop)

Sebelum mengupload, pastikan aset (CSS/JS) sudah dicompile untuk production.

1.  Buka terminal di project `pilates_landing`.
2.  Jalankan perintah build:
    ```bash
    npm run build
    ```
3.  Bersihkan cache:
    ```bash
    php artisan optimize:clear
    ```
4.  **Zip Project:** Compress seluruh folder project `pilates_landing` menjadi `pilates_landing.zip`.

---

## 2. Persiapan di cPanel (Hosting)

### A. Membuat Database
1.  Masuk ke cPanel -> **MySQL Database Wizard**.
2.  Buat database baru, misal: `joulwinn_pilates`.
3.  Buat user baru, misal: `joulwinn_pilates_user` dan password yang kuat.
4.  Berikan **All Privileges** user tersebut ke database.
5.  **Import Database:** Buka **phpMyAdmin**, pilih database `joulwinn_pilates`, lalu Import file SQL dari local (hasil export dari komputer Anda).

### B. Membuat Struktur Folder
Kita akan memisahkan **core system** (app, config, vendor, dll) dari **file publik** (index.php, css, js) demi keamanan.

1.  Buka **File Manager** di cPanel.
2.  Di folder root (sejajar dengan `public_html`, biasanya `/home/joulwinn`), buat folder baru bernama `pilates_core`.
    *   *Catatan: Jangan buat di dalam public_html.*
3.  Upload file `pilates_landing.zip` ke dalam folder `pilates_core` ini.
4.  Extract zip tersebut. Pastikan isinya langsung terlihat (jika ada folder `pilates_landing` lagi di dalamnya, pindahkan semua isinya keluar ke `pilates_core` utama).

---

## 3. Konfigurasi Folder Public (Agar bisa diakses di /pilates)

1.  Masuk ke `public_html`.
2.  Buat folder baru bernama `pilates`. (Ini akan menjadi URL `joulwinn.com/pilates`).
3.  Pergi ke folder `pilates_core/public` (folder source code yang tadi diupload).
4.  **Pilih Semua (Select All)** file dan folder di dalam `pilates_core/public`, lalu **Move (Pindahkan)** ke `/public_html/pilates`.

Sekarang struktur Anda harusnya seperti ini:
*   `/home/joulwinn/pilates_core/` (Isi: app, bootstrap, config, vendor, .env, dll)
*   `/home/joulwinn/public_html/pilates/` (Isi: index.php, htaccess, build, favicon, dll)

---

## 4. Edit File Kunci

### A. Edit `index.php`
Edit file `/public_html/pilates/index.php` untuk memberitahu Laravel di mana file core berada.

Cari baris ini dan ubah path-nya:

```php
// Ubah path autoloader
require __DIR__.'/../../pilates_core/vendor/autoload.php';

// Ubah path aplikasi
$app = require __DIR__.'/../../pilates_core/bootstrap/app.php';
```
*(Sesuaikan jumlah `../` jika struktur folder Anda berbeda. Intinya arahkan keluar dari `public_html/pilates` menuju `pilates_core`).*

### B. Konfigurasi `.env`
Edit file `.env` yang ada di dalam folder `/home/joulwinn/pilates_core/`.

Sesuaikan konfigurasi berikut:
```env
APP_NAME="Pilates Landing"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://joulwinn.com/pilates

# Konfigurasi Database cPanel
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=joulwinn_pilates
DB_USERNAME=joulwinn_pilates_user
DB_PASSWORD=password_anda_tadi
```

### C. Edit `.htaccess` (Opsional tapi Penting)
Pastikan file `/public_html/pilates/.htaccess` ada. Jika user mengakses subfolder, kadang perlu menambahkan `RewriteBase`. Jika link mati (404), coba tambahkan ini di bawah `RewriteEngine On`:

```apache
RewriteBase /pilates/
```

---

## 5. Storage Link (Penting untuk Gambar)

Karena folder `storage` ada di `pilates_core`, kita harus menghubungkannya ke public. Di hosting tanpa akses terminal (SSH), kita bisa pakai script PHP.

1.  Buat file baru di `public_html/pilates/symlink.php`.
2.  Isi dengan kode berikut:
    ```php
    <?php
    $target = '/home/joulwinn/pilates_core/storage/app/public';
    $shortcut = '/home/joulwinn/public_html/pilates/storage';
    
    if(symlink($target, $shortcut)){
        echo "Symlink berhasil dibuat!";
    } else {
        echo "Gagal membuat symlink.";
    }
    ?>
    ```
    *(Ganti `joulwinn` dengan username cPanel asli Anda jika berbeda).*
3.  Akses `https://joulwinn.com/pilates/symlink.php` di browser.
4.  Jika berhasil, hapus file `symlink.php`.

---

## 6. Selesai!
Coba akses `https://joulwinn.com/pilates`. Website Anda seharusnya sudah aktif.
