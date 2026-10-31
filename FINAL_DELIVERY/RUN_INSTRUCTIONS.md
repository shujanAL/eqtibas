# تعليمات تشغيل «اقتباس»

## المتطلبات

- PHP 8.2 أو أحدث مع: `curl`, `openssl`, `mbstring`, `fileinfo`, `pdo_mysql`, `zip`.
- Composer 2.
- MySQL أو MariaDB.

## الإعداد

1. فك ضغط `Eqtibas_Source.zip`.
2. افتح PowerShell داخل مجلد المشروع.
3. نفّذ `composer install`.
4. انسخ `.env.example` إلى `.env`.
5. نفّذ `php artisan key:generate`.
6. أنشئ قاعدة MySQL باسم `quoteit`.
7. اضبط `DB_DATABASE` و`DB_USERNAME` و`DB_PASSWORD` داخل `.env`.
8. نفّذ `php artisan migrate --seed` لإضافة الاقتباسات العربية التجريبية.
9. نفّذ `php artisan serve` وافتح `http://127.0.0.1:8000`.

عند استخدام PHP المحمول المرفق محليًا في بيئة التطوير الحالية يمكن استبدال `php` بـ:

```powershell
..\work\php83\php.exe
```

## الاختبارات

```powershell
php artisan test
```

الاختبارات تستخدم SQLite داخل الذاكرة ولا تلمس قاعدة MySQL الفعلية.

## الحسابات التجريبية

- `sara@example.com`
- `mohammed@example.com`
- `noura@example.com`

كلمة المرور التجريبية للحسابات الثلاثة: `password123`.

## الإنتاج

اضبط `APP_ENV=production` و`APP_DEBUG=false`، استخدم HTTPS، ثم نفّذ `php artisan config:cache` و`php artisan route:cache`.
