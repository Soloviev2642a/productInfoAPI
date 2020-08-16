Инструкция по запуску проекта:
  1. Скопировать проект из репозитория
  2. Перейти в корневую папку проекта
  3. Выполнить команду composer install
  4. Открыть файл .env.example и заполнить информацию о базе данных
  5. Переименовть файл .env.example в .env
  6. Создать пустую базу данных (с названием указаным в файле .env)
  7. В папке проекта выполнить команду php artisan migrate
  
Использование API:
  <br>Для просмотра доступных запросов можно выполнить команду php artisan route:list
  
  Пример запроса:
    GET productinfo/public/api/products?sortBy=price&direction=asc&category=1
    <br>productinfo - название домена
    <br>sortBy - сортировка по указанному полю
    <br>direction - направление (возрастание/убывание)
    <br>category - товары определенной категории (указывается id категории)
    
Использование консольной команды
  <br>В папке jsonData находятся два файла: products.json и categories.json, для чтения json файла и записи в БД, можно выполнить команду php artisan fromJson:read -filePath -dataType
  
  Например:
    <br>1) php artisan fromJson:read jsonData\categories.json category
    <br>2) php artisan fromJson:read jsonData\products.json product