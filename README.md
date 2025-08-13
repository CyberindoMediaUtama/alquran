# Al-Quran Digital 📖

Aplikasi Al-Quran digital yang lengkap dengan fitur audio, pencarian, dan tampilan responsif.

## ✨ Fitur Utama

- **Tampilan Lengkap**: Menampilkan semua 114 surah dengan ayat-ayat dan terjemahan
- **Audio Player**: 
  - Putar audio per surah (format: 001.mp3 - 114.mp3)
  - Putar audio per ayat (format: 001001.mp3 - 114006.mp3)
  - Auto-play berkelanjutan per ayat dalam satu surah
  - Kontrol audio lengkap (play, pause, next, previous)
- **Pencarian Canggih**: Cari ayat berdasarkan teks Arab atau terjemahan
- **Tema Dark/Light**: Toggle tema dengan penyimpanan preferensi
- **Responsive Design**: Optimal di desktop, tablet, dan mobile
- **AdSense Friendly**: Layout yang mendukung penempatan iklan
- **Progressive Web App**: Dapat diakses offline dengan service worker
- **Keyboard Shortcuts**: Kontrol cepat dengan keyboard

## 🗂️ Struktur File

```
alquran-digital/
├── index.html              # File utama aplikasi
├── config.php             # Konfigurasi database
├── api.php                # API endpoints
├── sw.js                  # Service worker
├── .htaccess              # Konfigurasi server
├── README.md              # Dokumentasi
└── public/
    └── audio/
        ├── surah/         # Audio per surah (001.mp3 - 114.mp3)
        └── Nasser_Alqatami/ # Audio per ayat (001001.mp3 - 114006.mp3)
```

## 🛠️ Instalasi

### 1. Persiapan Database
```sql
-- Buat database
CREATE DATABASE quran_pj;

-- Gunakan struktur tabel yang sudah ada:
-- quran_id (id, suraId, verseId, ayahText, indoText, readText)
```

### 2. Konfigurasi File
1. Edit `config.php` sesuai dengan setting database Anda
2. Upload semua file ke web server
3. Pastikan folder `public/audio/` memiliki permission yang benar

### 3. Struktur Audio Files
**Audio per Surah:**
- Lokasi: `public/audio/surah/`
- Format: `001.mp3`, `002.mp3`, ..., `114.mp3`

**Audio per Ayat:**
- Lokasi: `public/audio/Nasser_Alqatami/`
- Format: `SSSAAA.mp3` (SSS = surah 3 digit, AAA = ayat 3 digit)
- Contoh: `001001.mp3` (Al-Fatihah ayat 1), `002255.mp3` (Al-Baqarah ayat 255)

## 🎯 Cara Penggunaan

### Navigasi Dasar
- **Pilih Surah**: Klik surah di sidebar kiri
- **Cari Ayat**: Gunakan kotak pencarian di header
- **Toggle Tema**: Klik icon bulan/matahari di header

### Audio Controls
- **Play Surah**: Klik tombol play besar di tengah
- **Play Per Ayat**: Klik tombol play kecil di setiap ayat
- **Navigation**: Gunakan tombol previous/next atau arrow keys
- **Stop**: Tekan tombol pause atau ESC key

### Keyboard Shortcuts
- `Spacebar`: Play/Pause surah
- `←` / `→`: Previous/Next ayat
- `Escape`: Stop semua audio

## 🎨 Kustomisasi

### Tema dan Styling
CSS Variables di `:root` dapat disesuaikan:
```css
:root {
    --primary-color: #2E7D32;
    --accent-color: #4CAF50;
    /* ... dan lainnya */
}
```

### Audio Format
Aplikasi mendukung format MP3. Untuk format lain, sesuaikan di JavaScript:
```javascript
const audioFile = `public/audio/surah/${String(currentSurah).padStart(3, '0')}.mp3`;
```

## 📱 Progressive Web App (PWA)

Aplikasi ini sudah dikonfigurasi sebagai PWA dengan:
- Service Worker untuk caching
- Offline functionality
- App-like experience di mobile

## 🔧 API Endpoints

- `GET /api.php?action=get_surahs` - Daftar semua surah
- `GET /api.php?action=get_ayahs&sura_id=1` - Ayat-ayat dalam surah
- `GET /api.php?action=search&q=keyword` - Pencarian ayat
- `GET /api.php?action=get_ayah&sura_id=1&verse_id=1` - Ayat spesifik

## 🚀 Optimasi Performance

### Server-side
- Gzip compression enabled
- Browser caching headers
- Optimized database queries

### Client-side
- Lazy loading untuk audio files
- Efficient DOM manipulation
- Debounced search functionality
- Progressive image/audio loading

## 💼 AdSense Integration

Template sudah menyediakan container untuk iklan yang:
- Tidak mengganggu pengalaman pengguna
- Responsive di semua device
- Mengikuti guidelines AdSense

```html
<div class="ads-container">
    <!-- Tempatkan kode AdSense di sini -->
</div>
```

## 🔒 Keamanan

- SQL injection protection dengan PDO prepared statements
- XSS protection dengan output escaping
- CSRF protection headers
- File access restrictions via .htaccess

## 📄 License

MIT License - Bebas digunakan untuk project personal maupun komersial.

## 🤝 Contributing

Kontribusi selalu diterima! Silakan buat pull request atau laporkan issue.

## 📞 Support

Jika ada pertanyaan atau butuh bantuan implementasi, jangan ragu untuk menghubungi.

---

**Made with ❤️ for the Muslim community**