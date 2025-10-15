# Pimcore Workshop 

## Description

Pimcore template to boot a fresh new Pimcore project in seconds.

## Prerequisites
* [DDEV](https://ddev.readthedocs.io/en/stable/) installed and configured

## Startup

```shell
git clone git@github.com:pallino-co/pimcore-workshop.git
cd pimcore-workshop
```

### Start DDEV

```shell
ddev start
```

### Install PHP dependencies

```shell
ddev composer install
```

### Database migration

create a new file for database configuration in `config/local/database.yaml` with the following content:

```yaml
doctrine:
    dbal: { connections: { default: { host: db, port: 3306, user: db, password: db, dbname: db, mapping_types: { enum: string, bit: boolean }, server_version: 10.11.14-MariaDB-ubu2204-log } } }
```

then run the following commands:

```shell
ddev import-db --src=./db/pimcore.sql.gz
```

```shell
ddev exec bin/console pimcore:deployment:classes-rebuild --create-classes -f
```

## URLs

### Sviluppo

* Admin: [https://pimcore-workshop.ddev.site/admin](https://pimcore-workshop.ddev.site/admin)

```
user: admin
password: admin
```
