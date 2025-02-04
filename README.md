Laravel Orders Management

Этот проект представляет собой систему управления заказами, разработанную на PHP (Laravel). Он позволяет создавать, редактировать и управлять заказами, тарифами и графиками доставки еды.

🚀 Функционал

Управление заказами (создание, просмотр, редактирование, удаление)

Управление тарифами

Гибкие графики доставки

Красивый UI с Bootstrap

Уведомления об успешных операциях

🛠️ Установка и запуск

1️⃣ Клонирование проекта

через https
git clone https://github.com/Afzalshoh02/meal_subscription.git
через SSH
git clone git@github.com:Afzalshoh02/meal_subscription.git
cd YOUR_REPOSITORY

(замени YOUR_USERNAME/YOUR_REPOSITORY на реальный URL репозитория)

2️⃣ Установка зависимостей

composer install

3️⃣ Настройка окружения

Создай .env файл:

cp .env.example .env

Сгенерируй ключ приложения:

php artisan key:generate

Укажи настройки базы данных в .env:

DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

4️⃣ Запуск миграций и сидеров

php artisan migrate --seed

5️⃣ Запуск сервера

php artisan serve

Перейди в браузере по адресу: http://127.0.0.1:8000

📌 Дополнительные команды

Очистить кеш: php artisan cache:clear

Очистить конфиг: php artisan config:clear

Очистить роуты: php artisan route:clear

Очистить представления: php artisan view:clear

🤝 Контрибьютинг

Если у тебя есть идеи по улучшению проекта, создавай pull request! 😊

📜 Лицензия

Этот проект распространяется под лицензией MIT.
