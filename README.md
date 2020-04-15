# Introduction
Currency rate App, that fetches data from bank.lv.

## Installation
1. Update .env with necessary DB configuration
2. Migrate database
```bash
$  php bin/console doctrine:migrations:migrate
```
3. Run CLI to fetch data

## CLI
Fetching bank data
```bash
$ php bin/console bank:fetch-currencies
```
