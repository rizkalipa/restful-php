# restful-php

Simple restful api with PHP.

## Running With Docker 

This container will using ports ``` 81, 3307, and 8081 ```.

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

Note : if create table/insert not working properly, there is manual migration sql file inside /migrations

## Running With XAMPP, MAMP etc.
Put this folder inside ``` htdocs ``` and make sure web server and database server is active.

Edit database configuration (same with Docker).

Run migration inside project directory to generate Database, Table and Dummy Data :

```bash
php migrations/migration.php
```

Note : if create table/insert not working properly, there is manual migration sql file inside /migrations


## Using Service With Postman

Get transaction with id and merchant id

```bash
GET :

http://localhost:80/api/transaction/get.php

Params :

?referenceId=1&merchantId=1
```

Create transaction data

```bash
POST :

http://localhost:80/api/transaction/create.php\
```
Body Request :

```json
{
	"invoiceId": 1,
	"itemName": "Test",
	"amount": 170000,
	"paymentType": 1,
	"customerName": "John Doe",
	"merchantId": 1
}
```

Update data transaction with command line :

With docker :

```bash
docker exec restful-app php transaction-cli.php --referenceId=1 --status=3
```

Without docker :

```bash
php transaction-cli.php --referenceId=1 --status=3
```
