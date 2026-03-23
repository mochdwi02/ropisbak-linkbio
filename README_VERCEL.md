# Ropisbak 74 — Vercel Ready Package

Project ini sudah disiapkan agar lebih mudah di-deploy ke Vercel menggunakan runtime PHP community.

## Isi tambahan yang sudah disiapkan
- `composer.json`
- `artisan`
- `bootstrap/app.php`
- `bootstrap/providers.php`
- `api/index.php`
- `server.php`
- `vercel.json`
- `.vercelignore`
- `.env.example`
- folder `storage/` dan `bootstrap/cache/`

## Penting sebelum deploy
Jangan pakai `database/database.sqlite` untuk production Vercel.
Gunakan database **MySQL eksternal**.

Rekomendasi paling aman:
- MySQL dari hosting / VPS Anda sendiri
- phpMyAdmin tetap dipakai untuk cek data

## Langkah lokal dulu
1. Ekstrak zip
2. Masuk ke folder project
3. Jalankan:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

4. Isi `.env` dengan database MySQL Anda
5. Jalankan migration dan seeder:

```bash
php artisan migrate --seed
```

6. Test lokal:

```bash
php artisan serve
```

## Env yang wajib diisi di Vercel
- `APP_KEY`
- `APP_URL`
- `DB_CONNECTION=mysql`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- `SESSION_DRIVER=cookie`
- `LINKBIO_BRAND_NAME`
- `LINKBIO_BRAND_DESCRIPTION`
- `LINKBIO_BRAND_SUBDESCRIPTION`
- `LINKBIO_PROFILE_IMAGE`
- `LINKBIO_INSTAGRAM_URL`
- `LINKBIO_WHATSAPP_URL`

## Deploy ke Vercel CLI
```bash
npm i -g vercel
vercel login
vercel
```

Atau production:

```bash
vercel deploy --prod
```

## Setelah deploy
1. Masuk ke Vercel Project Settings
2. Isi semua Environment Variables
3. Redeploy
4. Jalankan migration ke database MySQL Anda dari lokal / server:

```bash
php artisan migrate --force
php artisan db:seed --force
```

## Login admin default
- Email: `admin@linkbio.local`
- Password: `admin12345`

## Catatan
- Session production diset ke `cookie` agar ringan dan cocok untuk kebutuhan admin sederhana.
- Klik link dan visit tetap tersimpan ke tabel MySQL.
- Asset gambar dan Sneat dibaca langsung dari folder `public/`.

## Fix included in this final zip
- Added `config/view.php` to resolve Laravel view binding on Vercel.
- Changed `CACHE_STORE` to `file` and `QUEUE_CONNECTION` to `sync` in `vercel.json`.
- Updated `.env.example` with safer Vercel defaults.

## Important for Vercel
- If `vercel.json` is in the root of your GitHub repo, leave **Root Directory** empty.
- Do **not** set Root Directory to `/`.
- After changing Environment Variables, always redeploy.
