### Installing

Сhange the database settings in the file `bootstrap/app.php`

```
$ mysql db_name < test_db.sql
$ composer install
$ php -S localhost:8080 -t public
```