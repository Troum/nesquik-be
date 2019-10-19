# nesquik-be

1. Склонируйте репозиторий в корневую директорию на сервере и переименуйте ее в ```api```
2. Перейдите в данную директорию и запустите команду ```composer install```
3. После установки всех зависимостей, запустите по очереди следующие команды
```php artisan key:generate```
```php artisan jwt:secret```

4. После выполнения команд, откройте переименуйте файл ```.env.example``` в ```.env``` и настройте подлючение к базе данных в соответствующих 
частях файла:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=database_user
DB_PASSWORD=database_user_password
```

5. Укажите в файле ```.env``` **APP_URL**, соответствющий вашему URL вместе с ```http``` или ```https```

6. Отключите **APP_DEBUG** присвоив значение false

8. Добавьте миграции в базу данных путем выполнения команды  ```php artisan migrate```

9. Перейдите в директорию  ```database/factories``` и замените ```$faker->name``` и ```$faker->unique()->safeEmail``` на имя и e-mail 
администратора (указать необходимо, заключив в одинарные кавычки) и 
выполните команду ```php artisan db:seed --class=UsersSeeder```
В случае необходимости, повторите вышеуказанные действия в пункте 9, для создания различных пользователей с возможностью
доступа к панели администрирования

10. Замените следующий блок кода:

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
на следующий:

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=igra.nesquik@gmail.com
MAIL_PASSWORD=a3xS@EWZ&4pp
MAIL_ENCRYPTION=ssl
```


