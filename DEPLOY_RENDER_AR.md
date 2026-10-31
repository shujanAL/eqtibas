# نشر منصة «اقتباس» على Render باستخدام Docker

## قبل النشر

- لا ترفع ملف `.env` إلى GitHub. الملف محمي في `.gitignore` و`.dockerignore`.
- لا تضع كلمة مرور قاعدة البيانات أو `APP_KEY` داخل `render.yaml`.
- تحتاج قاعدة MySQL خارجية تسمح بالاتصال العام من Render وتدعم MySQL 8 و`utf8mb4`.

## متغيرات Render المطلوبة

أدخل القيم السرية من صفحة الخدمة: **Environment**.

| المتغير | القيمة |
|---|---|
| `APP_KEY` | ناتج الأمر `php artisan key:generate --show` |
| `APP_URL` | رابط Render النهائي، مثل `https://eqtibas.onrender.com` |
| `DB_HOST` | مضيف MySQL الخارجي، من مزود القاعدة |
| `DB_PORT` | منفذ MySQL، غالبًا `3306` |
| `DB_DATABASE` | اسم قاعدة البيانات |
| `DB_USERNAME` | مستخدم قاعدة البيانات |
| `DB_PASSWORD` | كلمة مرور قاعدة البيانات |

إذا كان مزود MySQL يطلب شهادة CA، أضف `MYSQL_ATTR_SSL_CA` بالقيمة أو المسار الذي يقدمه المزود. لا تعطل التحقق من SSL إلا إذا نص مزود القاعدة صراحة على ذلك.

## سلوك الحاوية

- تستخدم PHP 8.3 وApache.
- جذر الموقع هو `/var/www/html/public`.
- يستمع Apache على `0.0.0.0` والمنفذ الموجود في `PORT`، وافتراضيًا `10000`.
- ينفذ `php artisan migrate --force` عند التشغيل عندما تكون `RUN_MIGRATIONS=true`.
- لا ينفذ Seeder تلقائيًا حتى لا يضيف بيانات تجريبية إلى قاعدة الإنتاج.

## فحص النشر

بعد نجاح البناء افتح:

```text
https://YOUR-SERVICE.onrender.com/up
```

يجب أن تظهر:

```json
{"status":"ok"}
```

ثم افتح الصفحة الرئيسية واختبر إنشاء حساب، تسجيل الدخول، البحث، وإضافة اقتباس. راجع Logs في Render إذا ظهر خطأ اتصال MySQL.
