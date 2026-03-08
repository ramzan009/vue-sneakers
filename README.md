## Описания проекта

Я сделал этот проект в учебных целях для практики работы с фронтендом. Приложение разработано
на Vue, данные получаются и отправляются через REST API, что позволило отработать работу с 
асинхронными запросами и обработкой данных.

## Развертывание проекта

Для начало копируем проект из github:

```shell
git clone git@github.com:ramzan009/vue-sneakers.git
```

## Устоновка зависимостей

Устанавливаем зависимости:

```shell
cd backend
composer install --dev
cp .env.example .env
php artisan key:generate
php artisan storage:link
```

## Запуск миграции

Запускаем миграции:

```shell
cd backend
php artisan migrate
```

если хочешь видеть товаров запускаешь seeders, он находяться в папке ```backend/database/seeders```

## Запуск seeders

Запускаем сидов:
```shell
cd backend
php artisan db:seed --class=ProductSeeder
```


## Как открыть проект в браузере

```shell
cd frontend
npm install
npm run dev
```

```shell
cd backend
php artisan serve
```

Открываем по адресу   http://localhost:5173/