# Pimcore Workshop 

## Description

Pimcore template to boot a fresh new Pimcore project in seconds.

## Startup

### Start DDEV

```shell
ddev start
```

### Install PHP dependencies

```shell
ddev composer install
```
### Database migration

```shell
ddev import-db --src=./db/pimcore.sql.gz
```

## URLs

### Sviluppo

* Admin: [https://pimcore-workshop.ddev.site/admin](https://pimcore-workshop.ddev.site/admin)

```
user: admin
password: password
```
