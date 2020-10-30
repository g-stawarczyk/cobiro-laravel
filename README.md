## How to start
1. Add new schema to your MySQL Database:
`create schema DB_NAME;`
2. Copy file `.env.example` to `.env` and edit `DB_*` AND `APP_URL` fields
3. Exec below commands:<br>
`composer install`<br>
`php artisan doctrine:schema:create`
4. Exec
```
   curl --location --request POST 'http://cobiro.local/api/product' \
   --header 'Content-Type: application/json' \
   --data-raw '{"name":"Lorem name","price":{"amount":123,"currency":"PLN"}}'
```

## How to run unit tests
`vendor/bin/phpunit tests`
