# restful-php

Simple restful api with PHP.

## Running With Docker 

This container will consume ports ``` 80:80, 3306:3306, and 8080:8080 ```.

Inside repository folder, run command :

```bash
docker compose up
```

Edit database configuration, keep database name in api/Const.php (skip if use same as default container) :

```phpregexp
define("HOSTNAME", "<Database Hostname>");

define("USERNAME", "<Username>");

define("PASSWORD", "<Password>");

define("DATABASE", "transaction_app");
```

Run migration to generate Database, Table and Dummy Data :

```bash
docker exec restful-app php migrations/migration.php
```

## Running With XAMPP, MAMP etc.
Put this folder inside ``` htdocs ``` and make sure web server and database server is active.

Edit database configuration (same with Docker).

Run migration inside project directory to generate Database, Table and Dummy Data :

```bash
php migrations/migration.php
```

## Using Service With Postman

Get transaction with id and merchant id

```bash
GET :

http://localhost:80/api/transaction/get.php
```

Create transaction data

```bash
POST :

http://localhost:80/api/transaction/create.php
```
