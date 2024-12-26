Запуск програми:

1. Встановити пакети composer:
   composer install
2. Згенерувати ключ шифрування:
   php artisan key:generate
3. Прописати у файлі .env параметри підключення до бази даних. І, якщо у вас зайняті порти 80 та/або 3306, то додати змінні оточення APP_PORT=... та FORWARD_DB_PORT=...
4. Запустити контейнери Docker у фоновому режимі:
   ./vendor/bin/sail up -d
5. Запустити міграції:
   ./vendor/bin/sail artisan migrate
6. Наповнити базу даних початковими значеннями:
   ./vendor/bin/sail artisan db:seed
